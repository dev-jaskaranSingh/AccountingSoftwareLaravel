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
        console.log('change');
        var account_id = $(this).val();
        ajax_request(route + '/ajax/get-account-by-id/' + account_id, 'GET', null, function (data) {
            if(!data.status){
                toastr.error(data.message, 'Error');
                return false;
            }
            $('.state_code').html(data.account.gst_state_code);
            $('#shipped_to').val(data.account.address);
            $('.gst').html(data.account.gstin);
            $('.billed_to').html(data.account.address);
            $('.pan').html(data.account.pan);
            $('.place_of_supply').html(data.account.state.name);

            toastr.success(data.message,'Success');
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
        startCols: 7,
        minRows: 10,
        colHeaders: ['Item', 'HSN Code', 'Gross WT', 'Net WT', 'RATE/GM', 'Amount', 'Units', 'unit_id', 'hsn_id'],
        licenseKey: 'non-commercial-and-evaluation',
        contextMenu: ['row_below', 'remove_row', 'copy', 'cut'],
        copyPaste: true,
        colWidths: [180, 150, 120, 120, 120, 100, 100],
        hiddenColumns: {
            columns: [7, 8, 9], indicators: true
        },
        columns: [{
            renderer: customDropdownRenderer, editor: 'chosen', width: 200, chosenOptions: {
                data: JSON.parse($('.products-data').val()) || [],
            }
        }, {
            type: 'text'
        }, {
            type: 'text',
        }, {
            type: 'numeric',
        }, {
            type: 'numeric',
        }, {
            type: 'numeric',
        }, {
            type: 'numeric',
        }, {
            type: 'numeric',
        }, {
            type: 'numeric',
        }, {
            type: 'numeric',
        }],
        afterChange: function (change, source) {
            if (change !== null) {
                let hotInstance = $("#hot-table").handsontable('getInstance');
                let totalAmount = 0;
                if (source === 'loadData') {
                    setTimeout(function () {
                        let data = hotInstance.getSourceData();
                        data.filter(function (value) {
                            if (!isNaN(value[6]) && value[6] != null) {
                                totalAmount += parseInt(value[6]);
                            }
                        });
                        $('.total_amount').html(totalAmount);
                    }, 100);
                }
                let data = hotInstance.getSourceData();
                let row = change[0][0];
                let qty = data[row][3];
                let price = data[row][4];
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
                                data[row][6] = response.item.unit.name;
                                data[row][4] = response.item.sale_price;
                                data[row][7] = response.item.unit.id;
                                data[row][8] = response.item.hsn.id;
                                hotInstance.render();
                                $('.purchase_products').val(JSON.stringify(hotInstance.getData()));
                            }
                        })
                    }
                }
                if (change[0][1] === 3 || change[0][1] === 4) {
                    console.log(qty, price);
                    if (qty !== undefined && price !== undefined) {
                        data[row][5] = parseInt(qty * price);
                        data.filter(function (value) {
                            if (!isNaN(value[5])) {
                                totalAmount += parseInt(value[5]);
                            }
                        });
                        console.log(totalAmount);
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

    $('.billno').blur(function () {
        let elem = $(this);
        let bill_no = elem.val();
        $.ajax({
            url: route + "/pharmacy/stock/purchase/billno",
            type: "GET",
            data: {bill_no: bill_no},
            success: function (response) {
                if (response.data) {
                    elem.val(' ');
                    toastr["error"]("Enter Another Bill Number", "Bill Number Already Exist");
                }
            }
        });
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


