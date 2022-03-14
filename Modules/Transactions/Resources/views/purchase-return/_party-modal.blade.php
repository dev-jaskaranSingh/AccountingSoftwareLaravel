
<script>
    $('#country_id').select2({
        dropdownParent: $('#purchasePartyForm')
    });
    $('#state_id').select2({
        dropdownParent: $('#purchasePartyForm')
    });
    $('#city_id').select2({
        dropdownParent: $('#purchasePartyForm')
    });
</script>
<div class="modal inmodal fade" id="purchasePartyForm" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header header-sm bg-danger">
                <button type="button" class="close" data-dismiss="modal"><span
                        aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <p class="modal-title">Billing/Shipping Details</p>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 col-sm-12 mb-3">
                        {!! Form::label('party_name','Party Name') !!}
                        {!! Form::text('party_name',null,['class'=>'form-control form-control-sm']) !!}
                        {!! Form::hidden('account_id',null) !!}
                        @error('party_name')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-4 col-sm-12 mb-3">
                        {!! Form::label('address','Address') !!}
                        {!! Form::text('address',null,['class'=>'form-control form-control-sm']) !!}
                        @error('address')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-4 col-sm-12 mb-3">
                        {!! Form::label('address2','Address2') !!}
                        {!! Form::text('address2',null,['class'=>'form-control form-control-sm']) !!}
                        @error('address2')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-4 col-sm-12 mb-3">
                        {!! Form::label('country_id','Select Country') !!}
                        {!! Form::select('country_id',\App\Models\Country::pluck('name','id')->prepend('Select', null),null,['class'=>'country form-control select2']) !!}
                        @error('country_id')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>


                    <div class="col-md-4 col-sm-12 mb-3">
                        {!! Form::label('state_id','Select State') !!}
                        {!! Form::select('state_id',[],null,['class'=>'state form-control']) !!}
                        @error('state_id')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-4 col-sm-12 mb-3">
                        {!! Form::label('city_id','Select City') !!}
                        {!! Form::select('city_id',[],null,['class'=>'select2 city form-control']) !!}
                        @error('city_id')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-4 col-sm-12 mb-3">
                        {!! Form::label('pin_code','PIN CODE') !!}
                        {!! Form::text('pin_code',null,['class'=>'form-control form-control-sm']) !!}
                        @error('pin_code')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-4 col-sm-12 mb-3">
                        {!! Form::label('mobile','Mobile Number') !!}
                        {!! Form::text('mobile',null,['class'=>'form-control form-control-sm']) !!}
                        @error('mobile')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-4 col-sm-12 mb-3">
                        {!! Form::label('gstin','GSTIN NO') !!}
                        {!! Form::text('gstin',null,['class'=>'form-control form-control-sm']) !!}
                        @error('gstin')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                {!! Form::button('Done',['class'=>'btn btn-sm btn-primary']) !!}
            </div>
        </div>
    </div>
</div>
