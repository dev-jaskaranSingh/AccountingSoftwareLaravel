
$(function(){


    if($('input[name=cuhid]').val() != ''){
        getPatientDetails($('input[name=cuhid]'), function(result){
            $('input[name=name]').val(result.selected_patient.name);
            $('input[name=father_name]').val(result.selected_patient.father_name);
            $('input[name=mother_name]').val(result.selected_patient.mother_name);
            $('input[name=email]').val(result.selected_patient.email_id);
            $('input[name=mobile]').val(result.selected_patient.mobile);
            setTimeout(function(){
                $('select[name=country]').val(result.selected_patient.country).change();
            },500);
            setTimeout(function(){
                $('select[name=state]').val(result.selected_patient.state).change();
            },1000);
            setTimeout(function(){
                $('select[name=city]').val(result.selected_patient.city);
            },1500);
            $('input[name=age]').val(result.selected_patient.age);
            $('textarea[name=address]').val(result.selected_patient.address);
            console.log(result);
        });
    }
    $('input[name=cuhid]').keydown(function(e){
        if(e.keyCode == 13){
            e.preventDefault();
            getPatientDetails($(this), function(result){
                $('input[name=name]').val(result.selected_patient.name);
                $('input[name=father_name]').val(result.selected_patient.father_name);
                $('input[name=mother_name]').val(result.selected_patient.mother_name);
                $('input[name=email]').val(result.selected_patient.email_id);
                $('input[name=mobile]').val(result.selected_patient.mobile);
                setTimeout(function(){
                    $('select[name=country]').val(result.selected_patient.country).change();
                },500);
                setTimeout(function(){
                    $('select[name=state]').val(result.selected_patient.state).change();
                },1000);
                setTimeout(function(){
                    $('select[name=city]').val(result.selected_patient.city);
                },1500);
                $('input[name=age]').val(result.selected_patient.age);
                $('textarea[name=address]').val(result.selected_patient.address);
                console.log(result);
            });
        }
    });

    $('.admitted_id').change(function(){
        $.ajax({
            type: 'GET',
            url: route+'/rooms/list/'+$(this).val(),
            data: {},
            success: function(result){
                let html = '<option>Select Room</option>';
                $.each(result.rooms, function(key,value){
                    html += '<option value="'+value.id+'">'+value.room_no+'</option>';
                });
                $('.roomsList').html(html);
            }
        });
    });

    $('.patient_type').change(function(){
        if($(this).val() == 2 || $(this).val() == 4){
            $('.insurance_type').hide();
            $('.echs_type').show();
        }
        if($(this).val() == 3){
            $('.insurance_type').show();
            $('.echs_type').hide();
        }
    });

    $('.ins_comp').change(function(){
        $.ajax({
            type: 'GET',
            url: route+'/list/insurance/tpa/'+$(this).val(),
            data: {},
            success: function(result){
                let html = '<option>Select TPA</option>';
                $.each(result.list_tpa, function(key,value){
                    html += '<option value="'+value.id+'">'+value.name+'</option>';
                });
                $('.list_tpa').html(html);
            }
        });

        $.ajax({
            type: 'GET',
            url: route+'/list/insurance/gipsa/'+$(this).val(),
            data: {},
            success: function(result){
                let html = '<option>Select Gipsa</option>';
                $.each(result.list_tpa, function(key,value){
                    html += '<option value="'+value.id+'">'+value.name+'</option>';
                });
                $('.list_gipsa').html(html);
            }
        })
    });

    $('.ins_type').change(function(){
        if($(this).val() === '1'){
            $('.list_tpa_group').hide();
            $('.list_gipsa_group').show();
            $('.list_tpa').val();
        }

        if($(this).val() === '0'){
            $('.list_tpa_group').show();
            $('.list_gipsa_group').hide();
            $('.list_gipsa').val();
        }

        console.log($(this).val());
    })
});

function getPatientDetails(elem, callback){
    $.ajax({
        type: 'GET',
        url: route+'/patient/details/'+elem.val(),
        data:{},
        success: function (result){
            if(result.status == false){
                toastr.info('Patient not found!','No patient found');
            }
            callback(result);
        }
    });
}


