@extends('layouts.main')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Edit Item</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Item</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Edit</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        {!! Form::model($model,['method'=>'PUT','route'=>['master.items.update',$model->id]]) !!}
            @include('masters::items_master._form')
        {!! Form::submit('Update',['class'=>'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
@endsection

<div class="modal inmodal fade" id="myModal7" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        {!! Form::open(['route'=>'master.items-group.store']) !!}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span
                        aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h6 class="modal-title">Create Item Group</h6>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 mb-3">
                        {!! Form::label('name','Item Group Name') !!}
                        {!! Form::text('name',null,['class'=>'form-control']) !!}
                        @error('name')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-12 col-sm-12 mb-3 text-center">
                        {!! Form::label('is_primary','Is Primary') !!}
                        {!! Form::checkbox('is_primary',null,false,['class'=>'form-control is_primary2']) !!}
                        @error('is_primary')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-12 col-sm-12 mb-3 subgroup2">
                        {!! Form::label('sub_group_id','Select Sub Group') !!}
                        {!! Form::select('sub_group_id',\Modules\Masters\Entities\AccountGroup::pluck('name','id')->prepend('Select',null),null,['class'=>'form-control select']) !!}
                        @error('sub_group_id')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                {!! Form::submit('Create',['class'=>'btn btn-primary']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>

<div class="modal inmodal fade" id="myModal8" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        {!! Form::open(['route'=>'master.hsn.store']) !!}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span
                        aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h6 class="modal-title">Create HSN</h6>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('hsn_code','Hsn code') !!}
                        {!! Form::text('hsn_code',null,['class'=>'form-control']) !!}
                        @error('hsn_code')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('min_amount','Min Amount') !!}
                        {!! Form::number('min_amount',null,['class'=>'form-control']) !!}
                        @error('min_amount')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('gst_min_percentage','GST Min (%)') !!}
                        {!! Form::number('gst_min_percentage',null,['class'=>'form-control']) !!}
                        @error('gst_min_percentage')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('gst_max_percentage','GST Max (%)') !!}
                        {!! Form::number('gst_max_percentage',null,['class'=>'form-control']) !!}
                        @error('gst_max_percentage')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-12 col-sm-12 mb-3">
                        {!! Form::label('hsn_description','HSN Description') !!}
                        {!! Form::textarea('hsn_description',null,['class'=>'form-control']) !!}
                        @error('hsn_description')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                {!! Form::submit('Create',['class'=>'btn btn-primary']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>

<script>
    $('.is_primary2').on('change',function () {
        if($(this).is(':checked')){
            $('.subgroup2').hide();
        }else{
            $('.subgroup2').show();
        }
    });
</script>
