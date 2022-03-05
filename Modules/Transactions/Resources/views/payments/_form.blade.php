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

@php
    use Modules\Transactions\Entities\FinanceLedger;
    $amount = $firstAccountId = $secondAccountId =  null;
    if(isset($model)){
        $finaceModel = FinanceLedger::where(['first_transaction_no' => $model->first_transaction_no,'bill_number' => $model->bill_number])->get();
        $firstAccountId = $finaceModel->where('debit',0)->first()->account_id ?? null;
        $secondAccountId = $finaceModel->where('credit',0)->first()->account_id  ?? null;
        $amount = ($model->credit > 0) ? $model->credit : $model->debit;
    }
@endphp

{{--
    1.getFirstAccountsList()
    2.getSecondAccountsList()
    3.getInstrTypeList()
    all above functions available in /Helpers/receipts_helper.php
--}}

<div class="row">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Create {!! getCurrentRouteTitle() !!} <small>{!! getCurrentRouteTitle() !!} create form</small></h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('first_account_id','First Account') !!}

                        @isset($model)
                            {!! Form::hidden('bill_number',$model->bill_number) !!}
                        @endisset

                        {!! Form::select('first_account_id',getFirstAccountsList(),$firstAccountId,['class'=>'form-control select2 first_account_id']) !!}
                        @error('first_account_id')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('second_account_id','Second Account') !!}
                        {!! Form::select('second_account_id',getSecondAccountsList(),$secondAccountId,['class'=>'form-control select2 second_account_id']) !!}
                        @error('second_account_id')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('instr_type','Instrument Type') !!}
                        {!! Form::select('instr_type',getInstrTypeList(),null,['class'=>'form-control select2 instr_type']) !!}
                        @error('instr_type')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('instrument_no','Instrument Number') !!}
                        {!! Form::text('instrument_no',null,['class'=>'form-control']) !!}
                        @error('instrument_no')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('instrument_date','Instrument Date') !!}
                        {!! Form::text('instrument_date',now()->format('Y-m-d'),['class'=>'form-control datepicker']) !!}
                        @error('instrument_date')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('amount','Amount') !!}
                        {!! Form::text('amount',$amount,['class'=>'form-control']) !!}
                        @error('amount')
                        <span class="help-block text-danger">
                        {{ $message }}
                    </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::label('narration','Narration') !!}
                        {!! Form::textarea('narration',null,['class'=>'form-control']) !!}
                        @error('narration')
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