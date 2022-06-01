@extends('layouts.main')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <form action="{{ route('reports.ledger-report-master') }}">
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::label('account_id','Credit Account') !!}
                            <strong class="text-danger">*</strong>
                            {!! Form::select('account_id',getAccountsListForLedger(),request()->get('account_id'),['class'=>'form-control select2 account_id']) !!}
                            @error('account_id')
                            <span class="help-block text-danger">
                                        {{ $message }}
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md-4 col-sm-12 mb-3">
                        {!! Form::label('from_date','From Date') !!}
                        <strong class="text-danger">*</strong>
                        {!! Form::text('from_date',null,['class'=>'form-control customDatePicker']) !!}
                        @error('from_date')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-4 col-sm-12 mb-3">
                        {!! Form::label('to_date','To Date') !!}
                        <strong class="text-danger">*</strong>
                        {!! Form::text('to_date',null,['class'=>'form-control customDatePicker']) !!}
                        @error('to_date')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary mt-4">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <br />
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>{!! getCurrentRouteTitle() !!}</h5>
                        <h5 class="hide float-right" id="openblnc"></h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            {!! $dataTable->table(['class'=>'table table-striped table-bordered table-hover'],true) !!}

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
<script >

    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy'
    });
</script>
    
    <script>

 $(document).ready(function() {
    
var url      = window.location.href;

var date = url.split("&");
if(date){
    if(date['1']){
        
    var fromDate = date['1'].split("from_date=")['1']; 
    $("#from_date").datepicker().datepicker('setDate', fromDate);
    
    var toDate = date['2'].split("to_date=")['1']; 
    $("#to_date").datepicker().datepicker('setDate', toDate);
    
    }
}
    setTimeout(function () {
        var table = $('#finance-ledger-datatable-table').dataTable();
        var hours = table.fnGetData();
        $(document).ready(function(){
        $("tfoot tr>th:nth-child(1)").text("Total");
            calculateColumn(hours);
        })

    }, 2000);
    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy'
    });
 });
  function calculateColumn(index) {
            var credittotal = 0;
            var openingblnc = 0;
            var debittotal = 0;
            var balancetotal = 0;
            var i = 0;
            $('table tr').each(function () {
                if(index.length == i ){
                    return false;
                }
                creditval = parseInt(index[i].credit);
                // alert(creditval);
                if (!isNaN(creditval)) {
                    credittotal+=creditval;
                }
                debitval = parseInt(index[i].debit);
                if (!isNaN(debitval)) {
                    debittotal+=debitval;
                }
                openingblncval = parseInt(index[i].account.opening_balance);
                var accounts = index[i].account;
                console.log(accounts);
                    if(accounts.account_type == "credit"){
                        balancetotal = openingblncval+debittotal-credittotal;
                    }
                    if(accounts.account_type == "debit"){
                        balancetotal = openingblncval+debittotal-credittotal;
                    }
                if (!isNaN(openingblncval)) {
                    if(accounts.account_type == "credit"){

                        openingblnc= openingblncval;
                    }else{

                        openingblnc= openingblncval;
                    }
                }
                i++;
                
            });
            $('#openblnc').show();
            $('tfoot tr>th:nth-child('+ (5) +')').text(debittotal);
            $('tfoot tr>th:nth-child('+ (6) +')').text(credittotal);
            $('tfoot tr>th:nth-child('+ (7) +')').text(balancetotal);
            $('#openblnc').text("Opening Balance : "+openingblnc);
        }

    </script>
@endsection
@endsection
