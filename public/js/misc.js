$(function(){
    $('input,select').prop('disabled',true);
    $('input[name=uhid]').prop('disabled',false);
    $('body').on('blur','input[name=uhid]', function(){
        if($(this).val().trim() != ''){
            getUhid($(this));
        }
    });

    $('body').on('change','select[name=charges_type]', function () {
        getreciptSerial($(this).val());
        if($(this).val() == 3){
            $('.xray-list').show();
        }else{
            $('.xray-list').hide();
        }
    });

    let netTotal = $('input[name=total_amount]').val();
    if($('input[name=less_amount]').val() != ''){
        netTotal = netTotal - parseInt($('input[name=less_amount]').val());
    }
    $('.net_amount').text(netTotal);

    $('.net_amount').text(parseInt($('input[name=total_amount]').val()) - $('input[name=less_amount]').val());

    $('body').on('keyup','input[name=total_amount]', function(){
        let netTotal = $(this).val();
        if($('input[name=less_amount]').val() != ''){
            netTotal = netTotal - parseInt($('input[name=less_amount]').val());
        }
        $('.net_amount').text(netTotal);
    });

    $('body').on('keyup','input[name=less_amount]', function(){
        $('.net_amount').text(parseInt($('input[name=total_amount]').val()) - $(this).val());
    });

    $('.put_uhid').click(function(){
        $('input[name=uhid]').val($(this).text());
        getUhid($('input[name=uhid]'));
    });
});

function getDefaultAmount(elem){
    $.ajax({
        type: 'GET',
        url: route+'/',
        data: {},
        success: function(result){
            console.log(result);
        }
    });
}

function getUhid(elem){
    if(elem.val() != ''){
        $.ajax({
            type: 'GET',
            url: route+'/patient/details/'+elem.val(),
            data:{},
            success: function (result) {
                if(result.status == false){
                    toastr.info('Patient not found!','No patient found');
                    $('input,select').prop('disabled',true);
                    $('input[name=uhid]').prop('disabled',false);
                    return false;
                }
                $('input,select').prop('disabled',false);
                $('input[name=patient_name]').val(result.selected_patient.name);
                $('input[name=gender_age]').val(result.selected_patient.gender);
            }
        });
    }
}

function getreciptSerial(type){
    $.ajax({
        type: 'GET',
        url: route+'/receipt/serial/'+type,
        data:{},
        success: function(result){
            $('input[name=receipt_no]').val(parseInt(result)+1);
        }
    })
}