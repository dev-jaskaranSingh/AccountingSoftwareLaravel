$(function(){
    // Event for `keydown` event. Add condition after delay of 200 ms which is counted from time of last pressed key.
    var debounceFn = Handsontable.helper.debounce(function (colIndex, event) {
        var hot = $("#hot-table").handsontable('getInstance');
        var filtersPlugin = hot.getPlugin('filters');

        filtersPlugin.removeConditions(colIndex);
        filtersPlugin.addCondition(colIndex, 'contains', [event.realTarget.value]);
        filtersPlugin.filter();
    }, 200);

    var addEventListeners = function (input, colIndex) {
        input.addEventListener('keydown', function(event) {
            debounceFn(colIndex, event);
        });
    };

// Build elements which will be displayed in header.
    var getInitializedElements = function(colIndex) {
        var div = document.createElement('div');
        var input = document.createElement('input');

        div.className = 'filterHeader';
        input.placeholder = 'Type to Search';
        input.className = 'form-control';
        addEventListeners(input, colIndex);

        div.appendChild(input);

        return div;
    };

// Add elements to header on `afterGetColHeader` hook.
    var addInput = function(col, TH) {

        // Hooks can return value other than number (for example `columnSorting` plugin use this).
        if (typeof col !== 'number') {
            return col;
        }

        if (col >= 0 && TH.childElementCount < 2) {
            if(col != 1){

                TH.appendChild(getInitializedElements(col));
            }
        }
    };

// Deselect column after click on input.
    var doNotSelectColumn = function (event, coords) {
        if (coords.row === -1 && event.realTarget.nodeName === 'INPUT') {
            event.stopImmediatePropagation();
            this.deselectCell();
        }
    };

    var $container = $("#hot-table");
    $container.handsontable({
        rowHeaders: true,
        className: 'as-you-type-demo',
        filters: true,
        afterGetColHeader: addInput,
        beforeOnCellMouseDown: doNotSelectColumn,
        data: getData(),
        colHeaders: true,
        contextMenu: true,
        startRows: 1,
        startCols: 2,
        minRows: 1,
        colHeaders: ['Description','Units'],
        licenseKey: 'non-commercial-and-evaluation',
        contextMenu: ['copy','cut'],
        colWidths: [500, 100],
        hiddenColumns: {
            columns: [2],
            indicators: true
        },
        columns:[
            {
                readOnly: true
            },
            {
                type: 'numeric'
            },
            {
                type: 'numeric'
            }
        ],
        afterChange: function(change,source){
            if(source === 'loadData'){
                return;
            }
            var hotInstance = $("#hot-table").handsontable('getInstance');
            //console.log(hotInstance.getData());
            $('.lab_charges_details').val(JSON.stringify(hotInstance.getData()));
        },
        afterRemoveRow: function(){
            var hotInstance = $("#hot-table").handsontable('getInstance');
            //console.log(hotInstance.getData());
            $('.lab_charges_details').val(JSON.stringify(hotInstance.getData()));
        }
    });

    $('input[name=registration_no]').keydown(function(e){
        if(e.keyCode == 13){
            e.preventDefault();
            window.location.href=route+"/lab/req/slip?reg="+$(this).val();
        }
    });

    $('input[name=uhid]').keydown(function(e){
        if(e.keyCode == 13){
            e.preventDefault();
            window.location.href=route+"/lab/req/slip?uhid="+$(this).val();
        }
    });

});


function getData(){
    let data = $('.lab_charges_details').val();
    return JSON.parse(data);
}
