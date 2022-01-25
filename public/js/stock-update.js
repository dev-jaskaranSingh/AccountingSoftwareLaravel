$(function(){
    let elem;
    $('.datatable').dataTable();

    $("body").on('change','.select',function () {
        let elem = $(this);
        var id = $(this).find(":selected").val();


        $.ajax({
            url : route+"/pharmacy/stock/purchase/data/"+id,
            type: "GET",
            success : function (response) {
                console.log(response.product.cost_per_product);
                var pack_qty = elem.parents('tr').find('input[name="qty"]').attr('data_pck_qty');

                elem.parents('tr').find('input[name="qty"]').val(response.product.current_qty);
                elem.parents('tr').find('input[name="current_loose_qty"]').val(response.product.current_loose_qty);
                elem.parents('tr').find('input[name="rate"]').val(response.product.cost_per_product);

                let qty = response.product.qty;
                let l_qty = response.product.current_loose_qty;

                elem.parents('tr').find('input[name="qty"] ').keyup(function(){
                    qty = elem.parents('tr').find('input[name="qty"]').val();
                    l_qty = pack_qty*qty;
                    elem.parents('tr').find('input[name="current_loose_qty"]').val(l_qty);
                });

                elem.parents('tr').find('input[name="current_loose_qty"]').keyup(function () {
                    l_qty = elem.parents('tr').find('input[name="current_loose_qty"]').val();
                    qty = l_qty/pack_qty;
                    elem.parents('tr').find('input[name="qty"]').val(qty);
                });

                elem.parents('tr').find('input[name="rate"]').keyup(function () {
                    rate = elem.parents('tr').find('input[name="rate"]').val();
                    elem.parents('tr').find('input[name="rate"]').val(rate);
                });
            }
        })
    });

    // Submit Virtual Form

    $('body').on('click',".submit",function () {
        let elem = $(this);
        let id = elem.parents('tr').find('.pro-id').val();
        let batch = elem.parents('tr').find('.select').val();
        let l_Qty = elem.parents('tr').find('.l-qty').val();
        let s_Qty = elem.parents('tr').find('.s-qty').val();
        let rate = elem.parents('tr').find('.rate').val();

        if(l_Qty == "" && s_Qty == ""){
            toastr['error']('Fill Quantity','Failed');
            // elem.parents('tr').find('.l-qty').css('border','2px solid red');
        }else{
            $(".id").val(id);
            $(".batch").val(batch);
            $(".qty").val(s_Qty);
            $(".lose-qty").val(l_Qty);
            $(".rate").val(rate);
            $('form').submit();
        }
    });

    // Get Packed Quantity on Product Selection
    $('body').on('change','.product_dropdown',function () {
        elem = $(this);
        let product_id = $(this).find(":selected").val();
        ajaxFunction(product_id,function(result){
            let packed_qty = result.products.packed_qty;
            elem.parents('tr').find('.packed-qty').val(packed_qty);
        });
    });

    // Calculate and Display CPL
    $('body').on('keyup','.qty', function(){
        elem = $(this);
        let qty = elem.parents('tr').find(this).val();
        let cpp =  elem.parents('tr').find('.cpp').val();
        let amount = elem.parents('tr').find('.amount').text(cpp*qty);
        let packed_qty = elem.parents('tr').find('.packed-qty').val();
        if(packed_qty == 0){
            toastr["error"]("Packed Quantity Not Available","Failed");
        }
        console.log(packed_qty);
        let cpl = elem.parents('tr').find('.cpl').text();
        cpl = cpp/packed_qty;
        elem.parents('tr').find('.cpl').text(cpl);
    });

    // Calculate and Display CPL Amount
    $('body').on('keyup','.cpp',function () {
        elem = $(this);
        let cpp =  elem.parents('tr').find(this).val();
        let qty = elem.parents('tr').find('.qty').val();
        let amount = elem.parents('tr').find('.amount').text(cpp*qty);
        let packed_qty = elem.parents('tr').find('.packed-qty').val();
        if(packed_qty == 0){
            toastr["error"]("Packed Quantity Not Available","Failed");
        }
        let cpl = elem.parents('tr').find('.cpl').text();
        cpl = cpp/packed_qty;
        elem.parents('tr').find('.cpl').text(cpl);
    });

    // Calculate and Display MRP Amount

    $('body').on('keyup','.msp',function () {
        elem = $(this);
        let packed_qty = elem.parents('tr').find('.packed-qty').val();
        if(packed_qty == 0){
            toastr["error"]("Packed Quantity Not Available","Failed");
        }
        let msp = elem.parents('tr').find(this).val();
        elem.parents('tr').find('.spl').text(packed_qty*msp);
    });

    // Show alert if bill number already exist
    $('.billno').blur(function () {
        let elem = $(this);
        let bill_no = elem.val();
        $.ajax({
            url:route+"/pharmacy/stock/purchase/billno",
            type:"GET",
            data:{bill_no:bill_no},
            success:function (response) {
                if (response.data){
                    elem.val(' ');
                    toastr["error"]("Bill Number Already Exist","Failed");
                }
            }
        });
    });

    // For Delete Row
    $('body').on('click','.delete-row', function(){
        let permition = confirm("Delete Product !");
        if (permition == true) {
            let elem = $(this);
            let id = elem.parents('tr').find('.id').val();
            $.ajax({
                url: route+ "/pharmacy/stock/purchase/delete/"+id,
                type:"GET",
                success:function (response) {
                    console.log(response.data);
                    if (response.data){
                        toastr["success"]("Stock Purchase Item Deleted successfully!", "Success");
                    }
                    location.reload();
                }
            });
        }
    });

    // Button to add new row in table
    $(":button").click(function(){
        var $lastRow = $("[id$=blah] tr:not('.ui-widget-header'):last"); //grab row before the last row
        var $newRow = $lastRow.clone(); //clone it
        $newRow.find(":text").val(""); //clear out textbox values
        $lastRow.after($newRow); //add in the new row at the end
    });

});

// Function to handle Ajax Requests
function ajaxFunction(id,callback) {
    $.ajax({
        url: route + "/pharmacy/stock/sale/product/data/" + id,
        type: "GET",
        success: function (response) {
            callback(response);
        }
    });
}


