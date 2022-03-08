@extends('layouts.main')
@section('content')
    @php
        $getInstrTypeList = getInstrTypeList();
        $getFirstAccountsList = getAccountsList();
    @endphp

    <input type="hidden" name="getFirstAccountsList" value="{{json_encode($getFirstAccountsList,true)}}"/>
    <input type="hidden" name="getInstrTypeList" value="{{json_encode($getInstrTypeList,true)}}"/>

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Create {!! getCurrentRouteTitle() !!}</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>{!! getCurrentRouteTitle() !!}</a>
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
        {!! Form::open(['route' => 'transactions.journal.store','id' => 'journalForm']) !!}
        @include('transactions::journal._form')
        {!! Form::button('Add',['class'=>'btn btn-primary addJournalButton']) !!}
        {!! Form::close() !!}
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Selected Accounts</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Debit/Credit</th>
                                <th>Account</th>
                                <th>Inst Type</th>
                                <th>Instrument Number</th>
                                <th>Instrument Date</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Narration</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="selectedAccounts">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        {!! Form::open(['route' => 'transactions.journal.store']) !!}
        {!! Form::hidden('journalFormValues') !!}
        {!! Form::submit('Save',['class'=>'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
@endsection
@section('scripts')
    <script>

        function resetForm() {
            $('#journalForm').trigger("reset");
        }

        let selectedAccounts = [];
        let selectedAccountsHtml = '';
        let narration = $('#narration');
        let amount = $('#amount');
        let instrument_date = $('#instrument_date');
        let instrument_no = $('#instrument_no');
        let instr_type = $('#instr_type');
        let creditOrDebit = $('#creditOrDebit');
        let account_id = $('#account_id');


        displaySelectedAccounts(selectedAccounts);

        function displaySelectedAccounts(selectedAccountsData) {
            selectedAccountsHtml = '';
            selectedAccountsData.forEach(function (account) {
                selectedAccountsHtml += `<tr>
                    <td>${account?.creditOrDebit}</td>
                    <td>${account?.accountName}</td>
                    <td>${account?.instr_type}</td>
                    <td>${account?.instrument_no}</td>
                    <td>${account?.instrument_date}</td>
                    <td>${account?.debit}</td>
                    <td>${account?.credit}</td>
                    <td>${account?.narration}</td>
                    <td>
                        <button class="btn btn-danger btn-sm removeAccount" data-id="${account.account_id}">Remove</button>
                    </td>
                </tr>`;
            });
            $('#selectedAccounts').html(selectedAccountsHtml);
            $('input[name="journalFormValues"]').val(JSON.stringify(selectedAccountsData));
        }


        $('body').on('click','.removeAccount',function () {
            let id = $(this).data('id');
            console.log(id);
            selectedAccounts = selectedAccounts.filter(function (account) {
                return account.account_id != id;
            });
            displaySelectedAccounts(selectedAccounts);
        });


        $('.addJournalButton').on('click', (function (e) {

            console.clear();
            e.preventDefault();
            e.stopPropagation();

            if (creditOrDebit.val() == '') {
                creditOrDebit.addClass('is-invalid');
                toastr.error('Please select a credit or debit','Error');
                return false;
            } else {
                creditOrDebit.removeClass('is-invalid');
            }


            if (account_id.val() == '') {
                account_id.addClass('is-invalid');
                toastr.error('Please select an account','Error');
                return false;
            } else {
                account_id.removeClass('is-invalid');
            }

            if (instr_type.val() == '') {
                instr_type.addClass('is-invalid');
                toastr.error('Please select an instrument type','Error');
                return false;
            } else {
                instr_type.removeClass('is-invalid');
            }

            if (instrument_date.val() == '') {
                instrument_date.addClass('is-invalid');
                toastr.error('Please select an instrument date','Error');
                return false;
            } else {
                instrument_date.removeClass('is-invalid');
            }

            if (amount.val() == '') {
                amount.addClass('is-invalid');
                toastr.error('Please enter an amount','Error');
                return false;
            } else {
                amount.removeClass('is-invalid');
            }



            let getInstrTypeList = $('input[name=getInstrTypeList]').val();
            let getFirstAccountsList = $('input[name=getFirstAccountsList]').val();

            let getInstrTypeListJSON = JSON.parse(getInstrTypeList);
            let getFirstAccountsListJSON = JSON.parse(getFirstAccountsList);

            let formDataObj = {
                creditOrDebit : creditOrDebit.val(),
                account_id: account_id.val(),
                accountName: getFirstAccountsListJSON[account_id.val()],
                instr_type: instr_type.val(),
                instrument_no: instrument_no.val(),
                instrument_date: instrument_date.val(),
                debit: creditOrDebit.val() === 'debit' ? amount.val() : 0,
                credit: creditOrDebit.val() === 'credit' ? amount.val() : 0,
                narration: narration.val(),
            };
            selectedAccounts.push(formDataObj);
            displaySelectedAccounts(selectedAccounts);
            resetForm();

        }));
    </script>
@endsection
