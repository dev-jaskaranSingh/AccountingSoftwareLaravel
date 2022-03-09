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
                <h5>Create Sale <small>Sale create form</small></h5>
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
                        {{-- $invoiceNumber = str_pad($invoiceNumber, 2, '0', STR_PAD_LEFT);--}}
                        @php
                            $invoiceNumber = getSalesMaxInvoices()+1;
                            $fromYear = \Carbon\Carbon::parse(authCompany()->from_date)->format('y');
                            $toYear = \Carbon\Carbon::parse(authCompany()->to_date)->format('y');
                            $finalInvoice = 'SB/'.$fromYear.'-'.$toYear.'/'.$invoiceNumber;
                        @endphp
                        {!! Form::label('invoice_number','Invoice Number') !!}
                        {!! Form::hidden('invoice_number',$invoiceNumber) !!}
                        {!! Form::text('invoice',$finalInvoice,['class'=>'form-control','readonly' => true]) !!}
                        @error('invoice_number')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
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
                        <div class="hot-container">
                            <div id="hot-table"></div>
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        <div class="row">
                            <div class="col-md-4 offset-8 text-right">
                                <table border="1" cellpadding="5">
                                    <tr>
                                        <th width="180px">Total Amount</th>
                                        <th width="150px">
                                            <input type="number" name="total_amount" class="total_amount"
                                                   placeholder="0.00" readonly="true"/>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th width="180px">Total Discount</th>
                                        <th width="150px"><input type="number" name="total_discount"
                                                                 class="total_discount" placeholder="0.00"
                                                                 readonly="true"></th>
                                    </tr>

                                    <tr>
                                        <th width="180px">Total Net</th>
                                        <th width="150px">
                                            <input type="number" name="total_net_amount" class="total_net_amount"
                                                   placeholder="0.00" readonly="true">
                                        </th>
                                    </tr>
                                    <tr>
                                        <th width="180px">CGST</th>
                                        <th width="150px"><input type="number" name="cgst" class="cgst"
                                                                 placeholder="0.00" readonly="true"/></th>
                                    </tr>
                                    <tr>
                                        <th width="180px">SGST</th>
                                        <th width="150px"><input type="number" name="sgst" class="sgst"
                                                                 placeholder="0.00" readonly="true"/></th>
                                    </tr>
                                    <tr>
                                        <th width="180px">IGST</th>
                                        <th width="150px"><input type="number" name="igst" class="igst"
                                                                 placeholder="0.00" readonly="true"/></th>
                                    </tr>
                                    <tr>
                                        <th width="180px">TCS</th>
                                        <th width="150px">
                                            <input type="number" class="tcs" placeholder="0.00"/>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th width="180px">Round Off &nbsp;&nbsp;
                                            <select class="roundOffSelection" name="roundOffSelection">
                                                <option value="plus"> +</option>
                                                <option value="minus"> -</option>
                                            </select>
                                        </th>
                                        <th width="150px">
                                            <input type="number" class="roundOffValue" name="roundOffValue"
                                                   placeholder="0.00"/>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th width="180px">Grand Total</th>
                                        <th width="150px">
                                            <input class="grand_total_amount" name="grand_total_amount"
                                                   placeholder="0.00" readonly="true"
                                                   type="number"/>
                                        </th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <hr/>
                <br/>
            </div>
        </div>
    </div>
</div>

{!! Form::hidden('product',json_encode(@$items),['class'=>'products-data']) !!}
{!! Form::hidden('purchase_items',json_encode(@$purchase_items),['class'=>'purchase-items']) !!}
{!! Form::hidden('bill_products',null,['class'=>'purchase_products']) !!}
{!! Form::hidden('company_state_code',authCompany()->gst_state_code,['class'=>'company_state_code']) !!}

@section('scripts')
    <script src="{{ asset('js/sales.js?ref='.rand(1111,9999)) }}" type="text/javascript"></script>
@endsection
