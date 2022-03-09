$(function () {
    $('.datatable').dataTable();

    window.companyStateCode = $('.company_state_code').val();

    function ajax_request(url, type, data, callback) {
        $.ajax({
            url: url, type: type, data: data, success: function (data) {
                callback(data);
            }
        });
    }

    $('body').on('keyup','.roundOffValue',function(){
        let roundOffType = $('.roundOffSelection').val();
        let tcs = Number($(this).val());
        if(tcs > 0 || tcs !== ''){
            if(window.storeTotalGrandAmount !== undefined){
                if(roundOffType === 'plus'){
                    $('.grand_total_amount').val(Number(window.storeTotalGrandAmount)+(tcs/100));
                }else{
                    $('.grand_total_amount').val(Number(window.storeTotalGrandAmount)-(tcs/100));
                }
            }else{
                $('.grand_total_amount').val(Number(window.storeTotalGrandAmount).toFixed(2));
            }
        }else{
            $('.grand_total_amount').val(Number(window.storeTotalGrandAmount).toFixed(2));
        }

    });

    //Addition of TCS in net amount
    $('body').on('keyup','.tcs',function(){
        let tcs = Number($(this).val());
        if(tcs > 0 || tcs !== ''){
            if(window.storeTotalGrandAmount !== undefined){
                $('.grand_total_amount').val((Number(window.storeTotalGrandAmount)+tcs).toFixed(2));
            }else{
                $('.grand_total_amount').val(Number(window.storeTotalGrandAmount).toFixed(2));
            }
        }else{
            $('.grand_total_amount').val(Number(window.storeTotalGrandAmount).toFixed(2));
        }
    });

    //Make Ajax request to get acount details
    $('body').on('change', '.account_id', function () {
        var account_id = $(this).val();
        ajax_request(route + '/ajax/get-account-by-id/' + account_id, 'GET', null, function (data) {
            if (!data.status) {
                toastr.error(data.message, 'Error');
                return false;
            }
            // $('.state_code').html(data.account.gst_state_code);
            window.stateCode = data.account.gst_state_code;
            // $('#shipped_to').val(data.account.address);
            // $('.gst').html(data.account.gstin);
            // $('.billed_to').html(data.account.name);
            // $('.pan').html(data.account.pan);
            // $('.place_of_supply').html(data.account.state.name);

            toastr.success(data.message, 'Success');
        });
    });


    // Handsone Table
    var debounceFn = Handsontable.helper.debounce(function (colIndex, event) {
        var hot = $("#hot-table").handsontable('getInstance');
        var filtersPlugin = hot.getPlugin('filters');

        filtersPlugin.removeConditions(colIndex);
        filtersPlugin.addCondition(colIndex, 'contains', [event.realTarget.value]);
        filtersPlugin.filter();
    }, 200);

    var addEventListeners = function (input, colIndex) {
        input.addEventListener('keydown', function (event) {
            debounceFn(colIndex, event);
        });
    };

    var doNotSelectColumn = function (event, coords) {
        if (coords.row === -1 && event.realTarget.nodeName === 'INPUT') {
            event.stopImmediatePropagation();
            this.deselectCell();
        }
    };

    var purchaseItemsJson = JSON.parse($('.purchase-items').val()) || '[]';
    var $container = $("#hot-table");

    $container.handsontable({
        rowHeaders: true,
        className: 'as-you-type-demo',
        filters: true,
        beforeOnCellMouseDown: doNotSelectColumn,
        data: JSON.parse(purchaseItemsJson),
        startRows: 1,
        startCols: 11,
        minRows: 10,
        colHeaders: ['Items', 'HSN', 'GST Min(%)', 'GST Max(%)', 'Gross WT','Minus WT', 'Net WT', 'RATE/GM', 'Amount','Discount(%)','Discount(₹)','Net Amount','SGST','CGST','IGST', 'GST Amount', 'Total', 'Units','unit_id','hsn_id'],
        licenseKey: 'non-commercial-and-evaluation',
        contextMenu: ['row_below', 'remove_row', 'copy', 'cut'],
        copyPaste: true,
        colWidths: [80,60, 60, 60, 60, 80, 80, 80, 80, 80, 80, 80, 80, 80, 80, 80, 80,80, 80, 80,80, 80],
        hiddenColumns: {
            //
            columns: [2, 3, 12, 13, 14, 17,18,19],
            indicators: true
        },
        columns: [{
            renderer: customDropdownRenderer, editor: 'chosen', width: 140, chosenOptions: {
                data: JSON.parse($('.products-data').val()) || [],
            }
        }, {type: 'text'}, {type: 'text'}, {type: 'numeric'},{type: 'numeric'},
            {type: 'numeric'}, {type: 'numeric'}, {type: 'numeric'},
            {type: 'numeric'}, {type: 'numeric'},{type: 'numeric'},
            {type: 'numeric'}, {type: 'numeric'}, {type: 'numeric'},
            {type: 'numeric'},{type: 'numeric'}, {type: 'numeric'},{type: 'numeric'},{type: 'numeric'},{type: 'numeric'}],
        afterChange: function (change, source) {


            if (change !== null) {
                let hotInstance = $("#hot-table").handsontable('getInstance');
                let totalGrandAmount = 0;
                let cgst = 0;
                let sgst = 0;
                let igst = 0;
                let totalDiscount = 0;
                let totalGST = 0;
                let total_net_amount = 0;
                let totalAmount = 0;

                if (source === 'loadData') {
                    setTimeout(function () {
                        let data = hotInstance.getSourceData();
                        data.filter(function (value) {
                            if (!isNaN(value[16])) {
                                totalGrandAmount += value[16];
                            }
                            if(!isNaN(value[8])){
                                totalAmount += value[8];
                            }
                            if(!isNaN(value[11])){
                                total_net_amount += value[11];
                            }
                            if(!isNaN(value[10])){
                                totalDiscount += value[10];
                            }
                            if(!isNaN(value[12])){
                                sgst += value[12];
                            }
                            if(!isNaN(value[13])){
                                cgst += value[13];
                            }
                            if(!isNaN(value[14])){
                                igst += value[14];
                            }
                        });
                        hotInstance.render();
                        $('.total_amount').val(totalAmount.toFixed(2));
                        $('.total_net_amount').val(total_net_amount.toFixed(2));
                        $('.total_discount').val(totalDiscount.toFixed(2));
                        $('.sgst').val(sgst.toFixed(2));
                        $('.cgst').val(cgst.toFixed(2));
                        $('.igst').val(igst.toFixed(2));
                        $('.total_gst_amount').val(totalGST.toFixed(2));
                        window.storeTotalGrandAmount = totalGrandAmount.toFixed(2);
                        $('.grand_total_amount').val(totalGrandAmount.toFixed(2));
                    }, 100);
                }

                let data = hotInstance.getSourceData();
                let row = change[0][0];
                let qty = data[row][6];
                let price = data[row][7];
                let userid = 0;

                if (change[0][1] === 0) {

                    userid = data[row][0];
                    if($('.account_id').val() === ''){
                        toastr.error('Please select party', 'Error');
                        return false;
                    }

                    if (userid > 0) {
                        let url = '/ajax/get-item-by-id/';
                        $.ajax({
                            url: route + url + userid, type: 'get', dataType: 'json', success: function (response) {
                                if (!response.status) {
                                    toastr.error(response.message);
                                    return;
                                }
                                data[row][1] = response.item.hsn.hsn_code;
                                data[row][2] = response.item.hsn.gst_min_percentage;
                                data[row][3] = response.item.hsn.gst_max_percentage;
                                data[row][7] = response.item.sale_price;
                                data[row][17] = response.item.unit.name;
                                data[row][18] = response.item.unit.id;
                                data[row][19] = response.item.hsn.id;
                                window.hsn_min_amount = response.item.hsn.min_amount;
                                window.gst_min_percentage = response.item.hsn.gst_min_percentage;
                                window.gst_max_percentage = response.item.hsn.gst_max_percentage;
                                hotInstance.render();
                                $('.purchase_products').val(JSON.stringify(hotInstance.getData()));
                            }
                        })
                    }
                }
                //Calculate Net Wt
                if(change[0][1] === 4 || change[0][1] === 5){
                    if(change[0][1] === 4 && data[row][5] === undefined){
                        data[row][5] = 0;
                    }
                    data[row][6] = data[row][4] - data[row][5];
                    if(price !== undefined){
                        data[row][8] = data[row][6] * price;
                    }else{
                        data[row][8] = 0;
                    }

                    if(data[row][9] === undefined || data[row][9] === ''){
                        data[row][9] = 0;
                    }
                    if(data[row][10] === undefined || data[row][10] === ''){
                        data[row][10] = 0;
                    }
                    if(data[row][11] === undefined || data[row][11] === ''){
                        data[row][11] = 0;
                    }

                    window.amount = Number(qty * price);
                    data[row][8] = window.amount;
                    if(data[row][9] === 0 || data[row][10] === 0 || data[row][11] === 0){
                        window.gst_amount = (window.amount * window.gst_min_percentage) / 100;
                        if(window.stateCode === window.companyStateCode){
                            data[row][12] = window.gst_amount / 2;
                            data[row][13] = window.gst_amount / 2;
                            data[row][14] = 0;
                        }else{
                            data[row][12] = 0 ;
                            data[row][13] = 0;
                            data[row][14] = window.gst_amount;
                        }
                        data[row][15] = window.gst_amount;
                        data[row][16] = amount + window.gst_amount;
                    }

                    data.filter(function (value) {
                        if (!isNaN(value[16])) {
                            totalGrandAmount += value[16];
                        }
                        if(!isNaN(value[8])){
                            totalAmount += value[8];
                        }
                        if(!isNaN(value[11])){
                            total_net_amount += value[11];
                        }
                        if(!isNaN(value[10])){
                            totalDiscount += value[10];
                        }
                        if(!isNaN(value[12])){
                            sgst += value[12];
                        }
                        if(!isNaN(value[13])){
                            cgst += value[13];
                        }
                        if(!isNaN(value[14])){
                            igst += value[14];
                        }
                    });
                    hotInstance.render();
                    $('.total_amount').val(totalAmount.toFixed(2));
                    $('.total_net_amount').val(total_net_amount.toFixed(2));
                    $('.total_discount').val(totalDiscount.toFixed(2));
                    $('.sgst').val(sgst.toFixed(2));
                    $('.cgst').val(cgst.toFixed(2));
                    $('.igst').val(igst.toFixed(2));
                    $('.total_gst_amount').val(totalGST.toFixed(2));
                    window.storeTotalGrandAmount = totalGrandAmount.toFixed(2);
                    $('.grand_total_amount').val(totalGrandAmount.toFixed(2));
                }

                if (change[0][1] === 6 || change[0][1] === 7) {
                    if (qty !== undefined && price !== undefined) {
                        data[row][9] = 0;
                        data[row][10] = 0;
                        data[row][11] = 0;
                        window.amount = Number(qty * price);
                        data[row][8] = window.amount;
                        if(data[row][9] === 0 || data[row][10] === 0 || data[row][11] === 0){
                            window.gst_amount = (window.amount * window.gst_min_percentage) / 100;
                            if(window.stateCode === window.companyStateCode){
                                data[row][12] = window.gst_amount / 2;
                                data[row][13] = window.gst_amount / 2;
                                data[row][14] = 0;
                            }else{
                                data[row][12] = 0 ;
                                data[row][13] = 0;
                                data[row][14] = window.gst_amount;
                            }
                            data[row][15] = window.gst_amount;
                            data[row][16] = amount + window.gst_amount;
                        }

                        data.filter(function (value) {
                            if (!isNaN(value[16])) {
                                totalGrandAmount += value[16];
                            }
                            if(!isNaN(value[8])){
                                totalAmount += value[8];
                            }
                            if(!isNaN(value[11])){
                                total_net_amount += value[11];
                            }
                            if(!isNaN(value[10])){
                                totalDiscount += value[10];
                            }
                            if(!isNaN(value[12])){
                                sgst += value[12];
                            }
                            if(!isNaN(value[13])){
                                cgst += value[13];
                            }
                            if(!isNaN(value[14])){
                                igst += value[14];
                            }
                        });
                        hotInstance.render();
                        $('.total_amount').val(totalAmount.toFixed(2));
                        $('.total_net_amount').val(total_net_amount.toFixed(2));
                        $('.total_discount').val(totalDiscount.toFixed(2));
                        $('.sgst').val(sgst.toFixed(2));
                        $('.cgst').val(cgst.toFixed(2));
                        $('.igst').val(igst.toFixed(2));
                        $('.total_gst_amount').val(totalGST.toFixed(2));
                        window.storeTotalGrandAmount = totalGrandAmount.toFixed(2);
                        $('.grand_total_amount').val(totalGrandAmount.toFixed(2));
                    }
                }


                // Calculate Discount Amount
                if(change[0][1] === 9){
                    if (qty !== undefined && price !== undefined) {
                        let netAmount = qty * price;
                        let dicountPercentage = data[row][9];
                        window.disount_amount = (netAmount * dicountPercentage) / 100;
                        data[row][10] = window.disount_amount;
                        window.afterDiscount = netAmount - disount_amount //Discount Amount
                        data[row][11] = window.afterDiscount;
                        window.gst_amount = (afterDiscount * window.gst_min_percentage) / 100;

                        if(window.stateCode === window.companyStateCode){
                            data[row][12] = window.gst_amount / 2 ;
                            data[row][13] = window.gst_amount/ 2;
                            data[row][14] = 0;
                        }else{
                            data[row][12] = 0 ;
                            data[row][13] = 0;
                            data[row][14] = window.gst_amount;
                        }
                        data[row][15] = window.gst_amount;
                        data[row][16] = window.afterDiscount + window.gst_amount;

                        data.filter(function (value) {
                            if (!isNaN(value[16])) {
                                totalGrandAmount += value[16];
                            }
                            if(!isNaN(value[8])){
                                totalAmount += value[8];
                            }
                            if(!isNaN(value[11])){
                                total_net_amount += value[11];
                            }
                            if(!isNaN(value[10])){
                                totalDiscount += value[10];
                            }
                            if(!isNaN(value[12])){
                                sgst += value[12];
                            }
                            if(!isNaN(value[13])){
                                cgst += value[13];
                            }
                            if(!isNaN(value[14])){
                                igst += value[14];
                            }
                        });
                        hotInstance.render();
                        $('.total_amount').val(totalAmount.toFixed(2));
                        $('.total_net_amount').val(total_net_amount.toFixed(2));
                        $('.total_discount').val(totalDiscount.toFixed(2));
                        $('.sgst').val(sgst.toFixed(2));
                        $('.cgst').val(cgst.toFixed(2));
                        $('.igst').val(igst.toFixed(2));
                        $('.total_gst_amount').val(totalGST);
                        window.storeTotalGrandAmount = totalGrandAmount.toFixed(2);
                        $('.grand_total_amount').val(totalGrandAmount.toFixed(2));
                    }
                }

                hotInstance.render();
                hotInstance.loadData(data);
                $('.purchase_products').val(JSON.stringify(hotInstance.getData()));
            }
        },
        afterRemoveRow: function () {
            let hotInstance = $("#hot-table").handsontable('getInstance');
            $('.purchase_products').val(JSON.stringify(hotInstance.getData()));
        }
    });
});

function getData() {
    let data = $('.purchase_products').val();
    if (data === '') {
        return [];
    } else {
        return JSON.parse(data);
    }
}

function customDropdownRenderer(instance, td, row, col, prop, value, cellProperties) {
    var selectedId;
    var optionsList = cellProperties.chosenOptions.data;

    if (typeof optionsList === "undefined" || typeof optionsList.length === "undefined" || !optionsList.length) {
        Handsontable.cellTypes.text.renderer(instance, td, row, col, prop, value, cellProperties);
        return td;
    }

    var values = (value + "").split(",");
    value = [];
    for (var index = 0; index < optionsList.length; index++) {
        if (values.indexOf(optionsList[index].id + "") > -1) {
            selectedId = optionsList[index].id;
            value.push(optionsList[index].label);
        }
    }
    value = value.join(", ");

    Handsontable.cellTypes.text.renderer(instance, td, row, col, prop, value, cellProperties);
    return td;
}


