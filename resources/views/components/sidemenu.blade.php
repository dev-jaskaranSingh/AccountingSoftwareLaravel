@php
    $currentRoute = Route::currentRouteName();
    $activeUser = Auth::guard('admin','user')->user();

    //Master Route Array
    $mastersAccountsGroupRouteArray= ['master.account-groups.index', 'master.account-groups.create', 'master.account-groups.edit', 'master.account-groups.show'];
    $mastersAccountsRouteArray = ['master.accounts.index', 'master.accounts.create', 'master.accounts.edit', 'master.accounts.show'];
    $mastersItemsGroupRouteArray = ['master.items-group.index', 'master.items-group.create', 'master.items-group.edit', 'master.items-group.show'];
    $mastersItemsRouteArray = ['master.items.index', 'master.items.create', 'master.items.edit', 'master.items.show'];
    $mastersHsnRouteArray = ['master.hsn.index', 'master.hsn.create', 'master.hsn.edit', 'master.hsn.show'];
    $mastersUnitsRouteArray = ['master.units.index', 'master.units.create', 'master.units.edit', 'master.units.show'];
    $mastersRouteArray = array_merge($mastersAccountsGroupRouteArray,$mastersAccountsRouteArray,$mastersItemsGroupRouteArray,$mastersItemsRouteArray,$mastersHsnRouteArray,$mastersUnitsRouteArray);

    //Transactions Route Array
    $transactionsPurchaseRouteArray = ['transactions.purchases.index', 'transactions.purchases.create', 'transactions.purchases.edit', 'transactions.purchases.show'];
    $transactionsSalesRouteArray = ['transactions.sales.index', 'transactions.sales.create', 'transactions.sales.edit', 'transactions.sales.show'];
    $transactionsRouteArray = array_merge($transactionsPurchaseRouteArray,$transactionsSalesRouteArray)
@endphp
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img alt="image" class="rounded-circle" src="{{Session::get('company')->logo}}" width="60"/>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">{{$activeUser->name}}</span>
                        <span class="text-muted text-xs block">{{Session::get('company')->name}}<b
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
            <li class="@if(in_array($currentRoute,$transactionsRouteArray)) active @endif">
                <a href="javascript:void(0)"><i class="fa fa-users"></i>
                    <span class="nav-label">Transactions</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="@if(in_array($currentRoute,$transactionsSalesRouteArray)) active @endif">
                        <a href="{{ route('transactions.sales.index') }}">Sale</a>
                    </li>
                    <li class="@if(in_array($currentRoute,$transactionsPurchaseRouteArray)) active @endif">
                        <a href="{{ route('transactions.purchases.index') }}">Purchase</a>
                    </li>
                    <li><a href="">Sale Return</a></li>
                    <li><a href="">Purchase Return</a></li>
                    <li><a href="">Receipt</a></li>
                    <li><a href="">Payment</a></li>
                    <li><a href="">Journal</a></li>
                    <li><a href="">Contra</a></li>
                    <li><a href="">Stock In</a></li>
                    <li><a href="">Stock Out</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0)"><i class="fa fa-users"></i>
                    <span class="nav-label">Reports</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="">Trail Balance</a></li>
                    <li><a href="">Ledger Report</a></li>
                    <li><a href="">Sale Register</a></li>
                    <li><a href="">Purchase Register</a></li>
                    <li><a href="">Sale Return</a></li>
                    <li><a href="">Purchase Return</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
