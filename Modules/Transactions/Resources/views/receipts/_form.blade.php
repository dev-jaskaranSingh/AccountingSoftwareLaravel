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

{{--
    1.getFirstAccountsList()
    2.getSecondAccountsList()
    3.getInstrTypeList()
    all above functions available in /Helpers/receipts_helper.php
--}}

@php
    use Modules\Transactions\Entities\FinanceLedger;
    $amount = $firstAccountId = $secondAccountId =  null;
    if(isset($model)){
        $finaceModel = FinanceLedger::where(['first_transaction_no' => $model->first_transaction_no,'bill_number' => $model->bill_number])->get();
        $firstAccountId = $finaceModel->where('credit',0)->first()->account_id ?? null;
        $secondAccountId = $finaceModel->where('debit',0)->first()->account_id  ?? null;
        $amount = ($model->credit > 0) ? $model->credit : $model->debit;
    }
@endphp


<div class="row">
    <div class="col-lg-12">
        @if(count($errors) > 0 )
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul class="p-0 m-0" style="list-style: none;">
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Create Receipts <small>Receipts create form</small></h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-4 col-sm-12 mb-3">
                        @isset($model)
                            {!! Form::hidden('bill_number',$model->bill_number) !!}
                        @endisset
                        {!! Form::label('first_account_id','Bank/Cash Account') !!}
                        <strong class="text-danger">*</strong>
                        {!! Form::select('first_account_id',getFirstAccountsList(),$firstAccountId,['class'=>'form-control select2 first_account_id']) !!}
                        @error('first_account_id')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-4 col-sm-12 mb-3">
                        {!! Form::label('second_account_id','Received From') !!}
                        <strong class="text-danger">*</strong>
                        {!! Form::select('second_account_id',getSecondAccountsList(),$secondAccountId,['class'=>'form-control select2 second_account_id']) !!}
                        @error('second_account_id')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-4 col-sm-12 mb-3">
                        {!! Form::label('instr_type','Instrument Type') !!}
                        <strong class="text-danger">*</strong>
                        {!! Form::select('instr_type',getInstrTypeList(),null,['class'=>'form-control select2 instr_type']) !!}
                        @error('instr_type')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-4 col-sm-12 mb-3">
                        {!! Form::label('instrument_no','Instrument Number') !!}
                        {!! Form::text('instrument_no',null,['class'=>'form-control']) !!}
                        @error('instrument_no')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-4 col-sm-12 mb-3">
                        {!! Form::label('instrument_date','Instrument Date') !!}
                        {!! Form::text('instrument_date',now()->format('Y-m-d'),['class'=>'form-control datepicker']) !!}
                        @error('instrument_date')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-4 col-sm-12 mb-2">
                        {!! Form::label('voucher_date','Voucher Date') !!}
                        <strong class="text-danger">*</strong>
                        {!! Form::text('voucher_date',now()->format('Y-m-d'),['class'=>'form-control datepicker']) !!}
                        @error('voucher_date')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-4 col-sm-12 mb-3">
                        {!! Form::label('amount','Amount') !!}
                        <strong class="text-danger">*</strong>
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
