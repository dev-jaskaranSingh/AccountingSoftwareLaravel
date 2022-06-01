function ajaxHandler(url, data, type, callback) {
    $.ajax({
        url: url, data: data, type: type, success: function (data) {
            callback(data);
        }
    });
}


$(".gstin").change(function () {
    var inputvalues = $(this).val();
    var gstinformat = new RegExp('^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]1}[1-9A-Z]{1}Z[0-9A-Z]{1}$');
    if (gstinformat.test(inputvalues)) {
        return true;
    } else {
        toastr.warning('Please Enter Valid GSTIN Number', 'Warning!');
        $(".gstin").focus();
    }
});

$(".pan").change(function () {
    var inputvalues = $(this).val();
    var regex = /[A-Z]{5}[0-9]{4}[A-Z]{1}$/;
    if (!regex.test(inputvalues)) {
        toastr.warning('Please Enter Valid PAN Number', 'Warning!');
        return regex.test(inputvalues);
    }
});

$(".mobile").change(function () {
    var inputvalues = $(this).val();
    var regex = /^[0-9]{10}$/;
    if (!regex.test(inputvalues)) {
        toastr.warning('Please Enter Valid Mobile Number', 'Warning!');
        return regex.test(inputvalues);
    }
});

$('body').on('change', '.dealer_type', function () {
    if ($(this).val() === 'unregister') {
        $('.gstin_group').hide();
    } else {
        $('.gstin_group').show();
    }
});

$('body').on('change', '.country', function () {
    var country_id = $(this).val();

    if($('.state option').length > 0){
        $('.state').empty();
    }

    if($('.city option').length > 0){
        $('.city').empty();
    }

    ajaxHandler(route + "/ajax/get-state-by-country", {country_id: country_id}, 'GET', function (data) {
        toastr.success('States loaded.', 'Success!');
        window.states = data.states;
        $('.state').select2({
            data: data?.states, placeholder: 'Select State'
        });
    });
});

$('body').on('change', '.state', function () {

    if($('.city option').length > 0){
        $('.city').empty();
    }

    var state_id = $(this).val();
    let statesArray = window.states;
    var selectedState = statesArray.find(item => item.id == state_id);
    $('.stateCode').val(selectedState?.tin);
    toastr.success('Cities loaded.', 'Success!');
    ajaxHandler(route + '/ajax/get-city-by-state', {state_id: state_id}, 'GET', function (data) {
        $('.city').select2({
            data: data?.cities, placeholder: 'Select City'
        });
    });
});
