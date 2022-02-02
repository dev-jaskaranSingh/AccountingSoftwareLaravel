$(function () {
    $('.datatable').dataTable();


    function ajax_request(url, type, data, callback) {
        $.ajax({
            url: url, type: type, data: data, success: function (data) {
                callback(data);
            }
        });
    }

    $('body').on('change', '.account_id', function () {
        var account_id = $(this).val();
        ajax_request(route + '/ajax/get-account-by-id/' + account_id, 'GET', null, function (data) {
            if (!data.status) {
                toastr.error(data.message, 'Error');
                return false;
            }
            $('.state_code').html(data.account.gst_state_code);
            // $('#shipped_to').val(data.account.address);
            $('.gst').html(data.account.gstin);
            $('.billed_to').html(data.account.name);
            $('.pan').html(data.account.pan);
            $('.place_of_supply').html(data.account.state.name);

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

    data = JSON.parse($('.purchase-items').val()) || [];

    var $container = $("#hot-table");

    $container.handsontable({
        rowHeaders: true,
        className: 'as-you-type-demo',
        filters: true,
        beforeOnCellMouseDown: doNotSelectColumn,
        data: data,
        startRows: 1,
        startCols: 11,
        minRows: 15,
        colHeaders: ['Items', 'HSN Code', 'GST Min(%)', 'GST Max(%)', 'Gross WT', 'Net WT', 'RATE/GM', 'Amount','Discount(%)','Discount(₹)','After Discount', 'GST Amount', 'Total', 'Units','unit_id','hsn_id'],
        licenseKey: 'non-commercial-and-evaluation',
        contextMenu: ['row_below', 'remove_row', 'copy', 'cut'],
        copyPaste: true,
        colWidths: [100, 80, 90, 90, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120],
        hiddenColumns: {
            columns: [14,15,16],
            indicators: true
        },
        columns: [{
            renderer: customDropdownRenderer, editor: 'chosen', width: 200, chosenOptions: {
                data: JSON.parse($('.products-data').val()) || [],
            }
        }, {type: 'text'}, {type: 'text'}, {type: 'numeric'}, {type: 'numeric'}, {type: 'numeric'}, {type: 'numeric'},{type: 'numeric'}, {type: 'numeric'}, {type: 'numeric'}, {type: 'numeric'}, {type: 'numeric'},{type: 'numeric'}, {type: 'numeric'}],
        afterChange: function (change, source) {
            if (change !== null) {
                let hotInstance = $("#hot-table").handsontable('getInstance');
                let totalAmount = 0;
                if (source === 'loadData') {
                    setTimeout(function () {
                        let data = hotInstance.getSourceData();
                        data.filter(function (value) {
                            if (!isNaN(value[8]) && value[8] != null) {
                                totalAmount += parseInt(value[8]);
                            }
                        });
                        $('.total_amount').html(totalAmount);
                    }, 100);
                }

                let data = hotInstance.getSourceData();
                let row = change[0][0];
                let qty = data[row][5];
                let price = data[row][6];
                let userid = 0;

                if (change[0][1] === 0) {
                    userid = data[row][0];
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
                                data[row][6] = response.item.sale_price;
                                data[row][13] = response.item.unit.name;
                                data[row][14] = response.item.unit.id;
                                data[row][15] = response.item.hsn.id;
                                window.hsn_min_amount = response.item.hsn.min_amount;
                                window.gst_min_percentage = response.item.hsn.gst_min_percentage;
                                window.gst_max_percentage = response.item.hsn.gst_max_percentage;
                                hotInstance.render();
                                $('.purchase_products').val(JSON.stringify(hotInstance.getData()));
                            }
                        })
                    }
                }

                if (change[0][1] === 5 || change[0][1] === 6) {
                    if (qty !== undefined && price !== undefined) {
                        data[row][8] = 0;
                        data[row][9] = 0;
                        data[row][10] = 0;
                        window.amount = parseInt(qty * price);
                        data[row][7] = window.amount;
                        if(data[row][8] === 0 || data[row][9] === 0 || data[row][10] === 0){
                            window.gst_ammount = 0;
                            if (data[row][7] < window.hsn_min_amount) {
                                window.gst_ammount = (window.amount * window.gst_min_percentage) / 100;
                            } else {
                                window.gst_ammount = (window.amount * window.gst_max_percentage) / 100;
                            }
                            data[row][11] = window.gst_ammount;
                            data[row][12] = amount + window.gst_ammount;
                        }


                        data.filter(function (value) {
                            if (!isNaN(value[12])) {
                                totalAmount += parseInt(value[11]);
                            }
                        });
                        hotInstance.render();
                        $('.total_amount').html(totalAmount);
                    }
                }

                if(change[0][1] === 8){
                    if (qty !== undefined && price !== undefined) {
                        let dicountPercentage = data[row][8];
                        window.disount_amount = (amount * dicountPercentage) / 100;
                        data[row][9] = window.disount_amount;
                        window.afterDiscount = amount - disount_amount //Discount Amount
                        data[row][10] = window.afterDiscount;
                        window.gst_ammount = 0;
                        if (data[row][7] < window.hsn_min_amount) {
                            window.gst_ammount = (afterDiscount * window.gst_min_percentage) / 100;
                        } else {
                            window.gst_ammount = (afterDiscount * window.gst_max_percentage) / 100;
                        }
                        data[row][11] = window.gst_ammount;
                        data[row][12] = amount + window.gst_ammount;

                        data.filter(function (value) {
                            if (!isNaN(value[12])) {
                                totalAmount += parseInt(value[12]);
                            }
                        });
                        hotInstance.render();
                        $('.total_amount').html(totalAmount);
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


