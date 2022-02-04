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
                        {!! Form::label('account_id','Select Party') !!}
                        {!! Form::select('account_id',\Modules\Masters\Entities\AccountMaster::whereNotNull('created_at')->pluck('name','id')->prepend('Select Party',null),null,['class'=>'form-control select2 account_id']) !!}
                        @error('account_id')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('invoice_number','Invoice Number') !!}
                        {!! Form::text('invoice_number',\Modules\Transactions\Entities\Purchase::getMaxInvoices()+1,['class'=>'form-control','readonly' => true]) !!}
                        @error('invoice_number')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

{{--                    <div class="col-md-6 col-sm-12 mb-3">--}}
{{--                        <div class="row mb-2">--}}
{{--                            <div class="col-md-4">--}}
{{--                                State Code:--}}
{{--                                <h2><div class="state_code">-</div></h2>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-8">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="col-md-6 col-sm-12 mb-3">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 mb-3">
                                {!! Form::label('bill_date','Bill Date') !!}
                                {!! Form::text('bill_date',now()->format('Y-m-d'),['class'=>'form-control purchaseDatePicker']) !!}
                                @error('bill_date')
                                <span class="help-block text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
{{--                            <div class="col-md-12 col-sm-12 mb-3">--}}
{{--                                {!! Form::label('shipped_to','Shipped To') !!}--}}
{{--                                {!! Form::textarea('shipped_to',null,['class'=>'form-control','rows'=>4]) !!}--}}
{{--                                @error('shipped_to')--}}
{{--                                <span class="help-block text-danger">--}}
{{--                                {{ $message }}--}}
{{--                            </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
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
@dump(Session::get('company')->gst_state_code)
{!! Form::hidden('product',json_encode(@$items),['class'=>'products-data']) !!}
{!! Form::hidden('purchase_items',json_encode(@$purchase_items),['class'=>'purchase-items']) !!}
{!! Form::hidden('bill_products',null,['class'=>'purchase_products']) !!}
{!! Form::hidden('company_state_code',Session::get('company')->gst_state_code,['class'=>'company_state_code']) !!}


@section('scripts')
    <script src="{{ asset('js/purchase.js?ref='.rand(1111,9999)) }}" type="text/javascript"></script>
@endsection
