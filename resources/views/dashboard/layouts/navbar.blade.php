<!-- Top navbar -->
<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{route('dashboard.index')}}">Admin Dashboard
            | {{Auth::user()->name}}</a>
        <!-- Form -->
    {{-- <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
     <div class="form-group mb-0">
         <div class="input-group input-group-alternative">
         <div class="input-group-prepend">
             <span class="input-group-text"><i class="fas fa-search"></i></span>
         </div>
         <input class="form-control" placeholder="Search" type="text">
         </div>
     </div>
     </form>--}}
    <!-- User -->

        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
            <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                <img alt="{{Auth::user()->name}}" src="{{asset('admin/img/user3.png')}}">
                </span>
                        <div class="media-body ml-2 d-none d-lg-block">
                            <span class="mb-0 text-sm  font-weight-bold" id="auth-user-name">{{str_limit(Auth::user()->name,15)}}</span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome</h6>
                    </div>
                    <a href="{{route('profile.edit')}}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>Profile</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">
                        <i class="ni ni-user-run"></i>
                        <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
