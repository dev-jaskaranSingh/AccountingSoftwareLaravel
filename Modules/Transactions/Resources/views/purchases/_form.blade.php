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

<div class="modal inmodal fade" id="purchasePartyForm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span
                        aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h6 class="modal-title">Create Unit</h6>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 mb-3">
                        {!! Form::label('name','Unit Name') !!}
                        {!! Form::text('name',null,['class'=>'form-control']) !!}
                        @error('name')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-12 col-sm-12 mb-3">
                        {!! Form::label('name','Unit Name') !!}
                        {!! Form::text('name',null,['class'=>'form-control']) !!}
                        @error('name')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-12 col-sm-12 mb-3">
                        {!! Form::label('name','Unit Name') !!}
                        {!! Form::text('name',null,['class'=>'form-control']) !!}
                        @error('name')
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
                        {!! Form::text('invoice_number',null,['class'=>'form-control']) !!}
                        @error('invoice_number')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('bill_date','Bill Date') !!}
                        {!! Form::text('bill_date',now()->format('Y-m-d'),['class'=>'form-control purchaseDatePicker']) !!}
                        @error('bill_date')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('purchase_date','Purchase Date') !!}
                        {!! Form::text('purchase_date',now()->format('Y-m-d'),['class'=>'form-control purchaseDatePicker']) !!}
                        @error('purchase_date')
                        <span class="help-block text-danger">
                        {{ $message }}
                    </span>
                        @enderror
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
                                            <input type="number" name="tcs" class="tcs" placeholder="0.00"/>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th width="180px">Round Off &nbsp;&nbsp;
                                            <select class="roundOffSelection" name="round_off_type">
                                                <option value="plus"> +</option>
                                                <option value="minus"> -</option>
                                            </select>
                                        </th>
                                        <th width="150px">
                                            <input type="number" class="roundOffValue" name="round_off_value"
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
    <script src="{{ asset('js/purchase.js?ref='.rand(1111,9999)) }}" type="text/javascript"></script>
@endsection
