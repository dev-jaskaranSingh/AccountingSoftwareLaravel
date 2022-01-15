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
                        {!! Form::email('email',null,['class'=>'form-control']) !!}
                        @error('email')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('phone','Email') !!}
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
                        {!! Form::number('opening_balance',null,['class'=>'form-control']) !!}
                        @error('opening_balance')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('account_type','Account Type') !!}
                        {!! Form::select('account_type',['debit' => 'Debit','credit' => 'Credit'],null,['class'=>'form-control select']) !!}
                        @error('account_type')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('dealer_type','Dealer Type') !!}
                        {!! Form::select('dealer_type',['register' => 'Register','unregister' => 'Unregister'],null,['class'=>'form-control select']) !!}
                        @error('dealer_type')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('country_id','Select Country') !!}
                        {!! Form::select('country_id',\App\Models\Country::pluck('name','id')->take(10),null,['class'=>'select2 form-control select']) !!}
                        @error('country_id')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>


                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('state_id','Select State') !!}
                        {!! Form::select('state_id',\App\Models\State::pluck('name','id')->take(10),null,['class'=>'select2 form-control select']) !!}
                        @error('state_id')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('city_id','Select City') !!}
                        {!! Form::select('city_id',\App\Models\City::pluck('name','id')->take(10),null,['class'=>'select2 form-control select']) !!}
                        @error('city_id')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('pincode','PIN Code') !!}
                        {!! Form::text('pincode',null,['class'=>'form-control select']) !!}
                        @error('pincode')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('gstin','GSTIN') !!}
                        {!! Form::text('gstin',null,['class'=>'form-control select']) !!}
                        @error('gstin')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('pan','PAN Number') !!}
                        {!! Form::text('pan',null,['class'=>'form-control select']) !!}
                        @error('pan')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('account_group_id','Select Account Group') !!}
                        {!! Form::select('account_group_id',\Modules\Masters\Entities\AccountGroup::pluck('name','id')->take(10),null,['class'=>'select2 form-control select']) !!}
                        @error('account_group_id')
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



@section('scripts')

@endsection
