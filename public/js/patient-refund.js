$(function(){
    $('.reg_no').keydown(function(e){
        if(e.keyCode == 13){
            e.preventDefault();
            window.location.href = route+'/patient-refund/'+$(this).val();
        }
    });
});