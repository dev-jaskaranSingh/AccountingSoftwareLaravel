@extends('layouts.main')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Create Purchase</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Purchase</a>
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
        {!! Form::open(['route' => 'transactions.sales.store']) !!}
        @include('transactions::sales._form')
        {!! Form::submit('Create',['class'=>'btn btn-primary']) !!}
        <a href="{{ route('transactions.sales.index') }}" class="btn btn-danger">Cancel</a>
        {!! Form::close() !!}
    </div>
@endsection
