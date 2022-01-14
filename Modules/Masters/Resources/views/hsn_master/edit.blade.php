@extends('layouts.main')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Edit HSN</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>HSN</a>
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
        {!! Form::model($model,['method'=>'PUT','route'=>['master.hsn.update',$model->id]]) !!}
            @include('masters::hsn_master._form')
        {!! Form::submit('Update',['class'=>'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
@endsection
