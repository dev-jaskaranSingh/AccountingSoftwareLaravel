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
                <a href="javascript:void(0)"><i class="fa fa-th-large"></i> <span
                        class="nav-label">Dashboards</span></a>
            </li>
            @auth('user')
{{--                <li>--}}
{{--                    <a href=""><i class="fa fa-credit-card"></i> <span class="nav-label">My Salary</span></a>--}}
{{--                </li>--}}
            @endauth
            @auth('admin')
                <li>
                    <a href="javascript:void(0)"><i class="fa fa-users"></i>
                        <span class="nav-label">Users Management</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="">List users</a></li>
                        <li><a href="">Create New</a></li>
                    </ul>
                </li>
            @endauth
            <li>
                <a href="javascript:void(0)"><i class="fa fa-users"></i>
                    <span class="nav-label">Masters</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="">Account Master</a></li>
                    <li><a href="">Group Master</a></li>
                    <li><a href="">HSN Master</a></li>
                    <li><a href="">Item Master</a></li>
                    <li><a href="">Item Group Master</a></li>
                    <li><a href="">Unit Master</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0)"><i class="fa fa-users"></i>
                    <span class="nav-label">Transactions</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="">List users</a></li>
                    <li><a href="">Create New</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0)"><i class="fa fa-users"></i>
                    <span class="nav-label">Reports</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="">List users</a></li>
                    <li><a href="">Create New</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
