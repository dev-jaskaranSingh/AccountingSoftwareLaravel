$(function(){
    localStorage.removeItem('listTests');
    if($('.test_details').val() != ''){
        localStorage.setItem('listTests',$('.test_details').val());
    }
    $('.registration_no').keyup(function(e){
        if(e.keyCode == 13){
            e.preventDefault();
            window.location.href = route+"/lab/report/"+$(this).val();
        }
    });
    $('.show_report').click(function(){
         if($('.registration_no').val().trim() != ''){
             window.location.href = route+"/lab/report/"+$('.registration_no').val();
         }
    });

    $('body').on('change','.lab-test', function(){
        let amount = $(this).find('option:selected').data('amount');
        let svMale = $(this).find('option:selected').data('male');
        let svFemale = $(this).find('option:selected').data('female');
        if($('.gender').val() == 'female'){
            $('.std_value').val(svFemale);
        }else{
            $('.std_value').val(svMale);
        }
        $('.test_amount').val(amount);
    });
    window.testObjectRecords = localStorage.getItem('listTests');
    try{
        if(testObjectRecords == null){
            testObjectRecords = [];
        }else{
            testObjectRecords = JSON.parse(testObjectRecords);
        }
    }catch(e){
    }

    console.log(testObjectRecords);
    Array.prototype.insert = function ( index, item ) {
        this.splice( index, 0, item );
    };
    $('.add_to_list').click(function(){
        if($('.test_value').val() != ''){
            let singleRecord = {};
            singleRecord['selected_test'] = $('.lab-test').val();
            singleRecord['selected_test_text'] = $('.lab-test').find('option:selected').data('text');
            singleRecord['test_value'] = $('.test_value').val();
            singleRecord['std_value'] = $('.std_value').val();
            singleRecord['amount'] = $('.test_amount').val();
            if($('.is_actual').is(':checked')){
                singleRecord['is_actual'] = 'Yes';
            }else{
                singleRecord['is_actual'] = 'No';
            }
            if($('.is_exc').is(':checked')){
                singleRecord['is_exc'] = 'Yes';
            }else{
                singleRecord['is_exc'] = 'No';
            }
            if($('.insert_at').val().trim() != ''){
                let index = parseInt($('.insert_at').val()) - 1;
                testObjectRecords.insert(index,singleRecord);
            }else{
                testObjectRecords.push(singleRecord);
            }
            setLocalStorageData(testObjectRecords);
            $('.lab-test').val('').trigger('change');
            $('.test_value').val('');
            $('.std_value').val('');
            $('.test_amount').val('');
            $('.insert_at').val('');
            $('.is_actual').prop('checked',false);
            $('.is_exc').prop('checked',false);
        }else{
            alert('Please enter test value');
        }
        drawTable();
        $('.lab-test').focus();
    });
    $('body').on('click','.delete-row', function(){
        let records = localStorage.getItem('listTests');
        records = JSON.parse(records);
        records.splice($(this).data('index'),1);
        setLocalStorageData(records);
        drawTable();
    });
    drawTable();

    $('.save_template').click(function(){
        let currentRecords = localStorage.getItem('listTests');
        if(currentRecords != null){
            let csrf_token = $('meta[name="csrf-token"]').attr('content');
            let templateName = $('.template_name').val();
            $.ajax({
                type: 'POST',
                url: route+'/lab/report/template/save',
                data: {_token: csrf_token, details: currentRecords,name: templateName},
                success: function(result){
                    if(result.status == true){
                        $('#saveTemplate').modal('hide');
                        drawTemplateOptionsList(result);
                    }
                }
            });
        }
    });
    getTemplates();

    $('.create_template').click(function(){
        let currentRecords = localStorage.getItem('listTests');
        if(currentRecords != null){
            $('#saveTemplate').modal('show');
        }else{
            alert('Please add tests into list to craete template');
        }
    });

    $('.templates_list').change(function(){
        if($(this).val() != '') {
            $('.delete_template').show();
            let testContent = $(this).find('option:selected').data('content');
            setLocalStorageData(testContent);
            window.testObjectRecords = testContent;
            drawTable();
        }else{
            $('.delete_template').hide();
        }
    });

    $('.delete_template').click(function () {
        if(confirm('Are you sure to delete this template?')){
            let templateToDelete = $('.templates_list').val();
            $.ajax({
                type: 'GET',
                url: route+'/lab/template/delete/'+templateToDelete,
                data: {},
                success: function(result){
                    drawTemplateOptionsList(result);
                }
            });
        }
    });

    $('body').on('blur','.autosave_test_value', function(){
        let records = JSON.parse(localStorage.getItem('listTests'));
        records[$(this).parents('tr').data('index')]['test_value'] = $(this).val();
        setLocalStorageData(records);
    });
    $('body').on('blur','.autosave_amount', function(){
        let records = JSON.parse(localStorage.getItem('listTests'));
        records[$(this).parents('tr').data('index')]['amount'] = $(this).val();
        setLocalStorageData(records);
    });

    $('body').on('click','.autosave_is_actual', function(){
        let records = JSON.parse(localStorage.getItem('listTests'));
        let isActualValue = '';
        if($(this).is(':checked')){
            isActualValue = 'Yes';
        }else{
            isActualValue = 'No';
        }
        records[$(this).parents('tr').data('index')]['is_actual'] = isActualValue;
        setLocalStorageData(records);
    });

    $('body').on('click','.autosave_is_exc', function(){
        let records = JSON.parse(localStorage.getItem('listTests'));
        let isExcValue = '';
        if($(this).is(':checked')){
            isExcValue = 'Yes';
        }else{
            isExcValue = 'No';
        }
        records[$(this).parents('tr').data('index')]['is_exc'] = isExcValue;
        setLocalStorageData(records);
    });

    $(".search-test").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".test-table tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $('.make-clone').click(function(){
        let record_id = $(this).data('id');
        let reg_no = $(this).data('reg_no');
        $('.clone_registration_no').val(reg_no);
        $('.clone_record_id').val(record_id);
        $('#makeClone').modal('show');
    });

    $('.create_record_clone').click(function(e){
        if($('.test_date').val() == ''){
            e.preventDefault();
            alert('Please select the date');
            return false;
        }
    });
});

function setLocalStorageData(data){
    localStorage.setItem('listTests',JSON.stringify(data));
    $('.test_details').val(JSON.stringify(data));
}

function drawTemplateOptionsList(result){
    let listTemplates = result.listTemplate;
    let optionsHtml = '<option value="">Select Template</option>';
    $.each(listTemplates, function(key,value){
        optionsHtml += `<option value="`+value.id+`" data-content='`+value.template_content+`'>`+value.title+`</option>`;
    });
    $('.templates_list').html(optionsHtml);
}

function getTemplates(){
    $.ajax({
        type: 'GET',
        url: route+'/lab/templates',
        data: {},
        success: function(result){
            drawTemplateOptionsList(result);
        }
    });
}

function drawTable(){
    let records = localStorage.getItem('listTests');
    if(records != null && records != 'undefined'){
        records = JSON.parse(records);
        let tableRow ='';
        $.each(records, function(key,value){
            tableRow += `
                    <tr data-index="`+key+`">
                        <td align="center">`+(parseInt(key)+1)+`</td>
                        <td width="400">`+value.selected_test_text+`</td>
                        <td width="100"><input type="text" class="form-control autosave_test_value" value="`+value.test_value+`" /></td>
                        <td width="100">`+value.std_value+`</td>
                        <td width="100"><input type="text" class="form-control autosave_amount" value="`+value.amount+`" /></td>
                        <td width="100">`;
                            if(value.is_actual == 'Yes'){
                                tableRow += `<input type="checkbox" value="" class="autosave_is_actual" name="is_actual" checked />`
                            }else{
                                tableRow += `<input type="checkbox" value="" class="autosave_is_actual" name="is_actual" />`
                            }

            tableRow +=
                        `</td>
                        <td width="100">`;
                            if(value.is_exc == 'Yes'){
                                tableRow += `<input type="checkbox" value="" class="autosave_is_exc" name="is_exc" checked />`;
                            }else{
                                tableRow += `<input type="checkbox" value="" class="autosave_is_exc" name="is_exc" />`;
                            }
            tableRow +=
                        `</td>
                        <td>
                            <i class="fa fa-trash-o text-danger delete-row" style="cursor: pointer" data-index="`+key+`"></i>
                        </td>
                    </tr>`;
        });
        $('.table-rows').html(tableRow);
        $('.table-rows').sortable({
            stop: function(event,ui){
                let records = localStorage.getItem('listTests');
                if(records != null && records != 'undefined') {
                    records = JSON.parse(records);
                }
                let newOrder = [];
                $('.table-rows tr').each(function(){
                    newOrder.push(records[$(this).data('index')]);
                });
                setLocalStorageData(newOrder);
                drawTable();
            }
        });
    }
}
