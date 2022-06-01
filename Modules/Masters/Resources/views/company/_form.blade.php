<div class="row">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Create Company <small>Company create form</small></h5>
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
                        {!! Form::text('mobile',null,['class'=>'form-control mobile']) !!}
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
                        {!! Form::label('country_id','Select Country') !!}
                        <strong class="text-danger">*</strong>
                        @if(request()->old('country_id'))
                            {!! Form::select('country_id',\App\Models\Country::pluck('name','id')->prepend('Select', null),request()->old('country_id'),['class'=>'select2 country form-control']) !!}
                        @else
                            {!! Form::select('country_id',\App\Models\Country::pluck('name','id')->prepend('Select', null),@$model->country_id,['class'=>'select2 country form-control']) !!}
                        @endif

                        @error('country_id')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>


                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('state_id','Select State') !!}
                        <strong class="text-danger">*</strong>
                        @if(request()->old('state_id'))
                            {!! Form::select('state_id',\App\Models\State::where('country_id',request()->old('country_id'))->pluck('name','id'),request()->old('state_id'),['class'=>'select2 state form-control']) !!}
                        @else
                            {!! Form::select('state_id',\App\Models\State::where('country_id',@$model->country_id)->pluck('name','id'),@$model->state_id,['class'=>'select2 state form-control']) !!}
                        @endif
                        @error('state_id')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('city_id','Select City') !!}
                        <strong class="text-danger">*</strong>
                        @if(request()->old('city_id'))
                            {!! Form::select('city_id',\App\Models\State::find(request()->old('state_id'))->cities()->pluck('name','id'),request()->old('city_id'),['class'=>'select2 city form-control']) !!}
                        @else
                            @if(isset($model))
                                {!! Form::select('city_id',\App\Models\State::find(@$model->state_id)->cities()->pluck('name','id'),@$model->city_id,['class'=>'select2 city form-control']) !!}
                            @else
                                {!! Form::select('city_id',[],@$model->city_id,['class'=>'select2 city form-control']) !!}
                            @endif
                        @endif

                        @error('city_id')
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

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('address','Address') !!}
                        {!! Form::textarea('address',null,['class'=>'form-control','rows'=>4]) !!}
                        @error('address')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3 gstin_group">
                        {!! Form::label('gst_state_code','State GST CODE') !!}
                        {!! Form::text('gst_state_code',null,['class'=>'form-control gst_code']) !!}
                        @error('gst_state_code')
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
                        {!! Form::text('from_date',isset($model) ? $model->from_date : now()->format('d-m-Y'),['class'=>'form-control customDatePicker']) !!}
                        @error('from_date')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('to_date','To Date') !!}
                        {!! Form::text('to_date',isset($model) ? $model->to_date : now()->addDays(365)->format('d-m-Y'),['class'=>'form-control customDatePicker']) !!}
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

        $('#formSubmit').submit(function (event) {
            event.preventDefault();
            var mobile = $('.mobile').val();
            var pan = $('.pan').val();
            var gstin = $('.gstin').val();

            if (mobile.length < 10) {
                toastr.warning('Mobile Number should be 10 digit', 'Warning!');
                return false;
            }

            if (verifyPAN(pan) && verifyGSTIN(gstin) && verifyMobile(mobile)) {
                $(this).unbind('submit').submit();
            } else {
                return false;
            }
        })


        function verifyMobile(mobile) {
            var regex = /^[0-9]{10}$/;
            if (regex.test(mobile)) {
                return true;
            } else {
                toastr.warning('Please Enter Valid Mobile Number', 'Warning!');
                return false;
            }
        }

        function verifyGSTIN(gstin) {
            var gstinformat = /^([0-2][0-9]|[3][0-7])[A-Z]{3}[ABCFGHLJPTK][A-Z]\d{4}[A-Z][A-Z0-9][Z][A-Z0-9]$/;
            if (gstinformat.test(gstin)) {
                return true;
            } else {
                toastr.warning('Please Enter Valid GSTIN Number', 'Warning!');
                $(".gstin").focus();
                return false;
            }
        }

        function verifyPAN(pan) {
            var regex = /[A-Z]{5}[0-9]{4}[A-Z]{1}$/;
            if (regex.test(pan)) {
                return true;
            } else {
                toastr.warning('Please Enter Valid PAN Number', 'Warning!');
                return false;
            }
        }

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

        $('.is_primary').on('change', function () {
            if ($(this).is(':checked')) {
                $('.subgroup').hide();
            } else {
                $('.subgroup').show();
            }
        });

        $(".gstin").change(function () {
            var inputvalues = $(this).val();
            verifyGSTIN(inputvalues);
        });

        $(".pan").change(function () {
            var inputvalues = $(this).val();
            verifyPAN(inputvalues);
        });

        $(".mobile").change(function () {
            var inputvalues = $(this).val();
            verifyMobile(inputvalues);

        });

        $('body').on('change', '.dealer_type', function () {
            if ($(this).val() == 'unregister') {
                $('.gstin_group').hide();
            } else {
                $('.gstin_group').show();
            }
        });

        $('body').on('change', '.country', function () {

            if($('.state option').length > 0){
                $('.state').empty();
                $('.state').select2({
                    data: null,
                    placeholder: 'Select State'
                }).trigger('change');
            }

            if($('.city option').length > 0){
                $('.city').empty();
                $('.city').select2({
                    data: null,
                    placeholder: 'Select City'
                }).trigger('change');
            }

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

            if($('.city option').length > 0){
                $('.city').empty();
                $('.city').select2({
                    data: null,
                    placeholder: 'Select City'
                }).trigger('change');
            }

            var state_id = $(this).val();
            let statesArray = window.states;
            var selectedState = statesArray.find(item => item.id == state_id);
            $('.gst_code').val(selectedState?.tin);
            toastr.success('Cities loaded.', 'Success!');
            ajaxHandler('{{route('ajax.get-city-by-state')}}', {state_id: state_id}, 'GET', function (data) {
                $('.city').select2({
                    data: data?.cities,
                    placeholder: 'Select City'
                }).trigger('change');
            });
        });
    </script>

@endsection
