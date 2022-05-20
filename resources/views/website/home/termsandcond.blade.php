@extends("website.layouts.master")
@section("content")
    <section class="banner__area inner">
      <img src="{!!asset('letsgamenow/images/leaderboard-ban.jpg')!!}" class="img-fluid">

      <h2 class="text-center">Terms And Conditions</h2>

      <div class="news__ticker">
        <span>Upcoming Tournaments</span>
        <div id="carouselTicker" class="carouselTicker">
            <ul class="carouselTicker__list">
                <li class="carouselTicker__item">
                    <a href="" class="ticker_cat bg-primary">Strategy</a><a href="#">Mollis leo semper dictum ras ut magna met</a>
                </li>
                <li class="carouselTicker__item">
                    <a href="" class="ticker_cat bg-success">Shooter</a><a href="#">Mollis leo semper dictum ras ut magna met</a>
                </li>
                <li class="carouselTicker__item">
                    <a href="" class="ticker_cat bg-danger">Adventure</a><a href="#">Mollis leo semper dictum ras ut magna met</a>
                </li>
                <li class="carouselTicker__item">
                    <a href="" class="ticker_cat bg-warning">RPG</a><a href="#">Mollis leo semper dictum ras ut magna met</a>
                </li>
                <li class="carouselTicker__item">
                    <a href="" class="ticker_cat bg-info">Racing</a><a href="#">Mollis leo semper dictum ras ut magna met</a>
                </li>
            </ul>
        </div>
      </div>
    </section>

    <section class="sponser_bg pt-5 pb-5">
      
      <div class="container">
        <div class="row">
          <div class="section__title" data-aos="fade-right" data-aos-easing="ease-in-back" data-aos-duration="1000">Terms And Conditions</div>
          <div class="col-sm-12 about__area mt-3">
            <p>{{$terms[0]->content}}</p>

         </div>
        </div>
        
      </div>

      <div class="clearfix p-5"></div>

      <div class="container mt-5">
        <div class="title__area text-center">
          <div class="section__title"><img data-aos="zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000" src="{!!asset('letsgamenow/images/foot-logo.png')!!}"></div>
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