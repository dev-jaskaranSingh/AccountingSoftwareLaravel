<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img alt="image" class="rounded-circle" src="img/profile_small.jpg"/>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">David Williams</span>
                        <span class="text-muted text-xs block">Art Director <b class="caret"></b></span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="dropdown-item" href="javascript:void(0)">Profile</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0)">Contacts</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0)">Mailbox</a></li>
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    CP+
                </div>
            </li>
            <li>
                <a href="javascript:void(0)"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span></a>
            </li>
            @auth('employee')
                <li>
                    <a href="{{ route('employee.my-salary') }}"><i class="fa fa-credit-card"></i> <span class="nav-label">My Salary</span></a>
                </li>
            @endauth
            @auth('admin')
                <li>
                    <a href="javascript:void(0)"><i class="fa fa-users"></i> <span class="nav-label">Employee Master</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{ route('admin.employees') }}">List Employee</a></li>
                        <li><a href="{{ route('admin.employee.create') }}">Create New</a></li>
                    <li><a href="{{ route('admin.employee.import') }}">Import</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('admin.departments') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Departments</span></a>
                </li>
                <li>
                    <a href="{{ route('admin.categories') }}"><i class="fa fa-square-o"></i> <span class="nav-label">Categories</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Salaries</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{ route('admin.salaries') }}">List Salaries</a></li>
                        <li><a href="{{ route('admin.salary.create') }}">Create New</a></li>
                        <li><a href="{{ route('admin.salary.import') }}">Import Salary</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('admin.loans') }}"><i class="fa fa-file-excel-o"></i> <span class="nav-label">Loans</span></a>
                </li>
                <li>
                    <a href="javascript:void(0)"><i class="fa fa-bank"></i> <span class="nav-label">PF Statement</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{ route('admin.pf.report') }}">PF Statement</a></li>
                        <li><a href="{{ route('admin.pf.final.settlement') }}">PF Final Settlement</a></li>
                    </ul>
                </li>
            @endauth
        </ul>
    </div>
</nav>
