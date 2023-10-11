@extends('layouts.main')
@section('title', 'Student Profile')
@section('main-content')
  <section class="heading-page header-text" id="top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          {{-- <img src={{url('student/user.png')}} class="user-profile" alt="profile_image"> --}}
          <h2>User Profile</h2>
        </div>
      </div>
    </div>
  </section>

  <section class="meetings-page" id="meetings">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-12">
              <div class="meeting-single-item">
                <div class="thumb">
                  <img src={{url('student/user.png')}} alt="check">
                </div>
                <div class="down-content">
                  @if(session('success'))
                      <div class="alert alert-success">
                          {{ session('success') }}
                      </div>
                  @elseif(session('error'))
                      <div class="alert alert-danger">
                          {{ session('error') }}
                      </div>
                  @endif
                  <div class="">
                    <a href="#"><h4 class="text-success">{{$user->name}}</h4></a>
                    <a href="#" class=" change-pass " data-toggle="modal" data-target="#changePasswordModal">Change Password</a>

                    {{-- <a href="#" class="change-pass" data-toggle="modal" data-target="#changePassword">Change Password</a> --}}
                  </div>
                  <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="{{ route('change.password') }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="old_password">Old Password:</label>
                                        <input type="password" name="old_password" id="old_password" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="new_password">New Password:</label>
                                        <input type="password" name="new_password" id="new_password" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm_password">Confirm New Password:</label>
                                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                  <h6>Email: {{$user->email}}</h6>
                  <h6>Contact: +91 {{$user->mobile_number}}</h6>
                  
                  <p class="description">
                    {{-- This is an edu meeting HTML CSS template provided by <a href="https://templatemo.com/" target="_blank" rel="nofollow">TemplateMo website</a>. This is a Bootstrap v5.1.3 layout. If you need more free website templates like this one, please visit our website TemplateMo. Please tell your friends about our website. Thank you. If you want to get the latest collection of HTML CSS templates for your websites, you may visit <a rel="nofollow" href="https://www.toocss.com/" target="_blank">Too CSS website</a>. If you need a working contact form script, please visit <a href="https://templatemo.com/contact" target="_parent">our contact page</a> for more info. --}}
                    
                    {{-- <br><br>You are allowed to use this edu meeting CSS template for your school or university or business. You can feel free to modify or edit this layout. You are not allowed to redistribute the template ZIP file on any other template website. Please contact us for more information. --}}
                  </p>
                  <div class="row">
                    <h4>Test Details:</h4><br>
                    <div class="col-lg-4">
                      <div class="hours text-center">
                        <h5>Test Name</h5>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="location text-center">
                        <h5>Duration</h5>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="book now text-center">
                        <h5>Score</h5>
                      </div>
                    </div>
                    @foreach($testData as $data)
                      <div class="col-lg-4">
                        <div class="hours text-center">
                          <p>{{$data['test_name']}}</p>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="location text-center">
                          <p>60 min</p>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="book now text-center">
                          <p>{{$data['score']}}</p>
                        </div>
                      </div>
                    @endforeach
                    {{-- <div class="col-lg-12">
                      <div class="share">
                        <h5>Share:</h5>
                        <ul>
                          <li><a href="#">Facebook</a>,</li>
                          <li><a href="#">Twitter</a>,</li>
                          <li><a href="#">Linkedin</a>,</li>
                          <li><a href="#">Behance</a></li>
                        </ul>
                      </div>
                    </div> --}}


                  </div>
                </div>
              </div>
            </div>
            {{-- <div class="col-lg-12">
              <div class="main-button-red">
                <a href="meetings.html">Back To Meetings List</a>
              </div>
            </div> --}}
          </div>
        </div>
      </div>
    </div>

    <script>
      $(document).ready(function(){
          $('.change-password-btn').click(function(){
              $('#changePasswordModal').modal('show');
          });
      });
      </script>

    <script>
        //according to loftblog tut
        $('.nav li:first').addClass('active');

        var showSection = function showSection(section, isAnimate) {
          var
          direction = section.replace(/#/, ''),
          reqSection = $('.section').filter('[data-section="' + direction + '"]'),
          reqSectionPos = reqSection.offset().top - 0;

          if (isAnimate) {
            $('body, html').animate({
              scrollTop: reqSectionPos },
            800);
          } else {
            $('body, html').scrollTop(reqSectionPos);
          }

        };

        var checkSection = function checkSection() {
          $('.section').each(function () {
            var
            $this = $(this),
            topEdge = $this.offset().top - 80,
            bottomEdge = topEdge + $this.height(),
            wScroll = $(window).scrollTop();
            if (topEdge < wScroll && bottomEdge > wScroll) {
              var
              currentId = $this.data('section'),
              reqLink = $('a').filter('[href*=\\#' + currentId + ']');
              reqLink.closest('li').addClass('active').
              siblings().removeClass('active');
            }
          });
        };

        $('.main-menu, .responsive-menu, .scroll-to-section').on('click', 'a', function (e) {
          e.preventDefault();
          showSection($(this).attr('href'), true);
        });

        $(window).scroll(function () {
          checkSection();
        });
    </script>
@endsection
