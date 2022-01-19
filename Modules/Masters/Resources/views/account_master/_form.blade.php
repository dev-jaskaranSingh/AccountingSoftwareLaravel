<div class="row">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Create Account Group <small>Account Group create form</small></h5>
            </div>
            <div class="ibox-content">
                <div class="row">

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('account_group_id','Select Account Group') !!}
                        {!! Form::select('account_group_id',\Modules\Masters\Entities\AccountGroup::pluck('name','id'),@$model->account_group_id,['class'=>'select2 form-control select']) !!}
                        @error('account_group_id')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
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
                        {!! Form::email('email',null,['class'=>'form-control']) !!}
                        @error('email')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('phone','Phone') !!}
                        {!! Form::tel('phone',null,['class'=>'form-control']) !!}
                        @error('phone')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('address','Address') !!}
                        {!! Form::textarea('address',null,['class'=>'form-control','rows' =>'4']) !!}
                        @error('address')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('opening_balance','Opening Balance') !!}
                        {!! Form::number('opening_balance',0,['class'=>'form-control']) !!}
                        @error('opening_balance')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('account_type','Account Type') !!}
                        {!! Form::select('account_type',['debit' => 'Debit','credit' => 'Credit'],null,['class'=>'form-control select2']) !!}
                        @error('account_type')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('dealer_type','Dealer Type') !!}
                        {!! Form::select('dealer_type',['register' => 'Register','unregister' => 'Unregister'],null,['class'=>'select2 form-control dealer_type']) !!}
                        @error('dealer_type')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('country_id','Select Country') !!}
                        {!! Form::select('country_id',\App\Models\Country::pluck('name','id')->prepend('Select', null),@$model->country_id,['class'=>'select2 country form-control']) !!}
                        @error('country_id')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>


                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('state_id','Select State') !!}
                        {!! Form::select('state_id',\App\Models\State::where('country_id',@$model->country_id)->get(),@$model->state_id,['class'=>'select2 state form-control']) !!}
                        @error('state_id')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('city_id','Select City') !!}
                        {!! Form::select('city_id',\App\Models\State::find(@$model->state_id)->cities()->get(),@$model->city_id,['class'=>'select2 city form-control']) !!}
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

                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Bank Details <small>Bank Details form</small></h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('bank_name','Bank Name') !!}
                        {!! Form::text('bank_name',null,['class'=>'form-control select']) !!}
                        @error('bank_name')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('branch_name','Bank Branch Name') !!}
                        {!! Form::text('branch_name',null,['class'=>'form-control select']) !!}
                        @error('branch_name')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('account_number','Account Number') !!}
                        {!! Form::text('account_number',null,['class'=>'form-control select']) !!}
                        @error('account_number')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('ifsc_code','IFSC Code') !!}
                        {!! Form::text('ifsc_code',null,['class'=>'form-control select']) !!}
                        @error('ifsc_code')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('account_holder_name','Account Holder Name') !!}
                        {!! Form::text('account_holder_name',null,['class'=>'form-control select']) !!}
                        @error('account_holder_name')
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

    $(document).ready(function () {

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
            ajaxHandler('{{route('ajax.get-city-by-state')}}', {state_id: state_id}, 'GET', function (data) {
                $('.city').select2({
                    data: data?.cities,
                    placeholder: 'Select City'
                });
            });
        });
    });
</script>
@section('scripts')

@endsection
