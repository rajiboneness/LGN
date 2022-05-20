@extends("website.layouts.master")
@section("content")
<style type="text/css">
.videoWrapper { position: relative; padding-bottom: 56.25%; /* 16:9 */ height: 0; }
.videoWrapper iframe { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }
</style>
<section class="banner__area" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-offset="0">
      <ul class="banner">
        @foreach($banners as $banner)
        <li><a href="{{$banner->description}}"><img src="{{URL::asset($banner->image)}}" class="img-fluid"></a></li>
        @endforeach
        
      </ul>

      <div class="news__ticker" data-aos="fade-up" data-aos-easing="ease-in-back" data-aos-delay="500" data-aos-duration="1000">
        <span>Upcoming Tournaments</span>
        <div id="carouselTicker" class="carouselTicker">
            <ul class="carouselTicker__list">
                @foreach($upcoming_tournaments as $upcoming_tournament)
                <li class="carouselTicker__item">
                    <a href="" class="ticker_cat bg-primary">{{$upcoming_tournament->game_name}}</a><a href="#">{{$upcoming_tournament->name}} is starting from {{date("M.d.Y",strtotime($upcoming_tournament->start_date))}}. Register today to participate.</a>
                </li>
              @endforeach
            </ul>
        </div>
      </div>
    </section>
{{--    <section class="dark_bg pt-5 pb-5">--}}
{{--      <div class="container">--}}
{{--        <div class="videoWrapper">--}}
{{--          <iframe width="949" height="534" src="https://www.youtube.com/embed/8yiWSS_PpRs" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>--}}
{{--        </div>--}}
{{--      </div>--}}
{{--    </section>--}}

    <section class="dark_bg pt-5 pb-5">

      <div class="title__area text-center">
        <div class="section__title">All New Games</div>
        <div class="section__subtitle">Latest Games</div>
      </div>

      <!-- <div class="explore__tab mt-3 mb-3">
        <div class="container">
          <div class="navbar-nav flex-row justify-content-center filter-option">
            <a class="nav-item nav-link active" href="javaScript:void(0)" data-category="all">All</a>
            @foreach($games as $game)
            <a class="nav-item nav-link" href="javaScript:void(0)" data-category="game{{$game->id}}">{{$game->name}}</a>
            @endforeach
            
          </div>
        </div>
      </div> -->

      <div class="clearfix"></div>

      <ul class="slide__wrapper" data-aos="fade-up" data-aos-easing="ease-in-back" data-aos-duration="1000">
        @foreach($games as $game)
        <li data-match="game{{$game->id}}" onclick="location.href='{!! URL::to('upcoming-tournaments') !!}'">
          <div class="slide__block">
            <img src="{{URL::asset($game->image)}}">
            <div class="slide__content">
              <div class="rating">
                Rating 
                <span class="ratings">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                </span>
              </div>
              <h3><a href="#">{{$game->name}}</a></h3>
            </div>
          </div>
        </li>
        @endforeach
      </ul>
    </section>


    <section class="bluedark_bg pt-5 pb-5">
      <div class="title__area text-center">
        <div class="section__title">Hot News</div>
        <div class="section__subtitle">Latest News</div>
      </div>

      <div class="clearfix"></div>

      <div class="container mt-5">
        <div class="row">
          <div class="col-sm-8 order-sm-12" data-aos="fade-right" data-aos-easing="ease-in-back" data-aos-duration="1000">
            <ul class="news__list__horizon">
              @foreach($news as $n)
              @php $key = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $n->title)); @endphp
              <li>
                <div class="news__blocks" style="background-image: url({{URL::asset($n->image)}});">
                  <div class="news__blocks__body">
                    <a href="#">{{$n->title}}</a>
                    <h4>{{$n->post_date}}</h4>
                  </div>
                  <div class="news__blocks__footer">
                    <div class="col d-flex p-0">
                      <div class="col">
                        <p>Category</p>
                        <h4>{{$news_categories_arr[$n->category_id]}}</h4>
                      </div>
                     <!--  <div class="col">
                        <p>Likes</p>
                        <h4><i class="far fa-eye"></i> 0</h4>
                      </div> -->
                      <div class="col">
                        <!-- <p>View</p>
                        <h4><i class="fas fa-heart"></i> 0</h4> -->
                      </div>
                    </div>
                    <div class="col-5 col-sm-3 ml-auto p-0">
                      <a href="{!! URL::to('news-details/'.$n->id.'/'.$key) !!}" class="news__button">More Details <i class="fas fa-arrow-right"></i></a>
                    </div>
                  </div>
                </div>
              </li>
              @endforeach
            </ul>
          </div>
          <div class="col-sm-4 order-sm-1" data-aos="fade-left" data-aos-easing="ease-in-back" data-aos-duration="1000">
            <ul class="news__list">
              @foreach($news as $n)
              
              <li>
                <div class="news__image">
                  <img src="{{URL::asset($n->image)}}">
                </div>
                <div class="news__content">
                  <h2>{{$n->title}}</h2>
                  <!-- <p>Na'Vi moves to second in European ESL Pro League</p> -->
                  <h4><a href="" class="badge badge-primary">{{$news_categories_arr[$n->category_id]}}</a> {{$n->post_date}}</h4>
                </div>
              </li>
              @endforeach
              
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- <section class="pt-5 pb-5">
      <div class="container">
        <div class="title__area light">
          <div class="section__title" data-aos="fade-right" data-aos-easing="ease-in-back" data-aos-duration="1000">Featured Streams</div>
          <div class="section__subtitle">Latest Videos</div>
        </div>
      </div>

      <div class="clearfix"></div> 

      <div class="container mt-5">
        <div class="video__row">
          <ul class="video__list" data-aos="fade-left" data-aos-easing="ease-in-back" data-aos-duration="1000">
            <li>
              <a data-fancybox href="https://www.youtube.com/watch?v=XeIYOcOE6s8" class="video__block" style="background-image: url({!!asset('letsgamenow/images/thumb_01.jpg')!!});">
                <span class="badge badge-primary ml-auto">Strategy</span>
                <i class="fas fa-play text-center mt-auto"></i>
                <div class="video__desc mt-auto">
                  <p>FILIP MRAVIC</p>
                  <p class="text-danger">BLOCKBUSTER SKIN UNLOCKED</p>
                </div>
              </a>
            </li>
            <li>
              <a data-fancybox href="https://www.youtube.com/watch?v=XeIYOcOE6s8" class="video__block" style="background-image: url({!!asset('letsgamenow/images/thumb_02.jpg')!!});">
                <span class="badge badge-danger ml-auto">Racing</span>
                <i class="fas fa-play text-center mt-auto"></i>
                <div class="video__desc mt-auto">
                  <p>FILIP MRAVIC</p>
                  <p class="text-danger">BLOCKBUSTER SKIN UNLOCKED</p>
                </div>
              </a>
            </li>
            <li>
              <a data-fancybox href="https://www.youtube.com/watch?v=XeIYOcOE6s8" class="video__block" style="background-image: url({!!asset('letsgamenow/images/thumb_03.jpg')!!});">
                <span class="badge badge-info ml-auto">Shooter</span>
                <i class="fas fa-play text-center mt-auto"></i>
                <div class="video__desc mt-auto">
                  <p>FILIP MRAVIC</p>
                  <p class="text-danger">BLOCKBUSTER SKIN UNLOCKED</p>
                </div>
              </a>
            </li>
            <li>
              <a data-fancybox href="https://www.youtube.com/watch?v=XeIYOcOE6s8" class="video__block" style="background-image: url({!!asset('letsgamenow/images/thumb_04.jpg')!!});">
                <span class="badge badge-success ml-auto">Adventure</span>
                <i class="fas fa-play text-center mt-auto"></i>
                <div class="video__desc mt-auto">
                  <p>FILIP MRAVIC</p>
                  <p class="text-danger">BLOCKBUSTER SKIN UNLOCKED</p>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </section> -->

    <section class="testimonial_bg pt-5 pb-5">
      <div class="container">
        <div class="title__area text-center">
          <div class="section__title">Players Testimonials</div>
          <div class="section__subtitle">ALL REVIEWS</div>
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="container-fluid mt-5">
        <div class="testimonial__row">
          <ul class="testimonials" data-aos="fade-down" data-aos-easing="ease-in-back" data-aos-duration="1000">
           @foreach($testimonials as $testimonial)
            <li>
              <div class="testimonial_block">
                <span class="test__image"><img src="{{URL::asset($testimonial->image)}}" style="width: 100px;"></span>
                <p>{!!$testimonial->content!!}</p>
                <h4>{{$testimonial->author}}</h4>
              </div>
            </li>
            @endforeach
          </ul>
        </div>
      </div>
    </section>

    <section class="sponser_bg pt-5 pb-5">
      <div class="container">
        <div class="title__area text-center">
          <div class="section__title">Trusted By</div>
          <div class="section__subtitle">ALL REVIEWS</div>
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="container-fluid mt-5 mb-5">
        <ul class="sponsors_list">
          @foreach($sponsors as $sponsor)
          <li data-aos="zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000" ><img src="{{URL::asset($sponsor->image)}}"></li>
          @endforeach
          
        </ul>
      </div>

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
