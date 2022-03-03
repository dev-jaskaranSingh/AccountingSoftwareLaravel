@extends('layouts.main')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Payment List</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            {!! $dataTable->table(['class'=>'table table-striped table-bordered table-hover']) !!}
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
    {!! $dataTable->scripts() !!}
    <script type="text/javascript">
        $(document).on('click', '.delete-row', function () {
            if (confirm('Are you sure to delete this record?')) {
                $(this).parent('form').submit();
            }
        });
    </script>
@endsection
@endsection
