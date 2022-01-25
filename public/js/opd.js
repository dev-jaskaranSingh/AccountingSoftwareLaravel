$(function(){
    $('input,select').attr('disabled',true);
    $('input[name=uhid]').attr('disabled',false);
    $('input[name=uhid]').blur(function(){
        if($(this).val().trim() != ''){
            getPatientDetails($(this));
        }else{
            $('input,select').attr('disabled',true);
            $('input[name=uhid]').attr('disabled',false);
            $('.patient_name').html('');
        }
    });

    $('.patient_type').change(function(){
        if($(this).val() == 4 || $(this).val() == 5){
            $('.amount-data').val(0);
        }else{
            $('.amount-data').val(400);
        }
    });

    $('.emergn').click(function(){
        if($(this).is(':checked')){
            $('.amount-data').val(600);
        }
    });
});
$(document).ready(function(){
    if($('input[name=uhid]').val().trim() != ''){
        getPatientDetails($('input[name=uhid]'));
    }
});

function getPatientDetails(elem){
    showLoading('loading-label');
    elem.prop('readonly',true);
    $.ajax({
        type: 'GET',
        url: route+'/patient/details/'+elem.val(),
        data:{},
        success: function(result){
            console.log(result);
            elem.prop('readonly',false);
            if(result.status != false){
                result = result.selected_patient;
                if(result.gender == 'm' || result.gender == 'male'){
                    $('select[name=gender]').val('male');
                }else{
                    $('select[name=gender]').val('female');
                }
                
                $('.newUHID').val(result.uhid);
                $('input[name=mobile]').val(result.mobile);
                $('input[name=age]').val(result.age);
                $('input,select').attr('disabled',false);
                $('.patient_name').html('('+result.name+ ')');
                $('.patient_id').val(result.id);
                
                toastr.success('Patient with UHID found','Patient Found!');
            }else{
                toastr.error('Patient not found!','No patient found');
            }
            hideLoading();
        }
    });
}
