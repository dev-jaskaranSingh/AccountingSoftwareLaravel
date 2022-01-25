$(function(){
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        // var target = $(e.target).attr("href") // activated tab
        $('.text-editor').summernote('toolbar.followScroll');
        $('body').scroll();
    });
    var $container = $("#hot-div");
    $container.handsontable({
        rowHeaders: true,
        data: getData(),
        colHeaders: true,
        contextMenu: true,
        fillHandle: {
            autoInsertRow: true
        },
        colWidths: 259,
        startRows: 1,
        minRows: 1,
        minSpareRows: 1,
        // dropdownMenu: true,
        colHeaders: ['Medicine','Units','Dosage','Days'],
        licenseKey: 'non-commercial-and-evaluation',
        contextMenu: ['row_above', 'row_below', 'remove_row','copy','cut'],
        columns:[
            {},
            {},
            {
                type: 'dropdown',
                source: ['Once','Twice','Thrice','At Night','SOS']
            },
            {}
        ],
        afterChange: function(change,source){
            if(source === 'loadData'){
                return;
            }
            var hotInstance = $("#hot-div").handsontable('getInstance');
            $('.json_hot_data').val(JSON.stringify(hotInstance.getData()));
        },
        afterRemoveRow: function(){
            var hotInstance = $("#hot-div").handsontable('getInstance');
            console.log(hotInstance.getData());
            $('.json_hot_data').val(JSON.stringify(hotInstance.getData()));
        }
    });

    $('.reg_no').keydown(function(e){
        if(e.keyCode == 13){
            e.preventDefault();
            window.location.href=route+'/patient-discharge-summary/'+$(this).val();
        }
    });

    $('.nav-tabs').scrollingTabs();
});


function getData(){
    let data = $('.json_hot_data').val();
    return JSON.parse(data);
}
