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
                        {!! Form::text('name',null,['class'=>'form-control']) !!}
                        @error('name')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('item_group_id','Select Item Group') !!}
                        &nbsp;<i class="fa fa-1x fa-plus text-success" data-toggle="modal" data-target="#myModal7"></i>
                        {!! Form::select('item_group_id',[\Modules\Masters\Entities\ItemGroupMaster::pluck('name','id')],null,['class'=>'select2 form-control select']) !!}
                        @error('item_group_id')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('unit_id','Select Unit') !!}
                        &nbsp;<i class="fa fa-1x fa-plus text-success" data-toggle="modal" data-target="#myModal6"></i>
                        {!! Form::select('unit_id',[\Modules\Masters\Entities\UnitMaster::pluck('name','id')],null,['class'=>'select2 form-control select']) !!}
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
