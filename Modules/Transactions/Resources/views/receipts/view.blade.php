@extends('layouts.main')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Receipt Details</h5>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Key</th>
                                <th>Value</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($model->toArray() as $key => $data)
                                @if($key != 'id' )
                                    <tr>
                                        <td>{{ str_replace('_',' ',ucfirst($key)) }}</td>
                                        <td>{{ $data}}</td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                        <a href="{{ route('transactions.receipts.index') }}" class="btn btn-danger">Go Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
