@extends("website.layouts.master")
@section("content")
    <section class="banner__area inner">
      <img src="{!!asset('new-theme\images\site banner\LEADERBOARDS.jpg')!!}" class="img-fluid">

      <h2 class="text-center">OUR LEADERBOARDS</h2>

      <div class="news__ticker">
        <span>Upcoming Tournaments</span>
        <div id="carouselTicker" class="carouselTicker">
            <ul class="carouselTicker__list">
                
            </ul>
        </div>
      </div>
    </section>

    <section class="sponser_bg pt-5 pb-5">
      <div class="title__area text-center">
        <div class="section__title">Won Tournament</div>
        <div class="section__subtitle">Tournament</div>
      </div>

      <div class="explore__tab mt-3 mb-3">
        <div class="container">
          <div class="navbar-nav flex-row justify-content-center filter-option">              
          </div>
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="container">
        <h5 class="leaderboard__name">Won Tournament</h5>
        <div class="leaderboard__table">
        <div class="table__row thead" data-aos="fade-up" data-aos-easing="ease-in-back" data-aos-duration="1000">
            <div class="table__col">Sl No</div>
            <div class="table__col">Name </div>
            <div class="table__col text-center">Tournament</div>
          
          </div>
        <?php $slno = 1; ?>
          @if($winner)
          @foreach($winner as $win)
          <div class="table__row thead" data-aos="fade-up" data-aos-easing="ease-in-back" data-aos-duration="1000">
            <div class="table__col">{{$slno}}</div>
            <div class="table__col">{{$win->fname}} {{$win->lname}} </div>
            <div class="table__col text-center">{{$win->name}}</div>
            </div>
          <?php $slno = $slno + 1; ?>
         @endforeach
         @endif
          
        </div>
      </div>

      <div class="clearfix p-5"></div>

      <!-- <div class="container">
        <p class="text-center">
          <a href="#" class="prev__btn"><span>Prev</span></a>
          <a href="#" class="next__btn"><span>Next</span></a>
        </p>
      </div> -->

      <div class="clearfix p-5"></div>

      <div class="container mt-5">
        <div class="title__area text-center">
          <div class="section__title" data-aos="zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000" ><img src="{!!asset('letsgamenow/images/foot-logo.png')!!}"></div>
          <div class="section__subtitle">About Us</div>
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="container-fluid mt-5 mb-5">
        <div class="about_text" data-aos="fade-up" data-aos-easing="ease-in-back" data-aos-duration="1000">
          <p>Lets Game Now is a simple to use esports portal for all types of gamers. With a variety of online tournaments, gamer will get the chance to qualify for international tournaments, get noticed and build a career as a professional, or just play for fun against friend and compete regularly for cash prizes.</p>
        </div>
      </div>

    </section>
@endsection