$(function(){
    $('.reg_no').keydown(function(e){
        if(e.keyCode == 13){
            e.preventDefault();
            window.location.href=route+"/doctor-certificate/"+$(this).val();
        }
    });
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        // var target = $(e.target).attr("href") // activated tab
        $('.text-editor').summernote('toolbar.followScroll');
        $('body').scroll();
    });
});
