<!-- Main navbar -->
<div class="navbar navbar-expand-md navbar-dark">
        <div class="navbar-brand">
            <a href="index.html" class="d-inline-block">
                 <img src="{{url('new-theme/images/letsgamenow.png')}}" alt="">
            </a>
        </div>
        <div class="d-md-none">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
                <i class="icon-tree5"></i>
            </button>
            <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
                <i class="icon-paragraph-justify3"></i>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navbar-mobile">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                        <i class="icon-paragraph-justify3"></i>
                    </a>
                </li>
            </ul>
            <span class="badge bg-success ml-md-3 mr-md-auto" style="visibility:hidden;">Admin Panel</span>
            <ul class="navbar-nav">
                <li class="nav-item dropdown dropdown-user">
                    <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
                      <img src="{{url('new-theme/images/login_logo.png')}}" class="rounded-circle mr-2" height="34" alt="">
                        <span>{{Auth::user()->name}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="{{route('profile')}}" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>
                        <div class="dropdown-divider"></div>
                        <a href="{{route('cng_pwd')}}" class="dropdown-item"> Change Password</a>
                        <a href="{{ route('logout') }}" class="dropdown-item"  onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i class="icon-switch2"></i> Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                             @csrf
                        </form>      
                    </div>
                </li>
            </ul>
        </div>
</div>
    <!-- /main navbar -->