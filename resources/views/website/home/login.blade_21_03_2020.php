<!doctype html>
<html lang="en">
    <style type="text/css">
    .alert {
        position: fixed;
        top: 100px;
        right: 50px;
        z-index: 999;
    }
    </style>
  {{--include styles--}}
  @include("website.layouts.header")
  <body>
    
    <section class="login__area">
      <div class="container-fluid">
        <div class="row">
             
          <div class="col-sm-6 text-center p-4 p-sm-5">
            <a href="{{route('home.index')}}" >
            <img src="{!!asset('letsgamenow/images/logo.png')!!}" class="mb-5" data-aos="fade-down" data-aos-duration="1000" width="160px"> </a>
             @if(Session::has('message'))
            <!--<div class="alert {{ Session::get('alert-class', 'alert-info') }}">-->
            <!--    <a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a>-->
            <!--    {{ Session::get('message') }}-->
            <!--</div>-->
            <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">
              {{ Session::get('message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif
            <div class="login__block">
               
              <form class="login__form" method="post"action="{{route('gamer.login.submit')}}">
                @csrf
                <div class="form-group flex-column text-left" data-aos="fade-top" data-aos-duration="1000" data-aos-easing="ease-in-sine">
                  <label class="control-label">Choose User Type:</label>
                  <div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" id="customRadioInline1" name="gamer_type" value="1" class="custom-control-input">
                      <label class="custom-control-label" for="customRadioInline1">Individual</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" id="customRadioInline2" name="gamer_type"value="2" class="custom-control-input">
                      <label class="custom-control-label" for="customRadioInline2">Team</label>
                    </div>
                  </div>
                </div>
                <div class="form-group" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                  <button type="button" class=""><span class="fas fa-envelope"></span></button>
                  <input type="email" name="email" value="" placeholder="Please enter your Email" required="">
                </div>

                <div class="form-group" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                  <button type="button" class=""><span class="fas fa-key"></span></button>
                  <input type="password" name="password" value="" placeholder="Please enter your Password" required="">
                </div>
                <div class="row align-items-center">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <button type="submit" class="" data-aos="fade-right" data-aos-duration="1000" data-aos-easing="ease-in-sine">Submit Now</button>
                    </div>
                  </div>
                  <div class="col-sm-6 text-right">
                    <p data-aos="fade-bottom" data-aos-duration="1000" data-aos-easing="ease-in-sine"><a href="#">Forgot Password?</a></p>
                  </div>
                </div>

                <div class="row align-items-center">
                  <div class="col-sm-6 text-left">
                    <p data-aos="fade-bottom" data-aos-duration="1000" data-aos-easing="ease-in-sine"><a href="#">Don't have an Account?</a></p>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group justify-content-end">
                      <a href="{{route('gamer.register')}}" class="signin__btn" data-aos="fade-left" data-aos-duration="1000" data-aos-easing="ease-in-sine">Register Now</a>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script type="text/javascript" src="{!! asset('letsgamenow/js/bootstrap.min.js')!!}"></script>
    <script type="text/javascript" src="{!! asset('letsgamenow/js/slick.min.js')!!}"></script>
    <script type="text/javascript" src="{!! asset('letsgamenow/js/jquery.carouselTicker.min.js')!!}"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script type="text/javascript">
      $(window).on("load", function() {
        $("#carouselTicker").carouselTicker();
      });
      $(window).on("scroll", function () {
        if ($(window).scrollTop() > 104) {
          $("header").addClass("top");
        } else {
          $("header").removeClass("top");
        }
      });
    </script>
    <script>
      AOS.init();
    </script>
    <script type="text/javascript">
      $(document).ready(function(){

        $('.slide__wrapper').slick({
          dots: false,
          infinite: false,
          speed: 300,
          autoplay: true,
          autoplaySpeed: 2000,
          slidesToShow: 6,
          slidesToScroll: 1,
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: true
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
          ]
        });

         $(document).on('click', '.filter-option a', function(){
          $('.filter-option a').removeClass('active');
            $(this).addClass('active');

            var cat = $(this).attr('data-category');
            if(cat !== 'all'){
              $('.slide__wrapper').slick('slickUnfilter');
              $('.slide__wrapper li').each(function(){
                $(this).removeClass('slide-shown');
              });
              $('.slide__wrapper li[data-match='+ cat +']').addClass('slide-shown');
              $('.slide__wrapper').slick('slickFilter', '.slide-shown');
            }
        
            else{
              $('.slide__wrapper li').each(function(){
                $(this).removeClass('slide-shown');
              });
              $('.slide__wrapper').slick('slickUnfilter');
            }
          });
          $('.news__list__horizon').slick({
            dots: false,
            infinite: false,
            speed: 300,
            autoplay: true,
            autoplaySpeed: 5000,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            asNavFor: '.news__list'
          });

          $('.news__list').slick({
            vertical: true,
            infinite: true,
            verticalSwiping: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            arrows: false,
            focusOnSelect: true,
            asNavFor: '.news__list__horizon'
          });

          $('.video__list').slick({
            dots: false,
            infinite: false,
            speed: 300,
            autoplay: true,
            autoplaySpeed: 2000,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
              {
                breakpoint: 1024,
                settings: {
                  slidesToShow: 3,
                  slidesToScroll: 3,
                  infinite: true,
                  dots: true
                }
              },
              {
                breakpoint: 600,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 2
                }
              },
              {
                breakpoint: 480,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1
                }
              }
              // You can unslick at a given breakpoint now by adding:
              // settings: "unslick"
              // instead of a settings object
            ]
          });

          $('.testimonials').slick({
            dots: false,
            infinite: true,
            speed: 300,
            centerMode: true,
            arrows: false,
            centerPadding: '60px',
            autoplay: true,
            autoplaySpeed: 5000,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
              {
                breakpoint: 1024,
                settings: {
                  slidesToShow: 3,
                  slidesToScroll: 3,
                  infinite: true,
                  dots: true
                }
              },
              {
                breakpoint: 600,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 2
                }
              },
              {
                breakpoint: 480,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1
                }
              }
              // You can unslick at a given breakpoint now by adding:
              // settings: "unslick"
              // instead of a settings object
            ]
          });
      });
    </script>

  </body>
</html>