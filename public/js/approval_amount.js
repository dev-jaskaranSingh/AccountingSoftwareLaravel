$(function() {

    $('input[name=registration_no]').keydown(function (e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            window.location.href = route + '/approval/amount/?reg_no=' + $(this).val();
        }
    });

    $('input[name=claim_id]').keydown(function (e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            window.location.href = route + '/approval/amount/?claim_id=' + $(this).val();
        }
    });

    $('.discount_amount').keyup(function(){
        let totalDiscount = 0;
        $('.discount_amount').each(function(){
            if($(this).val() != ''){
                totalDiscount += parseInt($(this).val());
            }
        });
        let claimedAmount = parseInt($('input[name=claim_amount]').val());
        $('input[name=approved_amount]').val(claimedAmount - totalDiscount);
        $('input[name=disc]').val(totalDiscount);
    });

});
