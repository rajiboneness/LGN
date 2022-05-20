@extends("website.layouts.master")

@section("content")



    <section class="banner__area game inner">

      <img src="{!!asset('letsgamenow/images/game_details.jpg')!!}" class="img-fluid">

      <h2 class="text-center">News Details</h2>

    </section>



    <section class="extradark_bg overflow_show pt-5 pb-5">

      <div class="container">

        <div class="row">

          <div class="col-sm-12 game_banner mb-5">

            <img  data-aos="zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000" src="{{URL::asset($news->image)}}" class="img-fluid">



            <div class="game__details_area mb-5">



              <div class="row align-items-center justify-content-between game__details">

                <div class="col-sm-6">

                  <h4>{{$news->title}}</h4>

                </div>

                <div class="col-sm-5">

                  <div class="row">

                    <div class="col border-right">

                      <h5>Author</h5>

                      <p>{{$news->uploaded_by}}</p>

                    </div>

                    <div class="col">

                      <h5>Date</h5>

                      <p>{{date("M, d.Y",strtotime($news->post_date))}}</p>

                    </div>

                  </div>

                </div>

              </div>              

            </div>

            <div class="clearfix"></div>

            <div class="news_details_content">

              <p>{{(strip_tags( nl2br( $news->content) ))}}</p>

            </div>

             <div class="clearfix"></div>

            <!-- AddToAny BEGIN -->

            <div class="news_details_content">

              <p></p>

              <div class="a2a_kit a2a_kit_size_32 a2a_default_style">

              <a class="a2a_dd" href="https://www.addtoany.com/share"></a>

              <a class="a2a_button_whatsapp"></a>

              <a class="a2a_button_facebook"></a>

              <a class="a2a_button_twitter"></a>

              <a class="a2a_button_pinterest"></a>

              <a class="a2a_button_linkedin"></a>

              <a class="a2a_button_google_gmail"></a>

              </div>

              <script async src="https://static.addtoany.com/menu/page.js"></script>

              <!-- AddToAny END -->

            </div>

          </div>

         

        </div>

        

      </div>

    </section>



@endsection