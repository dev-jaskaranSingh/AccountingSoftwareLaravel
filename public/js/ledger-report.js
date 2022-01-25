$(function(){
    $('.select_all').click(function(){
        if($(this).is(':checked')){
            $('.record_select').prop('checked','checked');
        }else{
            $('.record_select').prop('checked',false);
        }
    });
    $('table tr').click(function(){
        if($(this).find('.record_select').is(':checked')){
            $(this).find('.record_select').prop('checked',false);
        }else{
            $(this).find('.record_select').prop('checked','checked');
        }
    });

    $('.view_ledger').click(function(){
        let regArray = [];
        $('.record_select').each(function(){
            if($(this).is(':checked')){
                regArray.push($(this).val());
            }
        });
        window.location.href = route+"/report/patients/ledger/print/"+JSON.stringify(regArray);
    });
});
