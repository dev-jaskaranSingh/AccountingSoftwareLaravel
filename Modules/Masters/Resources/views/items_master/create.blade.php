@extends('layouts.main')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Create Item</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Item</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Create</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        {!! Form::open(['route'=>'master.items.store']) !!}
            @include('masters::items_master._form')
            {!! Form::submit('Create',['class'=>'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>

    <div class="text-center">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal5">
            Large Modal
        </button>
    </div>
    <div class="modal inmodal fade" id="myModal6" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-sm">
            {!! Form::open(['route' => 'master.units.store']) !!}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
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

    <div class="modal inmodal fade" id="myModal7" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-sm">
            {!! Form::open(['route'=>'master.items-group.store']) !!}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
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


@endsection
