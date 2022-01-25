$(function(){
    var separator = "####";
    $.ajax({
        type: 'GET',
        url: route+'/investigation/charges-list',
        data:{},
        success: function(result){
            var data = [];
            for (var i = 0; i < result.list_of_charges.length; i++) {
                data.push(result.list_of_charges[i].id + separator + result.list_of_charges[i].title);
            }
            $(".typeahead_2").typeahead({
                source: data,
                updater: function (item) {
                    var parts = item.split(separator);

                    $('.selectedNaration').val(parts[0]);
                    $('.autocomplete').val(parts.shift());

                    selctedCharge = item.split(separator);
                    return parts.join(separator);
                },
                highlighter: function (item) {
                    var parts = item.split(separator);
                    parts.shift();
                    return parts.join(separator);
                },
            });
        }
    });




    $('input[name=registration_no]').keydown(function(e){
        if(e.keyCode == 13){
            let reg_no = $(this).val();
            e.preventDefault();
            $.ajax({
                type: 'GET',
                url: route+'/patient/details/byregistration/'+$(this).val(),
                data: {},
                success: function(result){
                    if(result.status != false){
                        $.ajax({
                            type: 'GET',
                            url: route+'/patient/charges/list/'+reg_no,
                            data: {},
                            success: function(resultCharges){
                                
                                $('.charges-list').html(resultCharges);
                            }
                        });

                        let patientType = {};
                        patientType['1'] = 'General';
                        patientType['2'] = 'ECHS';
                        patientType['3'] = 'Insurance';
                        $('input[name=uhid]').val(result.details.cuhid);
                        $('.gender_age').html(result.details.patient_detail.gender+' '+result.details.patient_detail.age)
                        $('.patient_name').html(result.details.patient_detail.name);
                        console.log(result.details);
                        if(result.details.ins_type != null){
                            $('.insuranceType').val(result.details.ins_type);
                            let insuranceType = (result.details.ins_type).toUpperCase();
                            $('.pateint_type').html(`${patientType[result.details.patient_type]} (${insuranceType})`);
                        }else{
                            $('.insuranceType').val("non-insurance");
                            $('.pateint_type').html(patientType[result.details.patient_type]);
                        }

                        $('.room_number').html(result.details.room_detail.location+' '+result.details.room_detail.room_no);
                        $('select[name=charges_head]').focus();
                    }else{
                        toastr.info('Patient not found!','No patient found');
                    }
                }
            });
        }
    });

    $.ajax({
        type: 'GET',
        url: route+'/patient/list/charges',
        data: {
            reg_no: $('input[name=registration_no]').val()
        },
        success: function(result){
            $('.charges-list').html(result);
        }
    });

    $('body').on('click','.delete-charges', function(){
        if(confirm('Are you sure to delete this charges?')){
            let index = $(this).data('index');
            $.ajax({
                type: 'GET',
                url: route+'/delete/patient/charges/'+index,
                data: {},
                success: function(result){
                    $('.charges-list').html(result);
                }
            });
        }
    });

    $('.add_to_list').click(function(){

        let errorStatus = false;
        let formData = {};
        $('.help-block').remove();
        $('.charges').each(function(){
            if($(this).val().trim() == '' && !$(this).hasClass('no-validation')){
                $(this).parent('.form-group').append(`<span class="help-block text-danger" role="alert"><strong>This field is required</strong></span>`);
                errorStatus = true;
            }
            formData[$(this).attr('name')] = $(this).val();
        });
        if(errorStatus == false){
            $.ajax({
                type: 'POST',
                url: route+'/patient/charges/store/charges',
                data: {
                    form: formData,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result){
                    $('.charges-list').html(result);
                    $('input[name=unit]').val('');
                    $('input[name=narration]').val('');
                    $('input[name=rate]').val('');
                    $('input[name=amount]').val('');
                }
            });
        }
    });

    $('input[name=unit]').keyup(function(){
        let unitValue = parseInt($(this).val());
        let rate = parseInt($('input[name=rate]').val());
        $('input[name=amount]').val(unitValue*rate);
    });

    $('input[name=rate]').keyup(function(){
        let rate = parseInt($(this).val());
        let unitValue = parseInt($('input[name=unit]').val());
        $('input[name=amount]').val(unitValue*rate);
    });

//    on change focus
    $('select[name=charges_head]').change(function(e){
        $('input[name=narration]').focus();
    });

    $('input[name=narration]').change(function(){
        let id = $('.selectedNaration').val();
        let patientInsuranceType = $('.insuranceType').val();
        if(patientInsuranceType != 'non-insurance'){
            if(patientInsuranceType == '' || patientInsuranceType == undefined || patientInsuranceType == null){
                $('input[name=registration_no]').focus();
                toastr['error']('Please Select Patient First !!');
                $(this).val("");
                return;
            }
            $.ajax({
                type: 'GET',
                url: route+'/investigation/charge/'+id,
                data:{},
                success: function(result){
                    if(patientInsuranceType == "gipsa"){
                        console.log(result.selectedCharge.gipsa_inc_charges);
                        $('.rate').val(result.selectedCharge.gipsa_inc_charges);
                    }
                    if(patientInsuranceType == "tpa"){
                        console.log(result.selectedCharge.tpa_ins_charges);
                        $('.rate').val(result.selectedCharge.tpa_ins_charges);
                    }
                    
                }
            });   
        }
        $('select[name=doctor]').focus();
    });

    $('select[name=doctor]').change(function(){
        $('input[name=unit]').focus();
    });

    $('input[name=unit]').keydown(function (e) {
        if(e.keyCode == 13 && $(this).val().trim() != ''){
            $('input[name=rate]').focus();
        }
    });

    $('input[name=rate]').keydown(function (e) {
       if(e.keyCode == 13 && $(this).val().trim() != ''){
           $('.add_to_list').trigger('click');
           $('select[name=charges_head]').focus();
       }
    });

    $('input[name=narration],input[name=unit],input[name=rate]').keydown(function(e){
        if(e.keyCode == 13){
            e.preventDefault();
        }
    });
});
