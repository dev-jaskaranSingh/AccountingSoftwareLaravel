<head>
    <base href="{{ asset('template') }}/">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Core Accounting</title>
    <style>
        .password {
            -webkit-text-security: disc !important;
        }
    </style>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('template/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/css/plugins/jasny/jasny-bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('template/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('template/css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
    <link href="{{ asset('template/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
    <link href="{{ asset('template/css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
    <link href="{{ asset('template/css/plugins/clockpicker/clockpicker.css')}}" rel="stylesheet">
    <link href="{{ asset('template/css/plugins/select2/select2.min.css')}}" rel="stylesheet">
    <link href="{{ asset('template/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('template/css/style.css?ref='.rand(1111,9999)) }}" rel="stylesheet">
    <link href="{{ asset('template/css/plugins/iCheck/custom.css')}}" rel="stylesheet">
    <link href="{{ asset('template/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}"
          rel="stylesheet">
    <link href="{{ asset('js/hot/handsontable.full.css') }}" rel="stylesheet">
    <link href="{{ asset('js/tabs-scroll/jquery.scrolling-tabs.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('js/datetime/jquery.datetimepicker.min.css') }}">
    <link href="{{ asset('template/css/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet">
    <link href="{{ asset('css/chosen.css') }}" rel="stylesheet">

    <!-- FooTable -->
    <link href="{{ asset('template/css/plugins/footable/footable.core.css')}}" rel="stylesheet">

    <script type="text/javascript">
        window.route = '{{ url('/') }}';
    </script>

</head>
