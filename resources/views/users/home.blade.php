@extends('users.layout.layout')

@section('content')
<!-- Find Job Section Start -->

<section class="find-job section">
  <div class="container">
    <h2 class="section-title">Công việc mới nhất</h2>
    @foreach ($jobSummary as $value)
    <div class="row">
      <div class="col-md-12">
        <div class="job-list">
          <div class="thumb">
            <a href="job-details.html">
              <img src="{{ $value->company->logo }}" alt="" class="image-100-100">
            </a>
          </div>
          <div class="job-list-content">
            <h4>
              <a href="job-detail/{{ $value->job_detail_id }}">{{ $value->title }}</a>
            </h4>
            <p>{{ $value->description }}
            </p>
            <div class="job-tag">
              <div class="pull-left">
                <div class="meta-tag">
                  <span>
                    <a href="{{ $value->company->link }}" target="_blank">
                      <i class="ti-briefcase"></i>{{ $value->company->name }}</a>
                    </span>
                    <span>
                      <i class="ti-location-pin"></i>{{ $value->address->name }}</span>
                      <span>
                        <i class="ti-user"></i>{{ $value->user->name }}</span>
                      </div>
                    </div>
                    <div class="pull-right">
                      <div class="icon" id="{{ $value->id }}" 
                        @if (Auth::check())
                        @foreach (Auth::user()->jobFavorite as $favorite)
                        @if ($favorite->id == $value->id)
                        style="background-color:red;color:white" 
                        @endif
                        @endforeach
                        @endif
                        >
                        <i class="ti-heart"></i>
                      </div>
                      <a href="job-detail/{{ $value->id }}" class="btn btn-common btn-rm">Xem chi tiết</a>
                    </div>
                  </div>
                </div>
              </div>

              @endforeach

            </div>

          </div>
        </div>
      </section>
      <!-- Find Job Section End -->
      <!-- Testimonial Section Start -->
      <section id="testimonial" class="section">
        <div class="container">
          <div class="row">
            <div class="touch-slider" class="owl-carousel owl-theme">

              <div class="item active text-center">
                <img class="img-member" src="user_assets/img/clients/Hieu.jpg" alt="">
                <div class="client-info">
                  <h2 class="client-name">Tran Bao Hieu<br>
                    <span>(Hieu dep trai)</span>
                  </h2>
                </div>
                <p>
                  <i class="fa fa-quote-left quote-left"></i> Nguoi mang muoi den cho the gioi!!!
                  <i class="fa fa-quote-right quote-right"></i>
                </p>              
              </div>
              <div class="item text-center">
                <img class="img-member" src="user_assets/img/clients/Tho.jpg" alt="">
                <div class="client-info">
                  <h2 class="client-name">Nguyễn Dinh Tho <br>
                    <span>(Nha Tho)</span>
                  </h2>
                </div>
                <p>
                  <i class="fa fa-quote-left quote-left"></i> Nha Tho muon the nao? 
                  <i class="fa fa-quote-right quote-right"></i>
                </p>
              </div>
              <div class="item text-center">
                <img class="img-member" src="user_assets/img/clients/Long.jpg" alt="">
                <div class="client-info">
                  <h2 class="client-name">Nguyen Thanh Long <br>
                    <span>(Long No Hope)</span>
                  </h2>
                </div>
                <p>
                  <i class="fa fa-quote-left quote-left"></i> Hay di muon mon tieng Nhat
                  <i class="fa fa-quote-right quote-right"></i>
                </p>
              </div>

            </div>

          </div>
        </div>
      </div>
    </section>
    <!-- Testimonial Section End -->

    <!-- Clients Section -->
    <section class="clients section">
      <div class="container">
        <h2 class="section-title">
          Đối tác liên kết
        </h2>
        <div class="row">
          <div id="clients-scroller">
            <div class="items">
              <img src="user_assets/img/clients/img1.png" alt="">
            </div>
            <div class="items">
              <img src="user_assets/img/clients/img2.png" alt="">
            </div>
            <div class="items">
              <img src="user_assets/img/clients/img3.png" alt="">
            </div>
            <div class="items">
              <img src="user_assets/img/clients/img4.png" alt="">
            </div>
            <div class="items">
              <img src="user_assets/img/clients/img5.png" alt="">
            </div>
            <div class="items">
              <img src="user_assets/img/clients/img6.png" alt="">
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Client Section End -->

    <!-- Counter Section Start -->
    <section id="counter">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-xs-12">
            <div class="counting">
              <div class="icon">
                <i class="ti-briefcase"></i>
              </div>
              <div class="desc">
                <h2>Công việc</h2>
                <h1 class="counter">{{ $cJob }}</h1>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-xs-12">
            <div class="counting">
              <div class="icon">
                <i class="ti-user"></i>
              </div>
              <div class="desc">
                <h2>Thành viên</h2>
                <h1 class="counter" id="member">{{ $cmember }}</h1>
              </div>
            </div>
          </div>

          <div class="col-md-4 col-xs-12">
            <div class="counting">
              <div class="icon">
                <i class="ti-heart"></i>
              </div>
              <div class="desc">
                <h2>Công ty</h2>
                <h1 class="counter">{{ $ccompany }}</h1>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Counter Section End -->
    <script type="text/javascript" src="user_assets/js/jquery-min.js"></script>
    <script>
      $(document).ready(function() {
        $('.icon').click(function(event) {
          /* Act on the event */
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $.ajax({
            'url': '/favorite',
            'type': 'post',
            'data': {'idJob': $(this).attr('id')},
            success:function(data){
              if(data.error==true){
                window.location="/login";
              }
              else{
                if(data.message == true){
                 $('#'+data.idJob).css({'background-color':'red','color':'white'});
               }
               else{
                $('#'+data.idJob).css({'background-color':'#f1f1f1','color':'#FF4F57'});
              }
            }
          }
        })
        });  
      });
    </script>
    @endsection

