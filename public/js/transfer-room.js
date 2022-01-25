$(function(){
    $('.transfer_to').change(function(){
        $.ajax({
            type: 'GET',
            url: route+'/rooms/list/'+$(this).val(),
            data: {},
            success: function(result){
                let html = '<option>Select Room</option>';
                $.each(result.rooms, function(key,value){
                    html += '<option value="'+value.id+'">'+value.room_no+'</option>';
                });
                $('.to_transfer').html(html);
            }
        });
    });

    $('.registration_no').keyup(function(e){
        if(e.keyCode == 13){
            e.preventDefault();
            if($(this).val().trim() != ''){
                window.location.href = route+'/rooms/transfer/'+$(this).val();
            }
        }
    });
});
