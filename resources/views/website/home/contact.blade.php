<!doctype html>
<html lang="en">
  <head>
     {{--include styles--}}
  @include("website.layouts.header")
  </head>
  <body>
  {{--include Header--}}
   @include("website.layouts.sub-header")


    <section class="banner__area inner">
      <img src="{!!asset('letsgamenow/images/leaderboard-ban.jpg')!!}" class="img-fluid">

      <h2 class="text-center">Contact Us</h2>

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
        <div class="title__area mb-5 text-center">
          <div class="section__title" data-aos="zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">Get In Touch</div>
          <div class="section__subtitle">Find Us!</div>
        </div>

        <div class="clearfix"></div>
        <div class="row">
          <div class="col-sm-6 about__area" data-aos="fade-right" data-aos-easing="ease-in-back" data-aos-duration="1500">
            <ul class="address__list">
              <li>
                <span><i class="fas fa-map-marker-alt"></i></span>
                <p>5001 BEACH ROAD #08-11 GOLDEN MILE COMPLEX Singapore 199588</p>
              </li>
              <li>
                <span><i class="far fa-envelope"></i></span>
                <p>info@letsgamenow.com</p>
              </li>
            </ul>
            <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3988.786966921965!2d103.86290226455561!3d1.302789299049799!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1s5001%20BEACH%20ROAD%20%2308-11%20GOLDEN%20MILE%20COMPLEX%20Singapore%20199588!5e0!3m2!1sen!2sin!4v1578383459546!5m2!1sen!2sin" width="100%" height="350" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
          </div>
          <div class="col-sm-6" data-aos="fade-left" data-aos-easing="ease-in-back" data-aos-duration="1500">
            <form class="contact__form">
              <div class="form-group">
                <input type="text" name="name" value="" placeholder="Your Name" required="">
                <button type="button" class=""><span class="fas fa-user"></span></button>
              </div>

              <div class="form-group">
                <input type="email" name="email" value="" placeholder="Email address" required="">
                <button type="button" class=""><span class="fas fa-envelope"></span></button>
              </div>

              <div class="form-group">
                <input type="tel" name="phone" value="" placeholder="Contact No." required="">
                <button type="button" class=""><span class="fas fa-phone-alt"></span></button>
              </div>

              <div class="form-group">
                <textarea name="message" placeholder="Message" required=""></textarea>
                <button type="button" class=""><span class="fas fa-comment-alt"></span></button>
              </div>

              <div class="form-group">
                <button type="submit" class="">Submit Now</button>
              </div>
            </form>
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

 {{--include styles--}}
   @include("website.layouts.footer")
   @include("website.layouts.scripts")


  </body>
</html>