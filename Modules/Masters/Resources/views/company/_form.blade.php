<div class="row">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Create Account Group <small>Account Group create form</small></h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('name','Name') !!}
                        {!! Form::text('name',null,['class'=>'form-control']) !!}
                        @error('name')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('email','Email') !!}
                        {!! Form::text('email',null,['class'=>'form-control']) !!}
                        @error('email')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('mobile','Mobile') !!}
                        {!! Form::text('mobile',null,['class'=>'form-control']) !!}
                        @error('mobile')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('db_name','Database Name') !!}
                        {!! Form::text('db_name',null,['class'=>'form-control']) !!}
                        @error('db_name')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('address','Address') !!}
                        {!! Form::textarea('address',null,['class'=>'form-control','rows'=>4]) !!}
                        @error('address')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('country_id','Select Country') !!}
                        {!! Form::select('country_id',\App\Models\Country::pluck('name','id')->prepend('Select',
                        null),null,['class'=>'select2 country form-control']) !!}
                        @error('country_id')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    
                    
                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('state_id','Select State') !!}
                        {!! Form::select('state_id',[],null,['class'=>'select2 state form-control']) !!}
                        @error('state_id')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                                        
                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('pincode','PIN Code') !!}
                        {!! Form::number('pincode',null,['class'=>'form-control select']) !!}
                        @error('pincode')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 col-sm-12 mb-3 gstin_group">
                        {!! Form::label('gstin','GSTIN') !!}
                        {!! Form::text('gstin',null,['class'=>'form-control gstin']) !!}
                        @error('gstin')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('pan','PAN Number') !!}
                        {!! Form::text('pan',null,['class'=>'form-control pan']) !!}
                        @error('pan')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('from_date','From Date') !!}
                        {!! Form::date('from_date',now(),['class'=>'form-control']) !!}
                        @error('from_date')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('to_date','To Date') !!}
                        {!! Form::date('to_date',now()->addDays(365),['class'=>'form-control']) !!}
                        @error('to_date')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('website','Website') !!}
                        {!! Form::text('website',null,['class'=>'form-control']) !!}
                        @error('website')
                        <span class="help-block text-danger">
                        {{ $message }}
                        </span>
                        @enderror
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@section('scripts')
<script>

function ajaxHandler(url, data, type, callback) {
    $.ajax({
    url: url,
    data: data,
    type: type,
    success: function (data) {
    callback(data);
    }
    });
    }

    $('.is_primary').on('change',function () {
        if($(this).is(':checked')){
            $('.subgroup').hide();
        }else{
            $('.subgroup').show();
        }
    });

    $(".gstin").change(function () {
            var inputvalues = $(this).val();
            var gstinformat = new RegExp('^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]1}[1-9A-Z]{1}Z[0-9A-Z]{1}$');
            if (gstinformat.test(inputvalues)) {
            return true;
            } else {
            toastr.warning('Please Enter Valid GSTIN Number', 'Warning!');
            $(".gstin").focus();
            }
            });
            
            $(".pan").change(function () {
            var inputvalues = $(this).val();
            var regex = /[A-Z]{5}[0-9]{4}[A-Z]{1}$/;
            if (!regex.test(inputvalues)) {
            toastr.warning('Please Enter Valid PAN Number', 'Warning!');
            return regex.test(inputvalues);
            }
            });
            
            $(".mobile").change(function () {
            var inputvalues = $(this).val();
            var regex = /^[0-9]{10}$/;
            if (!regex.test(inputvalues)) {
            toastr.warning('Please Enter Valid Mobile Number', 'Warning!');
            return regex.test(inputvalues);
            }
            });
            
            $('body').on('change', '.dealer_type', function () {
            if ($(this).val() == 'unregister') {
            $('.gstin_group').hide();
            } else {
            $('.gstin_group').show();
            }
            });
            
            $('body').on('change', '.country', function () {
            var country_id = $(this).val();
            ajaxHandler('{{route('ajax.get-state-by-country')}}', {country_id: country_id}, 'GET', function (data) {
                toastr.success('States loaded.', 'Success!');
                window.states = data.states;
                $('.state').select2({
                data: data?.states,
                placeholder: 'Select State'
                });
                });
            });
            
            $('body').on('change', '.state', function () {
                var state_id = $(this).val();
                let statesArray = window.states;
                var selectedState = statesArray.find(item => item.id == state_id);
                $('.gstin').val(selectedState?.tin);
                toastr.success('Cities loaded.', 'Success!');
            });
</script>

@endsection