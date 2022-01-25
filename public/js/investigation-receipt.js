$(function(){
    $('.uhid').keydown(function(e){
        let uhid = $(this).val();
        if(e.keyCode == 13){
            e.preventDefault();
            $.ajax({
                type: 'GET',
                url: route+'/patient/details/'+uhid,
                data:{},
                success: function(result){
                    console.log(result);
                    let patientDetails = result.selected_patient;
                    if(result.status == false){
                        toastr.error('Patient not found!','No patient found');
                    }else{
                        $('input[name=patient_name]').val(patientDetails.name);
                        $('select[name=gender]').val(patientDetails.gender);
                    }
                }
            });
        }
    });

    // $('select[name=charges_type]').change(function(){
    //     if($(this).val().trim() != ''){
    //         $.ajax({
    //             type: 'GET',
    //             url: route+'/investigation/charges-list/'+$(this).val(),
    //             data: {},
    //             success: function(result){
    //                 let chargesList = '<option value="">Select Charges</option>';
    //                 $.each(result.list_of_charges, function(key,value){
    //                     chargesList += '<option value="'+value.id+'">'+value.title+'</option>'
    //                 });
    //                 $('select[name=selected_charges]').html(chargesList);
    //             }
    //         });
    //     }
    //     console.log($(this).val());
    // });

    var selctedCharge = {};
    let dataArray = [];
    $('.add_to_list').click(function(){
        if($('.typeahead_2').val() != ''){
            var selectedChargesType = [$('select[name=charges_type]').val()];
            selectedChargesType.push($('select[name=charges_type] option:selected').text());
            dataArray.push({'charges_type':selectedChargesType,'charges':selctedCharge});
            drawTable(dataArray);
        }else{
            toastr.error('Please select the charges and then click on add to list');
            return false;
        }
    });

    $('input[name=total_amount]').keyup(function(){
        var lessAmount = 0;
        if($('input[name=less_amount]').val() != ''){
            lessAmount = parseInt($('input[name=less_amount]').val());
        }
        var netAmount = parseInt($(this).val() - lessAmount);
        $('.net-amount').text(netAmount);
    });

    $('input[name=less_amount]').keyup(function(){
        var totalAmount = 0;
        if($('input[name=total_amount]').val() != ''){
            totalAmount = parseInt($('input[name=total_amount]').val());
        }
        var netAmount = parseInt($(this).val() - totalAmount);
        $('.net-amount').text(Math.abs(netAmount));
    });

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

    let existingData = $('.charges-list').val();
    if(existingData.trim() != ''){
        var existingRcords = JSON.parse(existingData);
        dataArray = JSON.parse(existingData);
        drawTable(existingRcords);
    }

    $('body').on('click','.remove-from-list', function(){
        console.log(dataArray);
        dataArray.splice($(this).data('id'), 1);
        drawTable(dataArray);
    });
});

function drawTable(dataArray){
    let html = '';
    let index = 1;
    $('.charges-list').val(JSON.stringify(dataArray));
    $.each(dataArray, function(key,value){
        html +=`
            <tr>
                <td>`+index+`</td>
                <td>`+value.charges_type[1]+`</td>
                <td>`+value.charges[1]+`</td>
                <td>
                    <a href="javascript:void(0)" class="remove-from-list" data-id="`+key+`"><i class="fa fa-trash-o text-danger"></i></a>
                </td>
            </tr>
        `;
        index++;
    });
    $('.typeahead_2').val('');
    $('select[name=charges_type]').val('');
    $('.records').html(html);
}
