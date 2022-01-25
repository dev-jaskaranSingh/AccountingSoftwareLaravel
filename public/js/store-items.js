$(function(){
    $('.category').change(function(){
        if($(this).val().trim() != ''){
            getSubCategory($(this).val());
        }
    });
});

function getSubCategory(category){
    $.ajax({
        type: 'GET',
        url: route+'/store/sub-category/'+category,
        data: {},
        success: function(result){
            let html = '<option value="">Select Sub-Category</option>';
            $.each(result.sub_categories, function(key,value){
                html += '<option value="'+key+'">'+value+'</option>';
            });
            html += '<option value="">No Subcategory</option>';
            $('.sub_category').html(html);
        }
    });
}
