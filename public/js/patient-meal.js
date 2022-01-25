$(function(){
    var $container = $("#hot-table");
    $container.handsontable({
        rowHeaders: true,
        className: 'column-for-search',
        data: getData(),
        colHeaders: true,
        contextMenu: true,
        startRows: 1,
        startCols: 2,
        minRows: 1,
        // rowHeaders: function(i) {
        //     return getData()[i].id;
        // },
        colHeaders: ['Regd','Patient Name','Room No','Age','Type','Breakfast','Lunch','Dinner'],
        licenseKey: 'non-commercial-and-evaluation',
        colWidths: [50,200,100,100,150,150,150,150],
        columns: [
            {data: "reg_no", readOnly: true},
            {data: "name", readOnly: true},
            {data: "room", readOnly: true},
            {data: "age", readOnly: true},
            {data: "type", readOnly: true},
            {data: "breakfast"},
            {data: "lunch"},
            {data: "dinner"},
        ],
        afterChange: function(change,source){
            if(source === 'loadData'){
                return;
            }
            var hotInstance = $("#hot-table").handsontable('getInstance');
            $('.patientsList').val(JSON.stringify(hotInstance.getSourceData()));
        },
        afterRemoveRow: function(){
        }
    });

    $('input[name=meal_days]').change(function(){
        var queryParameters = {}, queryString = location.search.substring(1),
            re = /([^&=]+)=([^&]*)/g, m;

        // Creates a map with the query string parameters
        while (m = re.exec(queryString)) {
            queryParameters[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
        }
        queryParameters['record'] = $(this).val();
        location.search = $.param(queryParameters);
    });
});

function getData(){
    let data = $('.patientsList').val();
    window.ChargesData = JSON.parse(data);
    return JSON.parse(data);
}

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}
