$(function () {
    $('.datatable').dataTable();
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

    // console.log(JSON.parse($('.purchase-items').val()));

    data = JSON.parse($('.purchase-items').val());
    console.log(data);
    var $container = $("#hot-table");

    $container.handsontable({
        rowHeaders: true,
        className: 'as-you-type-demo',
        filters: true,
        beforeOnCellMouseDown: doNotSelectColumn,
        data: data,
        colHeaders: true,
        contextMenu: true,
        startRows: 1,
        startCols: 11,
        minRows: 5,
        colHeaders: ['Product', 'Batch No', 'Expiry', 'P Qty', 'C.P.P', 'Amount', 'C.P.L', 'M.R.P', 'MRP Amount'],
        licenseKey: 'non-commercial-and-evaluation',
        contextMenu: ['row_below', 'remove_row', 'copy', 'cut'],
        copyPaste: true,
        colWidths: [180, 120, 120, 120, 120, 100, 100, 100, 100],
        hiddenColumns: {
            columns: [9], indicators: true
        },
        columns: [{
            renderer: customDropdownRenderer, editor: 'chosen', width: 200, chosenOptions: {
                data: JSON.parse($('.products-data').val()) || [],
            }
        }, {
            type: 'text'
        }, {
            type: 'date', dateFormat: 'DD/MM/YYYY',
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
            console.log([change, source])
            let hotInstance = $("#hot-table").handsontable('getInstance');
            let totalAmount = 0;
            if (source === 'loadData') {
                setTimeout(function () {
                    let data = hotInstance.getSourceData();
                    // console.log(data);
                    data.filter(function (value) {
                        if (!isNaN(value[5]) && value[5] != null) {
                            totalAmount += parseInt(value[5]);
                        }
                    });
                    $('.total_amount').html(totalAmount);
                }, 100);

                return;
            }
            let data = hotInstance.getSourceData();
            let row = change[0][0];
            let qty = data[row][3];
            let amount = data[row][4];
            let msp = data[row][7];
            // console.log(packqty);
            let userid = 0;
            if (change[0][1] === 0) {

                userid = data[row][0];
                if (userid > 0) {
                    let url = '/pharmacy/stock/purchase/';
                    $.ajax({
                        url: route + url + userid, type: 'get', dataType: 'json', success: function (response) {
                            console.log(response.data.packed_qty);
                            window.packed_qty = response.data.packed_qty;
                            data[row][9] = response.data.packed_qty;
                        }
                    })
                }
            }
            if (change[0][1] === 3 || change[0][1] == 4) {
                if (qty !== undefined && amount !== undefined) {
                    data[row][5] = qty * amount;
                    data[row][6] = parseInt(amount / packed_qty);
                    data.filter(function (value) {
                        if (!isNaN(value[6])) {
                            totalAmount += parseInt(value[6]);
                        }
                    });
                    $('.total_amount').html(totalAmount);
                }
            }
            if (change[0][1] == 7) {
                if (msp !== undefined && packed_qty !== undefined) {
                    data[row][8] = parseInt(msp * packed_qty);
                }
            }
            hotInstance.loadData(data);
            $('.purchase_products').val(JSON.stringify(hotInstance.getData()));
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


