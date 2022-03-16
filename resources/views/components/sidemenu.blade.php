@php
    $currentRoute = Route::currentRouteName();
    $activeUser = authUser();

    //Master Route Array
    $mastersAccountsGroupRouteArray= ['master.account-groups.index', 'master.account-groups.create', 'master.account-groups.edit', 'master.account-groups.show'];
    $mastersAccountsRouteArray = ['master.accounts.index', 'master.accounts.create', 'master.accounts.edit', 'master.accounts.show'];
    $mastersItemsGroupRouteArray = ['master.items-group.index', 'master.items-group.create', 'master.items-group.edit', 'master.items-group.show'];
    $mastersItemsRouteArray = ['master.items.index', 'master.items.create', 'master.items.edit', 'master.items.show'];
    $mastersHsnRouteArray = ['master.hsn.index', 'master.hsn.create', 'master.hsn.edit', 'master.hsn.show'];
    $mastersUnitsRouteArray = ['master.units.index', 'master.units.create', 'master.units.edit', 'master.units.show'];

    //Final Master Route Array
    $mastersRouteArray = array_merge($mastersAccountsGroupRouteArray,$mastersAccountsRouteArray,$mastersItemsGroupRouteArray,$mastersItemsRouteArray,$mastersHsnRouteArray,$mastersUnitsRouteArray);

    //Transactions Route Array
    $transactionsPurchaseRouteArray = ['transactions.purchases.index', 'transactions.purchases.create', 'transactions.purchases.edit', 'transactions.purchases.show'];
    $transactionsSalesRouteArray = ['transactions.sales.index', 'transactions.sales.create', 'transactions.sales.edit', 'transactions.sales.show'];
    $transactionsReceiptsRouteArray = ['transactions.receipts.index', 'transactions.receipts.create', 'transactions.receipts.edit', 'transactions.receipts.show'];
    $transactionsPaymentRouteArray = ['transactions.payments.index', 'transactions.payments.create', 'transactions.payments.edit', 'transactions.payments.show'];
    $transactionsContraRouteArray = ['transactions.contra.index', 'transactions.contra.create', 'transactions.contra.edit', 'transactions.contra.show'];
    $transactionsJournalRouteArray = ['transactions.journal.index', 'transactions.journal.create', 'transactions.journal.edit', 'transactions.journal.show'];
    $transactionsSalesReturnRouteArray = ['transactions.sales-return.index', 'transactions.sales-return.create', 'transactions.sales-return.edit', 'transactions.sales-return.show'];
    $transactionsPurchaseReturnRouteArray = ['transactions.purchases-return.index', 'transactions.purchases-return.create', 'transactions.purchases-return.edit', 'transactions.purchases-return.show'];

    //Final Transactions Route Array
    $transactionsRouteArray = array_merge(
        $transactionsPurchaseRouteArray,
        $transactionsSalesRouteArray,
        $transactionsReceiptsRouteArray,
        $transactionsPaymentRouteArray,
        $transactionsContraRouteArray,
        $transactionsJournalRouteArray,
        $transactionsSalesReturnRouteArray,
        $transactionsPurchaseReturnRouteArray
    );

    //Reports Route Array
    $reportsTrailBalanceRouteArray = ['reports.trial-balance'];
    $reportsFinanceLedgerRouteArray = ['reports.finance-ledger'];

    //Final Reports Route Array
    $reportsRouteArray = array_merge($reportsTrailBalanceRouteArray,$reportsFinanceLedgerRouteArray);

@endphp
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img alt="image" class="rounded-circle" src="{{authCompany()->logo}}" width="60"/>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">{{$activeUser->name}}</span>
                        <span class="text-muted text-xs block">{{authCompany()->name}}<b
                                class="caret"></b></span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="dropdown-item" href="javascript:void(0)">Profile</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0)">Contacts</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0)">Mailbox</a></li>
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    CORE+
                </div>
            </li>
            <li>
                <a href="javascript:void(0)">
                    <i class="fa fa-th-large"></i>
                    <span class="nav-label">Dashboards</span>
                </a>
            </li>
            @auth('admin')
                <li>
                    <a href="javascript:void(0)"><i class="fa fa-users"></i>
                        <span class="nav-label">Users Management</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{ route('admin.users.index') }}">List users</a></li>
                        <li><a href="{{ route('admin.users.create') }}">Create New</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0)"><i class="fa fa-users"></i>
                        <span class="nav-label">Company Management</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{ route('master.company.index') }}">List Companies</a></li>
                        <li><a href="{{ route('master.company.create') }}">Create New</a></li>
                    </ul>
                </li>
            @endauth

            {{-- MASTERS URLS --}}

            <li class="@if(in_array($currentRoute,$mastersRouteArray)) active @endif">
                <a href="javascript:void(0)"><i class="fa fa-users"></i>
                    <span class="nav-label">Masters</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="@if(in_array($currentRoute,$mastersAccountsGroupRouteArray)) active @endif">
                        <a href="{{ route('master.account-groups.index') }}">Account Group Master</a>
                    </li>
                    <li class="@if(in_array($currentRoute,$mastersAccountsRouteArray)) active @endif">
                        <a href="{{ route('master.accounts.index') }}">Account Master</a>
                    </li>
                    <li class="@if(in_array($currentRoute,$mastersHsnRouteArray)) active @endif">
                        <a href="{{ route('master.hsn.index') }}">HSN Master</a>
                    </li>
                    <li class="@if(in_array($currentRoute,$mastersItemsGroupRouteArray)) active @endif">
                        <a href="{{ route('master.items-group.index') }}">Item Group Master</a>
                    </li>
                    <li class="@if(in_array($currentRoute,$mastersItemsRouteArray)) active @endif">
                        <a href="{{ route('master.items.index') }}">Item Master</a>
                    </li>
                    <li class="@if(in_array($currentRoute,$mastersUnitsRouteArray)) active @endif">
                        <a href="{{ route('master.units.index') }}">Unit Master</a>
                    </li>
                </ul>
            </li>

            {{-- TRANSACTIONS URLS --}}

            <li class="@if(in_array($currentRoute,$transactionsRouteArray)) active @endif">
                <a href="javascript:void(0)"><i class="fa fa-users"></i>
                    <span class="nav-label">Transactions</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="@if(in_array($currentRoute,$transactionsPurchaseRouteArray)) active @endif">
                        <a href="{{ route('transactions.purchases.index') }}">Purchase</a>
                    </li>
                    <li class="@if(in_array($currentRoute,$transactionsSalesRouteArray)) active @endif">
                        <a href="{{ route('transactions.sales.index') }}">Sale</a>
                    </li>
                    <li class="@if(in_array($currentRoute,$transactionsPurchaseReturnRouteArray)) active @endif">
                        <a href="{{ route('transactions.purchases-return.index') }}">Purchase Return</a>
                    </li>
                    <li class="@if(in_array($currentRoute,$transactionsSalesReturnRouteArray)) active @endif">
                        <a href="{{ route('transactions.sales-return.index') }}">Sale Return</a>
                    </li>
                    <li class="@if(in_array($currentRoute,$transactionsReceiptsRouteArray)) active @endif">
                        <a href="{{ route('transactions.receipts.index') }}">Receipt</a>
                    </li>
                    <li class="@if(in_array($currentRoute,$transactionsPaymentRouteArray)) active @endif">
                        <a href="{{ route('transactions.payments.index') }}">Payment</a>
                    </li>
                    <li class="@if(in_array($currentRoute,$transactionsContraRouteArray)) active @endif">
                        <a href="{{ route('transactions.contra.index') }}">Contra</a>
                    </li>
                    <li class="@if(in_array($currentRoute,$transactionsJournalRouteArray)) active @endif">
                        <a href="{{ route('transactions.journal.index') }}">Journal</a>
                    </li>
                    <li><a href="javascript:void(0)">Stock In</a></li>
                    <li><a href="javascript:void(0)">Stock Out</a></li>
                </ul>
            </li>

            {{-- Reports URLS --}}
            <li class="@if(in_array($currentRoute,$reportsRouteArray)) active @endif">
                <a href="javascript:void(0)"><i class="fa fa-users"></i>
                    <span class="nav-label">Reports</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="@if(in_array($currentRoute,$reportsTrailBalanceRouteArray)) active @endif">
                        <a href="{{ route('reports.trial-balance')  }}">Trail Balance</a>
                    </li>
                    <li class="@if(in_array($currentRoute,$reportsFinanceLedgerRouteArray)) active @endif">
                        <a href="{{ route('reports.ledger-report') }}">Finance Ledger Report</a>
                    </li>
                    <li><a href="javascript:void(0)">Sale Register</a></li>
                    <li><a href="javascript:void(0)">Purchase Register</a></li>
                    <li><a href="javascript:void(0)">Sale Return</a></li>
                    <li><a href="javascript:void(0)">Purchase Return</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
