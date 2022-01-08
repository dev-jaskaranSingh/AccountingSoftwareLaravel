@extends('layouts.main')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Employees Import</h5>
                    </div>
                    <div class="ibox-content">
                        {!! Form::open(['files'=>true]) !!}
                            <div class="row">
                                <div class="col-md-3">
                                    {!! Form::label('import','Select File To Import') !!}
                                    {!! Form::file('import',null) !!}
                                </div>
                                <div class="col-md-3">
                                    {!! Form::submit('Import Employee',['class'=>'btn btn-primary mt-3']) !!}
                                </div>
                                <div class="col-md-12 text-success mt-2">
                                    {{ $message }}
                                </div>
                            </div>
                        {!! Form::close() !!}
                        <div class="row mt-5">
                            <div class="col-md-12">
                                <a href="{{ asset('employee_sample_file_import.xlsx') }}">Download Sample File</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
