<style>
    .hot-container {
        width: 100%;
        height: 400px;
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
                <h5>Create Purchase <small>Purchase create form</small></h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('account_id','Select Account') !!}
                        {!! Form::select('account_id',\Modules\Masters\Entities\AccountMaster::whereNotNull('created_at')->pluck('name','id')->prepend('Select Account',null),null,['class'=>'form-control select2 account_id']) !!}
                        @error('account_id')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('invoice_number','Invoice Number') !!}
                        {!! Form::text('invoice_number',\Modules\Transactions\Entities\Purchase::getMaxInvoices()+1,['class'=>'form-control']) !!}
                        @error('invoice_number')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        <hr/>
                            <strong>Details</strong>
                        <hr/>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                Billed To:
                            </div>
                            <div class="col-md-8">
                               <div class="billed_to">-</div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                GST:
                            </div>
                            <div class="col-md-8">
                                <div class="gst">-</div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                PAN:
                            </div>
                            <div class="col-md-8">
                                <div class="pan">-</div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                Place of Supply:
                            </div>
                            <div class="col-md-8">
                                <div class="place_of_supply">-</div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                State Code:
                            </div>
                            <div class="col-md-8">
                                <div class="state_code">-</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 mb-3">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 mb-3">
                                {!! Form::label('invoice_date','Invoice Date') !!}
                                {!! Form::text('invoice_date',now()->format('Y-m-d'),['class'=>'form-control datepicker']) !!}
                                @error('invoice_date')
                                <span class="help-block text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-12 col-sm-12 mb-3">
                                {!! Form::label('shipped_to','Shipped To') !!}
                                {!! Form::textarea('shipped_to',null,['class'=>'form-control','rows'=>4]) !!}
                                @error('shipped_to')
                                <span class="help-block text-danger">
                                {{ $message }}
                            </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>
                <hr/>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <h3>Total Amount: <span class="total_amount"></span></h3>
                            </div>
                        </div>
                        <div class="hot-container">
                            <div id="hot-table"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{!! Form::hidden('product',json_encode(@$items),['class'=>'products-data']) !!}
{!! Form::hidden('purchase_items',json_encode(@$purchase_items),['class'=>'purchase-items']) !!}
{!! Form::hidden('bill_products',null,['class'=>'purchase_products']) !!}



@section('scripts')
    <script src="{{ asset('js/purchase.js?ref='.rand(1111,9999)) }}" type="text/javascript"></script>
@endsection
