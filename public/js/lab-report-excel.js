$(function(){
    $('.reg_no').keyup(function(e){
        if(e.keyCode == 13){
            if($(this).val().trim() != ''){
                window.location.href = route+'/lab/report/generate/excel/'+$(this).val().trim();
            }
        }
    });

    var $container = $("#hot-table");
    $container.handsontable({
        rowHeaders: true,
        className: 'column-for-search',
        filters: true,
        data: getData(),
        colHeaders: true,
        contextMenu: true,
        minRows: 1,
        colHeaders: getColumns(),
        licenseKey: 'non-commercial-and-evaluation',
        contextMenu: ['row_above','row_below','remove_row','---------','undo','redo','copy','cut'],
        colWidths: 150,
        manualColumnFreeze: true,
        fixedColumnsLeft: 1,
        afterChange: function(change,source){
            if(source === 'loadData'){
                var hotInstance = $("#hot-table").handsontable('getInstance');
                let data = hotInstance.getSourceData();
                $('.data_for_excel').val(JSON.stringify(data));
                return;
            }
            var hotInstance = $("#hot-table").handsontable('getInstance');
            var row = change[0][0];
            var col = change[0][1];
            if(change[0][1] === 'total_qty' && change[0][3] !== '' && change[0][3] !== change[0][2]) {
                let data = hotInstance.getSourceData();;
                let calculatedData = data[hotInstance.getCellMeta(row, col).row];
                if (!isNaN(parseInt(change[0][3]))) {
                    calculatedData['amount'] = calculatedData['avg_amount'] * parseInt(change[0][3]);
                } else {
                    calculatedData['amount'] = calculatedData['amount'];
                }
                data[hotInstance.getCellMeta(row, col).row] = calculatedData;
                let totalAmount = 0;
                $.each(data,function(key,value){
                    totalAmount += value.amount;
                });
                data[data.length - 1]['amount'] = totalAmount;
                hotInstance.loadData(data);
                $('.data_for_excel').val(JSON.stringify(data));
            }
        },
        afterRemoveRow: function(){
        }
    });
});

function getData(){
    let data = $('.data_to_draw').val();
    return JSON.parse(data);
}

function getColumns(){
    let columns = $('.columns').val();
    return JSON.parse(columns)
}
