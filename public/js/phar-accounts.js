$(function(){
    $('.save_subgroup').click(function(e){
        e.preventDefault();
        let elem = $(this);
        let name = $('.sub_group_name').val();
        if(name != ''){
            $.ajax({
                type: 'POST',
                url: route+'/pharmacy/subgroup/save',
                data: {
                    sub_group_name: name
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result){
                    if(result.status == true){
                        let html = '<option>Select Sub Group</option>';
                        $.each(result.sub_groups, function(key,val){
                            html += '<option value="'+val.id+'">'+val.sub_group+'</option>';
                        });
                        $('.sub_groups').html(html);

                        $('#sub_group').modal('hide');
                    }
                }
            });
        }else{
            alert('Please fill sub group name');
            return false;
        }
    });
});
