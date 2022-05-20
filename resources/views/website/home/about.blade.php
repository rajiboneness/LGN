@extends("website.layouts.master")
@section("content")
<section class="banner__area inner">
   <img src="{!!asset('letsgamenow/images/leaderboard-ban.jpg')!!}" class="img-fluid">
   <h2 class="text-center">About Us</h2>
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
           <div class="section__title" data-aos="fade-right" data-aos-easing="ease-in-back" data-aos-duration="1000">About us</div>
         <div class="col-sm-12 about__area mt-3">
            <p>We are a group of regular gamers who decided to conduct online tournaments for other gamers like us. We started our journey in 2013 with AFGC. AFGC is Asia’s longest-running E-sports football tournament operating in 16 countries. We also hosted Virtual Bundesliga Indian Edition In 2019. In 2019, we started Lets Game Now as we wanted to add more games and gamers with us in our journey. Lets Game Now organizes offline and online tournaments on a regular basis for multiple popular online games. Currently, we are hosting PUBG Mobile, Call of Duty Mobile, Dota 2, Free Fire, FIFA tournaments, and many more. We host free and paid regular online tournaments for PUBG Mobile (solo and squad), Call of Duty Mobile (Squad), and Dota 2 (solo mid and team). Lets Game Now also hosts Major Monthly Tournaments at the end of the month. Our goal is to create an e-sports platform for all of the South-Asia and South-East Asia so we can make it available to all gamers, and prepare them to achieve international glory. Play with us, win tournaments, win exciting prizes, and earn a chance to play in international tournaments. </p>
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

