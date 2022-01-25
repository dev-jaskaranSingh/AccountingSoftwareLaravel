<div class="row">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Create Purchase <small>Purchase create form</small></h5>
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


<style>
    .hot-container {
        width: 100%;
        height: 400px;
        overflow: hidden;
    }
    .address{
        height: 100px;
    }
    .filterHeader input{
        width: 90%;
        margin: 0 auto 10px;
    }
</style>
@section('scripts')
    <script src="{{ asset('js/purchase.js?ref='.rand(1111,9999)) }}" type="text/javascript"></script>
@endsection
