<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a href="{{url('home')}}" class="navbar-brand"><b>{{ config('app.name', 'CHEDRO') }}</b></a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="navbar-collapse pull-left collapse" id="navbar-collapse" aria-expanded="false">

                <ul class="nav navbar-nav">
                    @if (Auth::user()->isADMIN())

                    <li class="{{ Request::segment(2) === 'user' ? 'active' : '' }}">
                        <a href="{{ url('admin/user')}}">
                            <span>Users</span>
                        </a>
                    </li>

                    <li class="{{ Request::segment(2) === 'document' ? 'active' : '' }}">
                        <a href="{{ url('admin/document')}}">
                            <span>Documents</span>
                        </a>
                    </li>

                    <li class="{{ Request::segment(2) === 'institution' ? 'active' : '' }}">
                        <a href="{{ url('admin/institution')}}">
                            <span>Institution</span>
                        </a>
                    </li>

                    <li class="{{ Request::segment(2) === 'logs' ? 'active' : '' }}">
                        <a href="{{ url('admin/logs')}}">
                            <span>Logs</span>
                        </a>
                    </li>

                    <li class="{{ Request::segment(2) === 'report' ? 'active' : '' }}">
                        <a href="{{ url('admin/report')}}">
                            <span>Reports</span>
                        </a>
                    </li>

                     <li class="{{ Request::segment(2) === 'archive' ? 'active' : '' }}">
                        <a href="{{ url('admin/archive')}}">
                            <span>Archives</span>
                        </a>
                    </li>

                    @endif @if (Auth::user()->isPACD())

                    <li class="{{ Request::segment(2) === 'transaction' ? 'active' : '' }}">
                        <a href="{{ url('pacd/transaction')}}">
                            <span>Generate Transaction</span>
                        </a>
                    </li>

                    @endif @if (Auth::user()->isCEPS() || Auth::user()->isESII() || Auth::user()->isEPS() || Auth::user()->isCAO() || Auth::user()->isACCT() || Auth::user()->isSECRETARY() || Auth::user()->isCASHIER() || Auth::user()->isRECORD() || Auth::user()->isPURCHASER() )

                    <li class="{{ Request::segment(1) === 'track' ? 'active' : '' }}">
                        <a href="{{ url('track')}}">
                            <span>Assigned Transactions <span class="label  bg-yellow"><?php echo $count_assign; ?></span> </span>
                        </a>
                    </li>

                    @endif

                    <li>
                        <a href="{{ url('home')}}">
                            <span>Monitoring</span>
                        </a>
                    </li>

                </ul>

            </div>
            <!-- /.navbar-collapse -->
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('img/logo/CHED-LOGO.png') }} " class="user-image" alt="User Image">
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->

                            <!-- Menu Body -->

                            <!-- Menu Footer-->
                            <li class="user-footer">

                                <div>
                                    <a class="btn btn-danger btn-block btn-flat" href="{{ route('logout') }}" onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-custom-menu -->
        </div>
        <!-- /.container-fluid -->
    </nav>
</header>