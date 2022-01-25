$(function(){
    $('input[name=registration_no]').keydown(function(e){
        if(e.keyCode == 13){
            e.preventDefault();
            if($(this).val().trim() != ''){
                getPatientDetails($(this).val());
            }
        }
    });

    $("body").on("click",".duration_id",function() {
        var x = $(this).data('otid');
        console.log(x);

        $('input[name=OtId]').val(x);

    });

    // $('input').blur(function () {
    //     var y = $(this).val();
    //     alert(y);
    // });

});


$.ajax({
    type: 'GET',
    url: route+'/ot/surgeons',
    data: {},
    success: function (result) {
        console.log(result);
    }
})

function getPatientDetails(registration_no){
    $.ajax({
        type: 'GET',
        url: route+'/patient/details/byregistration/'+registration_no,
        data:{},
        success: function (result) {
            console.log(result);
            if(result.status == false){
                toastr.info('Patient not found!','No patient found');
                return;
            }
            $('.room_no').html(result.details.room_detail.room_no);
            $('.age_gender').html(result.details.patient_detail.age+'/'+result.details.patient_detail.gender.toUpperCase());
            $('.patient_name').html(result.details.patient_detail.name);
            $('input[name=registration_status]').val(result.details.id);
        }
    });
}
