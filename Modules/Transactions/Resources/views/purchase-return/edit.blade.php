@extends('layouts.main')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Edit {!! getCurrentRouteTitle() !!}</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>{!! getCurrentRouteTitle() !!}</a>
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
        {!! Form::model($model,['method'=>'PUT','route'=>['transactions.purchases-return.update',$model->id]]) !!}
            @include('transactions::purchase-return._form')
        {!! Form::submit('Update',['class'=>'btn btn-primary']) !!}
        <a href="{{ route('transactions.purchases-return.index') }}" class="btn btn-danger">Cancel</a>
        {!! Form::close() !!}
    </div>
@endsection
