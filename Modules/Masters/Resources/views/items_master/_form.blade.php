<div class="row">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Create Item <small>Item create form</small></h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('name','Name') !!}
                        <strong class="text-danger">*</strong>
                        {!! Form::text('name',null,['class'=>'form-control']) !!}
                        @error('name')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('item_group_id','Select Item Group') !!}
                        <a href="javascript::0">
                            &nbsp;<i class="fa fa-1x fa-plus text-success" data-toggle="modal"
                                     data-target="#myModal7"></i>
                        </a>
                        <strong class="text-danger">*</strong>
                        {!! Form::select('item_group_id',\Modules\Masters\Entities\ItemGroupMaster::pluck('name','id')->prepend('Select', null),@$model->item_group_id,['class'=>'select2 form-control select']) !!}
                        @error('item_group_id')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('sale_price','Sale Price') !!}
                        <strong class="text-danger">*</strong>
                        {!! Form::number('sale_price',null,['class'=>'form-control']) !!}
                        @error('sale_price')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('purchase_price','Purchase Price') !!}
                        <strong class="text-danger">*</strong>
                        {!! Form::number('purchase_price',null,['class'=>'form-control']) !!}
                        @error('purchase_price')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('opening_balance','Opening balance') !!}
                        {!! Form::number('opening_balance',isset($model) ? $model->opening_balance : 0,['class'=>'form-control']) !!}
                        @error('opening_balance')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('hsn_id','Select HSN') !!}
                        <a href="javascript::0">
                            &nbsp;<i class="fa fa-1x fa-plus text-success" data-toggle="modal"
                                     data-target="#myModal8"></i>
                        </a>
                        <strong class="text-danger">*</strong>
                        {!! Form::select('hsn_id',\Modules\Masters\Entities\HsnMaster::pluck('hsn_code','id')->prepend('Select', null),@$mode->hsn_id,['class'=>'select2 form-control select']) !!}
                        @error('hsn_id')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('unit_id','Select Unit') !!}
                        <a href="javascript::0">
                            &nbsp;<i class="fa fa-1x fa-plus text-success" data-toggle="modal"
                                     data-target="#myModal6"></i>
                        </a>
                        <strong class="text-danger">*</strong>
                        {!! Form::select('unit_id',\Modules\Masters\Entities\UnitMaster::pluck('name','id')->prepend('Select', null),@$model->unit_id,['class'=>'select2 form-control select']) !!}
                        @error('unit_id')
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
