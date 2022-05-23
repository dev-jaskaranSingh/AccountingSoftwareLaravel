$(function(){
	//getStates($('.country'));
	$('body').on('change','.country',function(){
		getStates($(this));
	});

	$('body').on('change','.states',function(){
		$.ajax({
			type:'GET',
			url: window.route+'/cities/'+$(this).val(),
			data: {},
			success: function(result){
				$('.cities').html('');
				$.each(result.cities, function(key,value){
					$('.cities').append('<option value="'+key+'">'+value+'</option>');
				});
			}
		});
	});

	$('body').on('change','.department',function(){
		getDoctors($(this).val());
	});

    $(".datetime" ).datetimepicker({
        format: 'Y-m-d H:i:s',
        step: 5,
        onShow: function () {
            this.setOptions({
                maxDate:$('#tdate').val()?$('#tdate').val():false,
                maxTime:$('#tdate').val()?$('#tdate').val():false
            });
        }
    });

    $(".dateonly" ).datetimepicker({
        format: 'Y-m-d',
        step: 5,
        onShow: function () {
            this.setOptions({
                maxDate:$('#tdate').val()?$('#tdate').val():false,
                maxTime:$('#tdate').val()?$('#tdate').val():false
            });
        }
    });//.attr('readonly', 'readonly');


/*	$('.datepicker').datepicker({
		todayBtn: "linked",
	    keyboardNavigation: false,
	    forceParse: false,
	    calendarWeeks: true,
	    autoclose: true,
	    format: 'yyyy-mm-dd'
	});*/
	$("body").delegate(".datepicker", "focusin", function(){
		$(this).datepicker({
			todayBtn: "linked",
			keyboardNavigation: false,
			forceParse: false,
			calendarWeeks: true,
			autoclose: true,
			format: 'yyyy-mm-dd',
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
		});
	});

	$('body').on('click','.appointment-search',function(e){
		e.preventDefault();
		let elem = $(this);
		if($('.patient-appt-mobile').val() == ''){
			$(this).parents('.input-group').addClass('has-error');
			return false;
		}else{
			$(this).parents('.input-group').removeClass('has-error');
		}
		var mobile = $('.patient-appt-mobile').val();
		$('.patient-appt-mobile').attr('readonly',true);
		elem.attr('disabled',true);
		showLoading('loading-label');
		$.ajax({
			type: 'GET',
			url: route+'/search/patient',
			data: {
				mobile: mobile
			},
			success: function(result){
				hideLoading();
				if(result.searchedPatient != false){
					$('.apt-pt-nm').val(result.searchedPatient.name);
					$('.apt-pt-ct').val(result.searchedPatient.city);
					$('.apt-pt-gender').val(result.searchedPatient.gender);
				}else{
					toastr.info('Patient not found!','No patient found');
					$('.apt-pt-nm, .apt-pt-ct').val('');
					$('.apt-pt-nm, .apt-pt-ct').attr('readonly',false);
				}
				$('.patient-appt-mobile').attr('readonly',false);
				elem.attr('disabled',false);
			}
		});
	});
	$('.clockpicker').clockpicker({
		autoclose: true,
	});

	$('body').on('change','.appoint_to_doctor',function(){
		$('.avail-icon').remove();
		if($(this).val() != 0){
			showLoading('doctor-loader');
			$.ajax({
				type: 'GET',
				url: route+'/appointment/doctor/timings',
				data: {
					doctor: $(this).val()
				},
				success: function(result){
					hideLoading();
					$('.doctor-loader').after('<a href="javascript:void(0)" class="ml-1 avail-icon" data-toggle="modal" data-target="#availabilityModal"><i class="fa fa-info-circle"></i></a>');
					$('.avail-content').html(result);

				}
			});
		}
	});

	$('.tooltip-demo').tooltip({
		selector: "[data-toggle=tooltip]",
		container: "body"
	});

	$('.book-appointment').click(function(){
		$(this).addClass('disabled');
		let elem = $(this);
		$.ajax({
			type:'GET',
			url: route+'/appointment/create',
			data: {},
			success: function(result){
				$('.appointment-modal').html(result);
				$('#myModal5').modal('show');
				$('.datepicker').datepicker({
					todayBtn: "linked",
					keyboardNavigation: false,
					forceParse: false,
					calendarWeeks: true,
					autoclose: true,
					format: 'yyyy-mm-dd'
				});
				elem.removeClass('disabled');
			}
		});
	});
	$('body').on('click','.edit-appointment', function(){
		$.ajax({
			type: 'GET',
			url: route+'/appointment/'+$(this).data('id')+'/edit',
			data:{},
			success: function(result){
				$('.appointment-modal').html(result);
				$('#myModal5').modal('show');
				$('.datepicker').datepicker({
					todayBtn: "linked",
					keyboardNavigation: false,
					forceParse: false,
					calendarWeeks: true,
					autoclose: true,
					format: 'yyyy-mm-dd'
				});
			}
		});
	});

	$('body').on('click','.save-appointment', function(e){
		$('#appointment input, #appointment select, #appointment textarea').each(function(){
			if($(this).val().trim() == ''){
				$(this).parents('.form-group,.input-group').addClass('has-error');
				e.preventDefault();
			}else{
				$(this).parents('.form-group,.input-group').removeClass('has-error');
			}
		});
	});
});

function getDoctors(department_id){
	$.ajax({
		type: 'GET',
		url: route+'/get/doctor/'+department_id,
		data: {},
		success: function(result){
			let html = '<option value="">Select Doctor</option>';
			$.each(result.doctors, function(key,value){
				html += '<option value="'+key+'">'+value+'</option>';
			});
			$('.doctor-list').html(html);
		}
	});
}

function showLoading(afterClass){
	let loaderHTML = '<img src="'+route+'/images/742.gif" class="loadin-gif" />';
	$('.'+afterClass).after(loaderHTML);
	$('.loadin-gif').show();
}

function hideLoading(){
	$('.loadin-gif').remove();
}

function getStates(elem){
	$.ajax({
		type: 'GET',
		url: window.route+'/states/'+elem.val(),
		data:{},
		success: function(result){
			$('.states').html('');
			$.each(result.states, function(key,value){
				$('.states').append('<option value="'+key+'">'+value+'</option>');
			});
		}
	});
}

