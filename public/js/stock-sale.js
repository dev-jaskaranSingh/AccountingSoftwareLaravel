$(function(){
    $('input[name=registration_no]').keydown(function(e){
        if(e.keyCode == 13){
            e.preventDefault();
            window.location.href = route+'/pharmacy/stock/sale/create/'+$(this).val();
        }
    });

    $('.lose-qty').hide();
    let elem;

    // Function for Handling Request Ajax Request
    $('body').on('change','.product_dropdown', function(){
        elem = $(this);
        let currentRowindex = $(this).parents('tr').index();
        let totalLength = $('.sale-table').find('tbody tr').length;
        $(this).parents('tr').find('.example').focus();
        if(currentRowindex == totalLength - 1){
            let firstRow = $('.sale-table').find('tbody tr:first').clone();
            firstRow.find('input, .sale-qty').val('');
            firstRow.find('.expiry, .rate, .amount, .stock').html('');
            $('.sale-table').find('tbody').append(firstRow);
            $('span.select2').last().remove();
            $('select.select2').last().removeClass('select2-hidden-accessible').removeClass('select2').removeAttr('aria-hidden').removeAttr('tabindex');
            resetIndex();
        }

        // GetBatch Number On Product Selection
        let product_id = $(this).find(":selected").val();
        ajaxFunction(product_id,function(result){
            // console.log(result);
            // console.log(result.products.packed_qty);
            elem.parents('tr').find(".packed_qty").val(result.products.packed_qty);
            elem.parents('tr').find(".batch-no").html('');
            elem.parents('tr').find(".batch-no").append('<option selected="selected" value="">Select Batch</option>');
            $.each(result.batch, function (val, text) {
                elem.parents('tr').find(".batch-no").append("<option value=" + text + ">" + text + "</option>");
            });
        });

    // Get Product Details on Batch Number Selection
        $('.batch-no').change(function() {
            let batch_no = $(this).find(":selected").text();
            let elem = $(this);
            ajaxFunction(batch_no,function(result){
                let rate = result.product.cost_per_product;
                elem.parents('tr').find('.rate').val(rate);
                elem.parents('tr').find('.expiry').html(result.product.expiry);
                let packed_qty = elem.parents('tr').find('.packed_qty').val();
            });
        });
    });

    // To Insert And Check Available Stock
    $('body').on('change','.qty-option',function () {
        elem = $(this);
        let type = elem.parents('tr').find(this).val();
        let product_id = elem.parents('tr').find('.product_dropdown').val();
        let batch = elem.parents('tr').find('.batch-no').val();
        if(type == 0){
            ajaxFunction(batch,function (result) {
                if (result.product.current_qty == 0){
                    toastr["error"]("Stock Not Available","Failed");
                }
                elem.parents('tr').find('.stock').html(result.product.current_qty);
            });
            elem.parents('tr').find('.qty-option').val(0);
            elem.parents('tr').find('.lose-qty').hide();
            elem.parents('tr').find('.sale-qty').show();
            elem.parents('tr').find('.sale-qty').keyup(function () {
                ajaxFunction(product_id,function(result){
                    let packed_qty = result.products.packed_qty;
                    let sale_qty =  elem.parents('tr').find('.sale-qty').val();
                    let rate = parseInt(elem.parents('tr').find('.rate').val());
                    elem.parents('tr').find('.rate').val(rate);
                    let l_qty = packed_qty*sale_qty;
                    elem.parents('tr').find('.lose-qty').val(Math.round(l_qty));
                    let amount = l_qty*rate;
                    elem.parents('tr').find('.amount').html(amount);
                });
            }).blur(function(){
                let sale_qty =  elem.parents('tr').find('.sale-qty').val();
                let available = elem.parents('tr').find('.stock').html();
                if (available - sale_qty > 0)
                    elem.parents('tr').find('.stock').html(available - sale_qty);
                else {
                    toastr["error"]("Stock Not Available","Failed");
                }
            });

        }
        if(type == 1){
            ajaxFunction(batch,function (result) {
                if (result.product.current_loose_qty == 0){
                    toastr["error"]("Stock Not Available","Failed");
                }
                elem.parents('tr').find('.stock').html(result.product.current_loose_qty);
            });
            elem.parents('tr').find('.qty-option').val(1);
            elem.parents('tr').find('.sale-qty').hide();
            elem.parents('tr').find('.lose-qty').show();
            elem.parents('tr').find('.lose-qty').keyup(function () {
                ajaxFunction(product_id,function(result){
                    let packed_qty = result.products.packed_qty;
                    let l_qty =  elem.parents('tr').find('.lose-qty').val();
                    let rate = parseInt(elem.parents('tr').find('.rate').val());
                    elem.parents('tr').find('.rate').val(rate);
                    let sale_qty = l_qty/packed_qty;
                    elem.parents('tr').find('.sale-qty').val(Math.round(sale_qty));
                    let amount = l_qty*rate;
                    elem.parents('tr').find('.amount').html(amount);
                });
            }).blur(function(){
                let l_qty = elem.parents('tr').find('.lose-qty').val();
                let available = elem.parents('tr').find('.stock').html();
                if (available - l_qty > 0){
                    elem.parents('tr').find('.stock').html(available - l_qty);
                }
                else{
                    toastr["error"]("Stock Not Available","Failed");
                }
            });
        }
    });

    // Update Sales

    $('body').on('change','.qty-options',function () {
        elem = $(this);
        let type = elem.parents('tr').find(this).val();
        let product_id = parseInt(elem.parents('tr').find('.product-id').val());
        let batch = parseInt(elem.parents('tr').find('.batch-no').text());
        ajaxFunction(product_id,function (result) {
            let packed_qty = result.products.packed_qty;
        if (type == 0){
            ajaxFunction(batch,function (result) {
                if (result.product.current_qty == 0){
                    toastr["error"]("Stock Not Available","Failed");
                }
                elem.parents('tr').find('.stock').html(result.product.current_qty);
            });
            elem.parents('tr').find('.qty-option').val(0);
            elem.parents('tr').find('.lose-qty').hide();
            elem.parents('tr').find('.sale-qty').show();
            elem.parents('tr').find('.sale-qty').keyup(function () {
                    let rate = parseInt(elem.parents('tr').find('.rate').text());
                    let sale_qty = $(this).val();
                    let l_qty = sale_qty*packed_qty;
                    elem.parents('tr').find('.amount').text(rate*l_qty);
            }).blur(function(){
                let sale_qty =  elem.parents('tr').find('.sale-qty').val();
                let available = elem.parents('tr').find('.stock').html();
                if (available - sale_qty > 0)
                    elem.parents('tr').find('.stock').html(available - sale_qty);
                else {
                    toastr["error"]("Stock Not Available","Failed");
                }
            });

        }
        if (type == 1){
            ajaxFunction(batch,function (result) {
                if (result.product.current_loose_qty == 0){
                    toastr["error"]("Stock Not Available","Failed");
                }
                elem.parents('tr').find('.stock').html(result.product.current_loose_qty);
            });

            elem.parents('tr').find('.qty-option').val(1);
            elem.parents('tr').find('.sale-qty').hide();
            elem.parents('tr').find('.lose-qty').show();
            elem.parents('tr').find('.lose-qty').keyup(function () {
                let rate = parseInt(elem.parents('tr').find('.rate').text());
                let l_qty = $(this).val();
                let qty = l_qty/packed_qty;
                elem.parents('tr').find('.amount').text(rate*l_qty);
            }).blur(function(){

                let l_qty = elem.parents('tr').find('.lose-qty').val();
                let available = elem.parents('tr').find('.stock').html();
                if (available - l_qty > 0){
                    elem.parents('tr').find('.stock').html(available - l_qty);
                }
                else{
                    toastr["error"]("Stock Not Available","Failed");
                }

                });
            }
        });
    });


    // For Delete Row
    $('body').on('click','.delete-row', function(){
        if($('.sale-table').find('tbody tr').length > 1 ){
            if($(this).parents('tr').find('select').val() == ''){
                let emptySelects = 0;
                $('.sale-table tbody').find('tr').each(function(){
                    if($(this).find('select').val() == ''){
                        emptySelects++;
                    }
                });
                if(emptySelects > 1){
                    $(this).parents('tr').remove();
                    resetIndex();
                }
            }else{
                $(this).parents('tr').remove();
                resetIndex();
            }
        }
    });
});



function ajaxFunction(id,callback) {
    $.ajax({
        url: route + "/pharmacy/stock/sale/product/data/" + id,
        type: "GET",
        success: function (response) {
            callback(response);
        }
    });
}


function resetIndex(){
    $('.sale-table tbody tr').each(function(index){
        $(this).find('td:first').text(index+1);
    });
}
