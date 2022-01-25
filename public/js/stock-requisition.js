$(function(){
    $('select[name=category_id]').change(function(){
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
    let itemsArray = [];
    if($('.items_array').val() != '' && $('.items_array').val() != null){
        itemsArray = JSON.parse($('.items_array').val());
        console.log(itemsArray);
        drawHtml(itemsArray);
    }

    $('.add_to_list').click(function(){
        if($('.products').val() == 'Select Product'){
            alert('Please select the product');
            return false;
        }
        let category = {id:$('select[name=category_id]').val(),text:$('select[name=category_id] option:selected').text()};
        let product = {id:$('.products').val(),text:$('.products option:selected').text()};
        let qty = $('.qty').val().trim();
        if(category == '' || product == '' || qty == ''){
            alert('Please enter correct details');
            return false;
        }
        let recordObject = {
            category:  category,
            product: product,
            qty: qty
        };
        itemsArray.push(recordObject);
        drawHtml(itemsArray);
        $('select[name=category_id]').val('');
        $('.products').val('');
        $('.qty').val('');
    });

    $('body').on('click','.remove-record', function(){
        if(confirm('Are you sure to delete item from list?')){
            itemsArray.splice($(this).data('index'),1);
            drawHtml(itemsArray);
        }
    });

    $('.save_department').click(function(){
        if($('.department_name').val().trim() == ''){
            alert('Please enter department name');
            return false;
        }
        $.ajax({
            type: 'GET',
            url: route+'/store/save/department',
            data: {
                department: $('.department_name').val()
            },
            success: function(result){
                if(result.status == false){
                    toastr.error(result.message,'Error');
                }else{
                    let html = '<option value="">Select Department</option>';
                    $.each(result.departments, function (key,value) {
                        html += '<option value="'+key+'">'+value+'</option>';
                    });
                    $('.department_dropdown').html(html);
                    toastr.success('Department saved successfully!','Success');
                    $('#create_department').modal('hide');
                }
            }
        });
    });
});

function drawHtml(itemsArray){
    $('.items').html('');
    let html = '';
    $.each(itemsArray, function(key,val){
        html += `
                <tr>
                    <td>`+(key+1)+`</td>
                    <td>`+val.category.text+`</td>
                    <td>`+val.product.text+`</td>
                    <td>`+val.qty+`</td>
                    <td>
                        <a href="javascript:void(0)" class="remove-record" data-index="`+key+`"><i class="fa fa-trash-o text-danger"></i></a>
                    </td>
                </tr>
            `;
    });
    $('.items').append(html);
    $('.items_array').val(JSON.stringify(itemsArray));
}
