 
 <nav class="navbar navbar-dark bg-info  navbar-fixed-top ">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar bg-primary"></span>
                    <span class="icon-bar bg-primary"></span>
                    <span class="icon-bar bg-primary"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src= "{{ URL:: asset('assets/images/logo.svg')}}" style = "height: 110%; width: auto; " />
                </a>
            </div>

            <div class="collapse navbar-collapse text text-warning" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav ">
                    <li>
                        <a href="{{ url('/home') }}" class="text text-warning">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            Home
                        </a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}" >Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else

                        @if(Auth::user()->role_id == 1)   
                        <li>
                            <a href="{{ url('/company/stats/dashboard') }}">
                              <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard
                            </a>
                        </li>                  
                        <li>
                            <a href="{{ url('/company/team/view') }}">
                              <i class="fa fa-users" aria-hidden="true"></i> Teams
                            </a>
                        </li>
                        
                        <!-- <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Member
                                <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/company/member/') }}">
                                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                                     Add Member
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/company/member/view') }}">
                                    <i class="fa fa-btn fa-user"></i> view Members
                                    </a>
                                </li>
                            </ul>
                        </li> -->

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Task
                                <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/company/task/') }}">
                                    <i class="fa fa-tasks" aria-hidden="true"></i>  New Task
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/company/task/view') }}">
                                    <i class="fa fa-tasks" aria-hidden="true"></i>  view Tasks
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/company/member/view') }}">
                                    <i class="fa fa-btn fa-user"></i> view Members
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        @if(Auth::user()->role_id == 2)
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Task
                                    <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    
                                    <li>
                                        <a href="{{url('/members/tasks/')}}">
                                        <i class="fa fa-tasks" aria-hidden="true"></i>  view Tasks
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <i class="fa fa-empire" aria-hidden="true"></i>
                                {{ Auth::user()->lastname }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                        <li>
                                                 
                    @endif
                </ul>
            </div>
        </div>
    </nav>