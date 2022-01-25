$(function(){
    $('input, select').keypress(function(e){
        /* ENTER PRESSED*/
        if (e.keyCode == 13) {
            e.preventDefault();
            /* FOCUS ELEMENT */
            var inputs = $(this).parents("form").eq(0).find(":input");
            var idx = inputs.index(this);

            if (idx == inputs.length - 1) {
                inputs[0].focus()
            } else {
                inputs[idx + 1].focus(); //  handles submit buttons
                // inputs[idx + 1].select();
            }
            return false;
        }
    });

    $('.save_manufacturer').click(function(){
        let elem = $(this);
        $(this).prop('disabled',true);
        $(this).html('Please wait..');
        let manufacturerName = $('.manufacturer_name').val();
        if(manufacturerName == '' || manufacturerName == null){
            alert('Please enter manufacturer name');
            return false;
        }
        $.ajax({
            type: 'POST',
            url: route+'/pharmacy/manufacturer/save',
            data: {
                manufacturer: manufacturerName
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result){
                let options = '<option>Select Manufacturer</option>';
                $.each(result.manufacturers, function(key,value){
                    options += '<option value="'+key+'">'+value+'</option>';
                });
                $('.manufacturer_list').html(options);
                $('#manufacturer_form').modal('hide');
                toastr.success('Manufacturer saved!','Manufacturer saved successfully!');
                elem.prop('disabled',false);
                elem.html('Save Manufacturer');
                $('.manufacturer_name').val('');
            }
        });
    });

    $('.save_tax').click(function(){
        let elem = $(this);
        elem.prop('disabled',true);
        elem.html('Please wait...');
        let taxName = $('.taxname').val();
        let percent = $('.percent').val();
        $.ajax({
            type: 'POST',
            url: route+'/pharmacy/tax/save',
            data: {
                taxName: taxName,
                percent: percent
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result){
                let options = '<option value="">Select Tax</option>';
                $.each(result.taxes, function(key,value){
                    options += '<option value="'+key+'">'+value+'</option>';
                });
                $('.taxes').html(options);
                $('#tax_modal').modal('hide');
                elem.prop('disabled',false);
                elem.html('Save Tax');
                $('.taxname').val('');
                $('.percent').val('');
            }
        })
    });


    $('.save_packing').click(function(){
        let elem = $(this);
        elem.prop('disabled',true);
        elem.html('Please wait...');
        let packName = $('.packing').val();
        $.ajax({
            type: 'POST',
            url: route+'/pharmacy/packing/save',
            data: {
                packing: packName
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result){
                let options = '<option value="">Select Packing</option>';
                $.each(result.packing, function(key,value){
                    options += '<option value="'+key+'">'+value+'</option>';
                });
                $('.packings').html(options);
                $('#packing_modal').modal('hide');
                elem.prop('disabled',false);
                elem.html('Save Packing');
                $('.packing').val('');
            }
        });
    });
});
