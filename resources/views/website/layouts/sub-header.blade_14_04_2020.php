@if(Auth::guard('gamer')->check())
@php $user =Auth::guard('gamer')->user(); @endphp
@endif
   <header class="d-block" data-aos="zoom-out-up" data-aos-easing="ease-in-back" data-aos-duration="1000">
      <div class="top__bar">
        <div class="container">
          <div class="row">
            <div class="col-6 col-sm-6">
              <ul class="navbar-nav mr-auto">
              @if(!Auth::guard('gamer')->check() )
                <li class="nav-item active">
                  <a class="nav-link" href="{{route('home.login')}}">LOGIN</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('gamer.register')}}">REGISTER</a>
                </li>
             @endif
             @if(Auth::guard('gamer')->check())
                <li class="nav-item active">
                  <a class="nav-link" href="{{route('gamer.logout')}}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">LOGOUT</a>
                </li>
                <form id="logout-form" action="{{ route('gamer.logout') }}" method="POST" style="display: none;">
                 @csrf
                   </form>  
                <li class="nav-item">
                  <a class="nav-link" href="{{route('gamer.profile',$user->id)}}">PROFILE</a>
                </li>
                @endif
              </ul>
            </div>
            <div class="col-6 col-sm-6">
              <ul class="navbar-nav flex-row-reverse mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="https://www.facebook.com/lgnindia"><i class="fab fa-facebook-f"></i></a>
                </li>
                <li class="nav-item">
                  <!-- <a class="nav-link" href="https://twitter.com/lets_game_now"><i class="fab fa-twitter"></i></a> -->
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <?php
      $url_segments = request()->segments();
      $segment = (is_array($url_segments) && count($url_segments)>0)?$url_segments[0]:'';
      //echo $segment;
      //die();
      ?>
      <div class="container bottom__bar">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand" href="#" data-aos="fade-down" data-aos-easing="ease-in-back" data-aos-duration="1000" data-aos-delay="500"><img src="{!! asset('letsgamenow/images/logo.png')!!}" width="140px"></a>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item <?php if($segment==''){echo "active";} ?>">
                <a class="nav-link" href="{!! URL::to('') !!}">HOME</a>
              </li>
              <li class="nav-item <?php if($segment=='games'){echo "active";} ?>">
                <a class="nav-link" href="{!! URL::to('games') !!}">GAMES</a>
              </li>
              <li class="nav-item <?php if($segment=='tournament'){echo "active";} ?>">
                <a class="nav-link" href="{!! URL::to('tournament') !!}">TOURNAMENTS</a>
              </li>
            </ul>
            <ul class="navbar-nav ml-auto">
              <li class="nav-item <?php if($segment=='leaderboards'){echo "active";} ?>">
                <a class="nav-link" href="{!! URL::to('leaderboards') !!}">LEADERBOARDS</a>
              </li>
              <li class="nav-item <?php if($segment=='site-news'){echo "active";} ?>">
                <a class="nav-link" href="{!! URL::to('site-news') !!}">NEWS</a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-search"></i> SEARCH</a>
              </li> -->
            </ul>
          </div>
        </nav>
      </div>
    </header>