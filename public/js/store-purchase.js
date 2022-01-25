$(function(){
    // $('input[name=bill_no]').keydown(function(e) {
    //     if(e.keyCode == 13){
    //         e.preventDefault();
    //         let partyId = $('.party_id').val();
    //         window.location.href = route+"/store/purchase/"+$(this).val()+"/"+partyId;
    //     }
    // });

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

    $('.qty, .per_item_cost, .misc_charges, .tax').keyup(function(){

        let misc_charges = $('.misc_charges').val().trim();
        let qty = $('.qty').val().trim();
        let perItemCost = $('.per_item_cost').val().trim();
        let taxPercentage = $('.tax').val().trim();

        if(qty != '' && perItemCost != '' && misc_charges != ''){
            let BeforeTax =(parseInt(qty) * parseInt(perItemCost)) + parseInt(misc_charges);
            if(taxPercentage != '' && taxPercentage != 0){
                let TaxAmount = BeforeTax * parseInt(taxPercentage) / 100;
                let AfterTax = BeforeTax + TaxAmount;
                $('.total_cost').val(AfterTax);
                console.log(TaxAmount);
            }else{
                $('.total_cost').val(BeforeTax);
            }
        }
    });
    let itemsArray = [];
    let itemJson = $('.items_json').val();
    if(itemJson !== undefined){
        itemJson = itemJson.trim();
    if(itemJson == ''){
        localStorage.removeItem('purchase_items');
    }else{
        let recordJson = JSON.parse($('.items_json').val());
        $.each(recordJson, function(key,value){
            let recordObject = {
                category: {id:value.product.category.id, text:value.product.category.category},
                product: {id:value.product.id, text:value.product.product_name},
                qty: value.qty,
                cost_per_item: value.cost_per_item,
                misc_charges: value.misc_charges,
                tax: value.tax_percent,
                total_cost: value.total_cost
            };
            itemsArray.push(recordObject);
        });
    }
}
    let storedItems = localStorage.getItem('purchase_items');
    if(storedItems != null){
        try{
            storedItems = JSON.parse(storedItems);
            itemsArray = storedItems;
        }catch(e){
        }
    }

    drawHtml(itemsArray);
    $('.add_to_list').click(function(){

        if($('.products').val() == "Select Product"){
            alert('Please Select Product !!');
            $('.products').focus();
            return 0;
        }


        let category = {id: $('.category').val(), text: $('.category option:selected').text()};
        let product = {id:$('.products').val(),text:$('.products option:selected').text()};
        let qty = $('.qty').val();
        let cost_per_item = $('.per_item_cost').val();
        let misc_charges = $('.misc_charges').val();
        let tax = $('.tax').val();
        let total_cost = $('.total_cost').val();
        if(category == '' || product == '' || qty == '' || cost_per_item == '' || misc_charges == '' || tax == '' || total_cost == ''){
            alert('Please fill all fields!');
            return false;
        }

        let recordObject = {
            category: category,
            product: product,
            qty: qty,
            cost_per_item: cost_per_item,
            misc_charges: misc_charges,
            tax: tax,
            total_cost: total_cost
        };
        console.log(recordObject)
        itemsArray.push(recordObject)
        localStorage.setItem('purchase_items',JSON.stringify(itemsArray));
        drawHtml(itemsArray);
        $('.category').val('');
        $('.products').val('');
        $('.qty').val(0);
        $('.per_item_cost').val(0);
        $('.misc_charges').val(0);
        $('.tax').val(0);
        $('.total_cost').val(0);
        toastr.info('Added To List','Item Added into list');
    });

    $('body').on('click','.remove-record',function(){
        if(confirm('Are you sure to delete this entry?')){
            itemsArray.splice($(this).data('index'),1);
            localStorage.setItem('purchase_items',JSON.stringify(itemsArray));
            drawHtml(itemsArray);
        }
    });

    $('.save_party').click(function(){
        if($('.party_name').val().trim() == ''){
            alert('Please enter party name');
            return false;
        }
        $.ajax({
            type: 'GET',
            url: route+'/store/save/party',
            data: {
                party_name: $('.party_name').val()
            },
            success: function(result){
                if(result.status == false){
                    alert('Error: '+result.message);
                }
                let partyHtml = '<option value="">Select Party</option>';
                $.each(result.parties, function(key,value){
                    partyHtml += '<option value="'+key+'">'+value+'</option>';
                });
                $('select[name=party_id]').html(partyHtml);
                $('#partyModal').modal('hide');
                toastr.success('Party saved successfully!','Success');
            }
        });
    });

});

function drawHtml(itemsArray){
    console.log(itemsArray)
    $('.items').html('');
    let html = '';
    let totalAmount = 0;
    $.each(itemsArray, function(key,val){
        totalAmount += parseInt(val.total_cost);
        html += `
                <tr>
                    <td>${(key+1)}</td>
                    <td>${val.product.text}</td>
                    <td>${val.category.text}</td>
                    <td>${val.qty}</td>
                    <td>${val.cost_per_item}</td>
                    <td>${val.misc_charges}</td>
                    <td>${val.tax}</td>
                    <td>${val.total_cost}</td>
                    <td>
                        <a href="javascript:void(0)" class="remove-record" data-index="${key}"><i class="fa fa-trash-o text-danger"></i></a>
                    </td>
                </tr>
            `;
    });
    if($('.total_bill_amount').html() == ''){
        $('.total_bill_amount').html(totalAmount+'/-');
    }
    $('.items').append(html);
    $('.items_json').val(JSON.stringify(itemsArray));
}
