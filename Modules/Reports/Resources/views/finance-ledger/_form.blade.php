<style>
    .hot-container {
        width: 100%;
        height: 300px;
        overflow: hidden;
    }

    .address {
        height: 100px;
    }

    .filterHeader input {
        width: 90%;
        margin: 0 auto 10px;
    }
</style>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>{!! getCurrentRouteTitle() !!}</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('account_id','Select Account') !!}
                        <strong class="text-danger">*</strong>
                        {!! Form::select('account_id',getAccountsListForLedger(),null,['class'=>'form-control select2 account_id']) !!}
                        @error('account_id')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-3 col-sm-12 mb-3">
                        {!! Form::label('from_date','From Date') !!}
                        <strong class="text-danger">*</strong>
                        {!! Form::text('from_date',authCompany()->from_date,['class'=>'form-control customDatePicker']) !!}
                        @error('from_date')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-3 col-sm-12 mb-3">
                        {!! Form::label('to_date','To Date') !!}
                        <strong class="text-danger">*</strong>
                        {!! Form::text('to_date',authCompany()->to_date,['class'=>'form-control customDatePicker']) !!}
                        @error('to_date')
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
