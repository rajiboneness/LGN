<!-- Optional JavaScript -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    {{-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script> --}}

    <script

        src="https://code.jquery.com/jquery-2.2.4.min.js"

        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="

        crossorigin="anonymous"></script>

    <script type="text/javascript" src="{!! asset('letsgamenow/js/jquery-3.3.1.min.js')!!}"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>

    <script type="text/javascript" src="{!! asset('letsgamenow/js/bootstrap.min.js')!!}"></script>    

    <script type="text/javascript" src="{!! asset('letsgamenow/js/slick.min.js')!!}"></script>

    <script type="text/javascript" src="{!! asset('letsgamenow/js/jquery.carouselTicker.min.js')!!}"></script>

    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

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

     $(window).on('load', function () {

       AOS.refresh();

     });

     $(function () {

       AOS.init();

     });

   </script>

    <script type="text/javascript">

      $(document).ready(function(){

        $('.banner').slick({

          dots: true,

          infinite: false,

          speed: 300,

          autoplay: true,

          autoplaySpeed: 2000,

          slidesToShow: 1,

          slidesToScroll: 1

        });

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



            $('.turnament_alert_box_btn').on('click', function(){

                $.confirm({

                    icon: 'fa fa-question',

                    theme: 'white',

                    closeIcon: true,

                    animation: 'scale',

                    type: 'orange',

                });

            });

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

                  slidesToScroll: 1,
                  centerPadding: '0px',

                }

              }

              // You can unslick at a given breakpoint now by adding:

              // settings: "unslick"

              // instead of a settings object

            ]

          });

      });

    </script>