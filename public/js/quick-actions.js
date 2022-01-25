$(function(){

    /**
     * UHID
     */
    $('.uhidRegistration').click(function(){
        $.ajax({
            type:'GET',
            url: route+'/quick/uhid/create',
            data:{},
            success: function(result){
                $('.quick-action-modal').html(result);
                $('#create-uhid').modal('show');
                getStates($('.country'));
            }
        });
    });

    $('body').on('click','.save-uhid', function(e){
        let noValidate = ['email_id','mother_name'];
        e.preventDefault();
        let error = false;
        $('#quick_uhid_form').find('input, select, textarea').each(function(){
            if(!($.inArray($(this).attr('name'),noValidate) !== -1)){
                if($(this).val() == ''){
                    error = true;
                    $(this).parents('.form-group').addClass('has-error');
                }else{
                    $(this).parents('.form-group').removeClass('has-error');
                }
            }
        });
        if(error == false){
            $('#quick_uhid_form').submit();
        }
    });
    /**
     * UHID end
     */


    /**
     * Department
     */
    $('.createDepartment').click(function(){
        $.ajax({
            type:'GET',
            url: route+'/quick/department/create',
            data:{},
            success: function(result){
                $('.quick-action-modal').html(result);
                $('#create-department').modal('show');
            }
        });
    });

    $('body').on('click','.save-department', function(e){
        e.preventDefault();
        let error = false;
        $('#quick_department_form').find('input, select, textarea').each(function(){
            if($(this).val() == ''){
                error = true;
                $(this).parents('.form-group').addClass('has-error');
            }else{
                $(this).parents('.form-group').removeClass('has-error');
            }
        });
        if(error == false){
            $('#quick_department_form').submit();
        }
    });
    /**
     * Department end
     */


    /**
     * Designation
     */

    $('.createDesignation').click(function(){
        $.ajax({
            type: 'GET',
            url: route+'/quick/designation/create',
            data:{},
            success: function(result){
                $('.quick-action-modal').html(result);
                $('#create-designation').modal('show');
            }
        });
    });

    /**
     * Designation edn
     */


    /**
     * Misc Receipt
     */

    $('.miscReceipt').click(function(){
        $.ajax({
            type:'GET',
            url: route+'/quick/misc/create',
            data: {},
            success: function (result) {
                $('.quick-action-modal').html(result);
                $('#create-misc-receipt').modal('show');
                getUhid($('input[name=uhid]'));
                $('input,select').prop('disabled',true);
                $('input[name=uhid]').prop('disabled',false);
                setTimeout(function(){
                    $(".select2").select2();
                },1000);
            }
        });
    });

    $('body').on('click','.save-misc-receipt', function(e){
        e.preventDefault();
        let error = false;
        $('#quick_misc_receipt_form').find('input, select, textarea').each(function(){
            if($(this).val() == ''){
                error = true;
                $(this).parents('.form-group').addClass('has-error');
            }else{
                $(this).parents('.form-group').removeClass('has-error');
            }
        });
        if(error == false){
            $('#quick_misc_receipt_form').submit();
        }
    });

});