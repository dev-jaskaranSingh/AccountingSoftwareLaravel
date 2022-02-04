{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>--}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- Mainly scripts -->
<script src="{{ asset('template/js/popper.min.js') }}"></script>
<script src="{{ asset('template/js/bootstrap.js') }}"></script>
<script src="{{ asset('template/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('template/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

<!-- Clock picker -->
<script src="{{ asset('template/js/plugins/clockpicker/clockpicker.js')}}"></script>

<!-- Flot -->
<script src="{{ asset('template/js/plugins/flot/jquery.flot.js') }}"></script>
<script src="{{ asset('template/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
<script src="{{ asset('template/js/plugins/flot/jquery.flot.spline.js') }}"></script>
<script src="{{ asset('template/js/plugins/flot/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('template/js/plugins/flot/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('template/js/plugins/flot/jquery.flot.symbol.js') }}"></script>
<script src="{{ asset('template/js/plugins/flot/jquery.flot.time.js') }}"></script>

<!-- Data picker -->
<script src="{{ asset('template/js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>

<!-- Peity -->
<script src="{{ asset('template/js/plugins/peity/jquery.peity.min.js') }}"></script>
<script src="{{ asset('template/js/demo/peity-demo.js') }}"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('template/js/inspinia.js') }}"></script>
<script src="{{ asset('template/js/plugins/pace/pace.min.js') }}"></script>

<!-- jQuery UI -->
{{-- <script src="{{ asset('template/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script> --}}

<!-- Jvectormap -->
<script src="{{ asset('template/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
<script src="{{ asset('template/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>

<!-- EayPIE -->
<script src="{{ asset('template/js/plugins/easypiechart/jquery.easypiechart.js') }}"></script>

<!-- Sparkline -->
<script src="{{ asset('template/js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

<script src="{{ asset('template/js/plugins/dataTables/datatables.min.js')}}"></script>
<script src="{{ asset('template/js/plugins/dataTables/dataTables.bootstrap4.min.js')}}"></script>

<script src="{{ asset('template/js/plugins/toastr/toastr.min.js')}}"></script>
<!-- Jquery Validate -->
<script src="{{ asset('template/js/plugins/validate/jquery.validate.min.js')}}"></script>

<!-- Select2 -->
<script src="{{ asset('template/js/plugins/select2/select2.full.min.js')}}"></script>

{{-- Hands On Table--}}
<script src="{{ asset('js/hot/handsontable.full.min.js') }}"></script>
<script src="{{ asset('js/tabs-scroll/jquery.scrolling-tabs.min.js') }}"></script>
<script src="{{ asset('js/hot/chosen.jquery.js') }}"></script>
<script src="{{ asset('js/hot/handsontable-chosen-editor.js') }}"></script>
<!-- FooTable -->
<script src="{{ asset('template/js/plugins/footable/footable.all.min.js')}}"></script>

<!-- Sparkline demo data  -->
<script src="{{ asset('template/js/demo/sparkline-demo.js') }}"></script>

<script src="{{ asset('template/js/plugins/typehead/bootstrap3-typeahead.min.js') }}"></script>


<script src="{{ asset('js/datetime/jquery.datetimepicker.full.min.js') }}" type="text/javascript"></script>


<!-- SUMMERNOTE -->
<script src="{{ asset('template/js/plugins/summernote/summernote-bs4.js')}}"></script>

<script type="text/javascript">
    window.route = '{{ url('/') }}';
    window.modal_error = null;
    @if(session()->has('modal_error'))
        window.modal_error = '{{ session('modal_error') }}';
    @endif
</script>
<script src="{{ asset('js/validations.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/custom.js?ref='.rand(1111,9999)) }}"></script>
<!-- iCheck -->
<script src="{{ asset('template/js/plugins/iCheck/icheck.min.js') }}"></script>
@php
    $toDate = Session::get('company')->to_date;
    $fromDate = Session::get('company')->from_date;

@endphp
<script>
    console.log('{{$toDate}}');
    console.log('{{$fromDate}}');
    function getCurrentFinancialYearForPurchase(strDocDate) {
        var startYear = "";
        var endYear = "";
        var docDate = new Date(strDocDate);
        if ((docDate.getMonth() + 1) <= 3) {
            startYear = docDate.getFullYear() - 1;
            endYear = docDate.getFullYear();
        } else {
            startYear = docDate.getFullYear();
            endYear = docDate.getFullYear() + 1;
        }
        return {startDate : '{{ $fromDate }}' , endDate:  '{{ $toDate }}' };
    }

    $(document).ready(function () {

    $('.purchaseDatePicker').datepicker({
        format: 'yyyy-mm-dd',
        maxViewMode: 0,
        todayBtn: "linked",
        clearBtn: true,
        autoclose: true,
        todayHighlight: true,
        startDate: getCurrentFinancialYearForPurchase($('input.purchaseDatePicker').val()).startDate,
        endDate: getCurrentFinancialYearForPurchase($('input.purchaseDatePicker').val()).endDate
    });

        $('.datepicker').on('change', function(e){
            console.log(e);
            console.log($(this).val());
        });

        $('form').attr('autocomplete', 'false');
        $('input').attr('autocomplete', 'false');

        $('.select2').select2();

        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {
                    text: 'Create',
                    action: function (e, dt, node, config) {
                        window.location.href = $('.form-link').val();
                    }
                },
                {extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'ExampleFile'},
                {extend: 'pdf', title: 'ExampleFile'},
                {
                    extend: 'print',
                    customize: function (win) {
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ]

        });



        toastr.options = {
            closeButton: true,
            debug: false,
            progressBar: true,
            preventDuplicates: true,
            hideDuration: 800,
            showDuration: 300,
            extendedTimeOut: 4000,
            positionClass: 'toast-top-right',
        };
        @if(session()->has('success'))
        @php
            $message = explode('|',session('success'))
        @endphp
        toastr.success('{{ $message[1] }}', '{{ $message[0] }}')
        @elseif(session()->has('error'))
        @php
            $message = explode('|',session('error'))
        @endphp
        toastr.error('{{ $message[1] }}', '{{ $message[0] }}')
        @endif


        $('.static-datatable').dataTable();
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
        $('.clockpicker').clockpicker();
        $('.text-editor').summernote({
            height: 350,
        });
    });
</script>

@section('scripts')
@show
