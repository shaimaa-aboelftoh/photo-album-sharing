<!-- Sidenav -->
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
                aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{url('/')}}">
            <img src="{{asset('site/images/logo-m.png')}}" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                   aria-expanded="false">
                    <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                <img alt="{{Auth::user()->name}}" src="{{asset('admin/img/user3.png')}}">
                </span>
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
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="dropdown-item">
                        <i class="ni ni-user-run"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{url('/')}}">
                            <img src="{{asset('site/images/logo-m.png')}}">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                                data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                                aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ is_active('home')}}" href="{{route('home')}}">
                        <i class="ni ni-tv-2 text-primary"></i> Home
                    </a>
                </li>
                <a class="nav-link {{ is_active('album.*')}} collapsed" href="#navbar-user" data-toggle="collapse"
                   role="button" aria-expanded="{{area_expand('album.*')}}"
                   aria-controls="navbar-forms">
                    <i class="ni ni-album-2 text-green"></i>
                    <span class="nav-link-text">Albums</span>
                </a>
                <div class="collapse {{ show_collapsed('album.*')}}" id="navbar-user" style="">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{route('album.all')}}"
                               class="nav-link {{is_active('album.all') }}">All Albums</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('album.create')}}"
                               class="nav-link {{ is_active('album.create')}}">Create Album</a>
                        </li>
                    </ul>
                </div>
            </ul>
            <!-- Divider -->
            <hr class="my-3">
            <!-- Navigation -->
            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a class="nav-link {{ is_active('profile.edit')}}"
                       href="{{route('profile.edit')}}">
                        <i class="ni ni-single-02 text-yellow"></i> Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run text-danger"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
