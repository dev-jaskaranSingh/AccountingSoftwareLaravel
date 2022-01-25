$(function(){
    $('input[name=registration_no]').keydown(function(e){
        if(e.keyCode == 13){
            e.preventDefault();
            window.location.href = route+'/patient-bill/'+$('input[name=type]').val()+'/'+$(this).val();
        }
    });

    $('input[name=less_amount]').keyup(function(){
        let totalAdvance = parseInt($(this).data('advance'));
        let billAmount = parseInt($('input[name=bill_amount]').val());
        if($(this).val().trim() != ''){
            let lessAmount = parseInt($(this).val());
            $('input[name=net_amount]').val(billAmount - lessAmount);
            $('.total_balance').html(billAmount - lessAmount - totalAdvance);
        }else{
            $('.total_balance').html(billAmount - totalAdvance);
            $('input[name=net_amount]').val(billAmount);
        }
    });

    $('#search').on('keyup', function(){
        let value = $(this).val();
        $("table.htCores tbody tr").each(function(index) {
            if (!index) return;
            var id = $(this).find("td").first().text().toLowerCase().trim();
            $(this).toggle(id.indexOf(value) !== -1);
        });
    });
    window.mainUrl = $('.print_bill').attr('href');
    $('.print_all_charges').on('ifChecked',function(){
        $('.print_bill').attr('href',window.mainUrl+'?print=full');
    });

    $('.print_all_charges').on('ifUnchecked',function(){
       $('.print_bill').attr('href',window.mainUrl);
    });


    $('.single-unit').each(function(){
        if($(this).val() != 0 && $(this).val() != "0"){
            let unit = $(this).val();
            let charges = $(this).data('charges');
            $(this).parents('.single-row').find('.total_charges').html(unit*charges);
        }
    });

    $('.single-unit').change(function(){
        let unit = $(this).val();
        let charges = $(this).data('charges');
        $(this).parents('.single-row').find('.total_charges').html(unit*charges);
    });


    // Event for `keydown` event. Add condition after delay of 200 ms which is counted from time of last pressed key.
    var debounceFn = Handsontable.helper.debounce(function (colIndex, event) {
        var hot = $("#hot-table").handsontable('getInstance');
        var filtersPlugin = hot.getPlugin('filters');
        // console.log(filtersPlugin.getDataMapAtColumn(colIndex));
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
            if(col != 1 && col != 3 && col != 2){

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
        className: 'column-for-search',
        filters: true,
        data: getData(),
        colHeaders: true,
        contextMenu: true,
        afterGetColHeader: addInput,
        beforeOnCellMouseDown: doNotSelectColumn,
        startRows: 1,
        startCols: 2,
        minRows: 1,
        // rowHeaders: function(i) {
        //     return getData()[i].id;
        // },
        colHeaders: ['Description','Unit','Price','Total Amount','CGHS No'],
        licenseKey: 'non-commercial-and-evaluation',
        contextMenu: ['row_above','row_below','remove_row','---------','undo','redo','copy','cut'],
        colWidths: [500,150,100,100,200],
        columns: [
            {data: "title", renderer: "html"},
            {data: "unit",type:'numeric'},
            {data: "price",type: 'numeric'},
            {data: "total", type: 'numeric'},
            {data: "cghs_no", type: 'numeric'}
        ],
        afterChange: function(change,source){
            if(source === 'loadData'){
                var hotInstance = $("#hot-table").handsontable('getInstance');
                let totalAmount = 0;
                let data = hotInstance.getSourceData();
                data.filter(function(value){
                    if(value.total != '' && value.total != null){
                        totalAmount += parseFloat(value.total);
                    }
                });
                $('.total-amount').html(totalAmount);
                try{
                    setTimeout(function(){
                        $('.bill_amount').val(totalAmount);
                    },500);

                }catch(e){}
                try{
                    $('input[name=bill_amount]').val(totalAmount);
                    $('input[name=less_amount]').trigger('keyup');
                }catch(e){}
                return;
            }
            var hotInstance = $("#hot-table").handsontable('getInstance');
            var row = change[0][0];
            var col = change[0][1];

            if(change[0][1] == 'unit' && change[0][3] != ''){
                let data = hotInstance.getSourceData();
                let calculatedData = data[hotInstance.getCellMeta(row, col).row];
                if(!isNaN(parseInt(change[0][3]))){
                    calculatedData['total'] = calculatedData['price'] * parseFloat(change[0][3]);
                }else{
                    calculatedData['total'] = '';
                }
                data[hotInstance.getCellMeta(row, col).row] = calculatedData;
                hotInstance.loadData(data);
                let totalAmount = 0;
                data.filter(function(value){
                    if(value.total != '' && value.total != null){
                        totalAmount += parseFloat(value.total);
                    }
                });
                try{
                    $('input[name=bill_amount]').val(totalAmount);
                    $('input[name=less_amount]').trigger('keyup');
                }catch(e){}
                try{
                    $('.bill_amount').val(totalAmount);
                }catch(e){}
                $('.total-amount').html(totalAmount);
            }
            $('.chargesList').val(JSON.stringify(hotInstance.getSourceData()));
        },
        afterRemoveRow: function(){
            var hotInstance = $("#hot-table").handsontable('getInstance');
            $('.chargesList').val(JSON.stringify(hotInstance.getSourceData()));
        }
    });

});


function getData(){
    let data = $('.chargesList').val();
    window.ChargesData = JSON.parse(data);
    return JSON.parse(data);
}
