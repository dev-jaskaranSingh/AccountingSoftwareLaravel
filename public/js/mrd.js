$(function(){
    $('input[name=registration_no]').keydown(function(e){
        if(e.keyCode == 13){
            e.preventDefault();
            window.location.href=route+"/medical/records/"+$(this).val();
        }
    });
})
