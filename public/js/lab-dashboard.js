$(document).ready(function(){
    startInterval();
    $('.testsList').mouseenter(function(){
        stopInterval();
        $('.warning-message').fadeIn(300);
        console.log('entered');
    });
    $('.testsList').mouseleave(function(){
        startInterval();
        $('.warning-message').fadeOut(300);
        console.log('leaved');
    });

    $('body').on('click','.reject_test', function(){
        $('.record_id').val($(this).data('id'));
        $('#rejectModal').modal('show');
    });

    $('input[name=uhid], input[name=reg_no]').keyup(function(){
        refreshList();
    });

    $('input[name=date], select[name=patient_type]').change(function(){
        refreshList();
    });

    $('.reset-filters').click(function(){
        $('input').val('');
        $('select').val(0).trigger('change');
    });

    $('body').on('click','.reject_single_test', function(){
        let testId = $(this).data('test-id');
        let testIndex = $(this).data('test-index');
        let elem = $(this);
        if(confirm('Are you sure to reject the test?')){
            let reason = prompt('Enter the reason to reject the test');
            $.ajax({
                type: 'GET',
                url: route+'/lab/reject/single/test',
                data: {
                    reason: reason,
                    index: testIndex,
                    id: testId
                },
                success: function(result){
                    toastr.info('Rejected','Test rejected successfully!');
                    elem.parents('.test-row').remove();
                }
            });
        }
    });

    $('body').on('click','.update_status', function(){
        let status = $(this).data('status');
        let id = $(this).data('id');
        $.ajax({
            type: 'GET',
            url: route+'/lab/update/status',
            data: {
                status: status,
                id: id
            },
            success: function(result){
                console.log(result);
            }
        });
    });
});

function startInterval(){
    window.refreshInterval = setInterval(function(){
        refreshList();
    },2000);
}

function stopInterval(){
    clearInterval(window.refreshInterval);
}

function refreshList(){
    let filterData = {};
    filterData['reg_no'] = $('input[name=reg_no]').val();
    filterData['uhid'] = $('input[name=uhid]').val();
    filterData['patient_type'] = $('select[name=patient_type]').val();
    filterData['date'] = $('input[name=date]').val();
    $.ajax({
        type: 'GET',
        url: route+'/lab/tests/list',
        data: filterData,
        success: function(result){
            if(window.lastCount != undefined && window.lastCount != null && window.lastCount != ''){
                if(parseInt($('.test-count').val()) > window.lastCount){
                    $('audio#pop')[0].play();
                    toastr.info('New Lab Test Assigned','Please Check you new test info');
                }
            }
            window.lastCount = parseInt($('.test-count').val());
            $('.testsList').html(result);
            $('.footable').footable();
        }
    });
}
