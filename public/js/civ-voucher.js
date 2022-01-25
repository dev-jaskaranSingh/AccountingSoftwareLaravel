$(function(){
    $('.save_issued_to').click(function(){
        let issuedName = $('.issued_name').val();
        if(issuedName.trim() == ''){
            alert('Please fill the name');
            return false;
        }
        saveIssuedTo();
    });

    $('.issued_name').keydown(function(e){
        if(e.keyCode == 13){
            e.preventDefault();
            saveIssuedTo();
        }
    });

    $('select[name=category]').change(function(){
        if($(this).val().trim() != ''){
            $.ajax({
                type: 'GET',
                url: route+'/store/product/'+$(this).val(),
                data: {},
                success: function(result){
                    let html = '<option>Select Product</option>';
                    $.each(result.products, function(key,value){
                        html += '<option value="'+value.id+'">'+value.product_name+'</option>'
                    });
                    $('.products').html(html);
                }
            });
        }
    });
    let itemsList = []
    try{
        itemsList = JSON.parse($('input[name=list_items]').val());
    }catch(e){
    }
    drawHtml(itemsList);
    let itemsArray = [];
    $('.add_to_list').click(function(){
        let product = $('.products').val();
        let qty = $('.qty').val();
        let issuedTo = $('.issued_to_list').val();
        if(product == '' || qty == '' || issuedTo == ''){
            alert('Please fill all filed');
            return false;
        }
        let selectedPurchase = $('.purchase_stock_qty').val();
        let itemObject = {
            product: {id:$('.products').val(),text:$('.products option:selected').text()},
            qty: $('.qty').val(),
            issuedTo: {id:$('.issued_to_list').val(),text:$('.issued_to_list option:selected').text()},
            category: {id:$('.category').val(),text:$('.category option:selected').text()},
            purchase_stock: selectedPurchase
        };
        itemsList.push(itemObject);
        drawHtml(itemsList);
        $('.products').val('');
        $('.qty').val('');
        $('.issued_to_list').val('');
    });

    $('.show_voucher').click(function(){
           if($('.civ_no').val() != ''){
            window.location.href=route+"/store/civ/create/"+$('.civ_no').val();
        }
    });

    $('.products').change(function(){
        console.log($(this).val());
        $.ajax({
            type: 'GET',
            url: route+'/store/purchase-stock',
            data: {
                product_id: $(this).val()
            },
            success: function(result){
                $('.current_qty').val(result.current_qty);
            }
        });
    });
    $('body').on('click','.remove-record', function(){
        if(confirm('Are you sure to delete item from list?')){
            itemsList.splice($(this).data('index'),1);
            drawHtml(itemsList);
        }
    });
    $('.purchase_stock_qty').change(function(){
        let selectedPurchase = $(this).val();
        selectedPurchase = selectedPurchase.split('|');
        $('.current_qty').html(selectedPurchase[0]);
    });
});


function drawHtml(itemsArray){
    let html = '';
    $('.items').html('');
    $.each(itemsArray, function(key,value){
        html += `
                <tr>
                    <td>`+(key+1)+`</td>
                    <td>`+value.category.text+`</td>
                    <td>`+value.product.text+`</td>
                    <td>`+value.qty+`</td>
                    <td>`+value.issuedTo.text+`</td>
                    <td>
                        <a href="javascript:void(0)" class="remove-record" data-index="`+key+`"><i class="fa fa-trash-o text-danger"></i></a>
                    </td>
                </tr>
        `;
    });
    $('.items').html(html);
    $('input[name=list_items]').val(JSON.stringify(itemsArray));
}

function saveIssuedTo(){
    $.ajax({
        type: 'GET',
        url: route+'/store/save/issued_to',
        data: {
            issued_name: $('.issued_name').val()
        },
        success: function(result){
            if(result.status == false){
                alert(result.message);
                return false;
            }
            let html = '<option value="">Select Issued To</option>';
            $.each(result.issuedto_list, function(key,value ){
                html += '<option value="'+key+'">'+value+'</option>';
            });
            $('.issued_to_list').html(html);
            toastr.success('IssuedTo Saved Successfully!','Success');
            $('#create_issued_to').modal('hide');
            $('.issued_name').val('');
        }
    });
}
