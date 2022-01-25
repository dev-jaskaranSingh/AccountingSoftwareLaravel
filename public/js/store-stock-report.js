$(function(){
    $('select[name=category]').change(function(){
       getSubCategory($(this).val());
    });

    $('select[name=sub_category]').change(function(){
        let category = $('select[name=category]').val();
        getProducts(category,$(this).val());
    });
});


function getSubCategory(category){
    $.ajax({
        type: 'GET',
        url: route+'/store/sub-category/'+category,
        data:{},
        success: function(result){
            let subCategory = result.sub_categories;
            let html = '<option value="any">Any</option>';
            $.each(subCategory, function(key,value){
                html += '<option value="'+key+'">'+value+'</option>';
            });
            $('.sub-category').html(html);
        }
    });
}


function getProducts(category,subcategory){
    $.ajax({
        type: 'GET',
        url: route+'/store/product/'+category+'/'+subcategory,
        data: {},
        success: function(result){
            console.log(result);
            let html = '<option value="any">Any</option>';
            $.each(result.products, function(key,value){
                html += '<option value="'+value.id+'">'+value.product_name+'</option>';
            });
            $('select[name=products]').html(html);
        }
    });
}
