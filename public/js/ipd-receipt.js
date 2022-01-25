$(function(){
    if($('.reg_no').val() != ''){
        getPatientDetails($('.reg_no'), function(result){
            console.log(result);
            $('.patient_name').html(result.details.patient_detail.name);
            $('.gender_age').html(result.details.patient_detail.gender+'/'+result.details.patient_detail.age);
            $('.room_no').html(result.details.room_detail.room_no);
            // $('.prev_receipt').html(result.details.name);
        });
    }
    $('.reg_no').keydown(function(e){
        if(e.keyCode == 13){
            e.preventDefault();
            getPatientDetails($(this), function(result){
                console.log(result);
                $('.patient_name').html(result.details.patient_detail.name);
                $('.gender_age').html(result.details.patient_detail.gender+'/'+result.details.patient_detail.age);
                $('.room_no').html(result.details.room_detail.room_no);
                // $('.prev_receipt').html(result.details.name);

            });
        }
    });
});


function getPatientDetails(elem, callback){
    $.ajax({
        type: 'GET',
        url: route+'/patient/details/byregistration/'+elem.val(),
        data:{},
        success: function (result){
            if(result.status == false){
                toastr.info('Patient not found!','No patient found');
            }
            callback(result);
        }
    });
}
