@extends('layouts.main')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">

            <div class="col-lg-12">
                {!! Form::open(['route' => 'reports.trial-balance-master']) !!}
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        {!! Form::label('date','Select Date') !!}
                        <strong class="text-danger">*</strong>
                        {!! Form::text('date',now()->format('Y-m-d'),['class'=>'form-control datepicker']) !!}
                        @error('date')
                            <span class="help-block text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6 col-sm-12">
                        {!! Form::submit('Submit',['class'=>'btn btn-primary mt-4']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
                <br/>
            </div>

            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>{!! getCurrentRouteTitle() !!} List</h5>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Account</th>
                                    <th>Date</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Balance</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($model as $key => $value)
                                    <tr>
                                        <td>{{ ++$loop->index }}</td>
                                        <td>{{ $value['account_name'] }}</td>
                                        <td>{{ $value['bill_date'] }}</td>
                                        <td>{{ $value['debit'] }}</td>
                                        <td>{{ $value['credit'] }}</td>
                                        <td>{{ $value['balance'] }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            {{--                            {!! $dataTable->table(['class'=>'table table-striped table-bordered table-hover']) !!}--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js')}}"></script>
    {{--    {!! $dataTable->scripts() !!}--}}
    {{--    <script type="text/javascript">--}}
    {{--        $(document).on('click', '.delete-row', function () {--}}
    {{--            if (confirm('Are you sure to delete this record?')) {--}}
    {{--                $(this).parent('form').submit();--}}
    {{--            }--}}
    {{--        });--}}
    {{--    </script>--}}
@endsection
@endsection
