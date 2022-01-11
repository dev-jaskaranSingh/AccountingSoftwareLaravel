@extends('layouts.main')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Edit User</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>User</a>
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
        {!! Form::model($model,['method'=>'PUT','route'=>['admin.users.update.password',$model->id]]) !!}
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Update User Password <small>User password update form</small></h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 mb-3">
                                {!! Form::label('password','Password') !!}
                                {!! Form::password('password',['class'=>'form-control']) !!}
                                @error('password')
                                <span class="help-block text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3">
                                {!! Form::label('password_confirmation','Confirm Password') !!}
                                {!! Form::password('password_confirmation',['class'=>'form-control']) !!}
                                @error('password_confirmation')
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

        {!! Form::submit('Update',['class'=>'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
@endsection
