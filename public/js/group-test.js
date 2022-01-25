$(function(){
    $('.reset-form').click(function(){
        $('#searchInput').val('').trigger('keyup');
    });

    $('.charges_titile').click(function(){
        if($(this).parents('tr').find('input').is(':checked')){
            $(this).parents('tr').find('input').prop('checked',false);
        }else{
            $(this).parents('tr').find('input').prop('checked',true);
        }
    });
});

function myFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("charges_table");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
