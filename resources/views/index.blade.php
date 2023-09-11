@extends('layouts.main')
@section('main-content')

    <!-- ***** Main Banner Area Start ***** -->
    <section class="section main-banner" id="top" data-section="section1">
        <video autoplay muted loop id="bg-video">
            <source src="{{ url('assets1/images/course-video.mp4') }}" type="video/mp4" />
        </video>

        <div class="video-overlay header-text">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="caption">
                            <h6>Hello Students</h6>
                            <h2>Welcome to Education</h2>
                            <p>This is an edu meeting HTML CSS template provided by <a rel="nofollow"
                                    href="https://templatemo.com/page/1" target="_blank">TemplateMo website</a>. This is a
                                Bootstrap v5.1.3 layout. The video background is taken from Pexels website, a group of young
                                people by <a rel="nofollow" href="https://www.pexels.com/@pressmaster"
                                    target="_blank">Pressmaster</a>.</p>
                            <div class="main-button-red">
                                <div class="scroll-to-section"><a href="#contact">Join Us Now!</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Main Banner Area End ***** -->

    <section class="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-service-item owl-carousel">

                        <div class="item">
                            <div class="icon">
                                <img src="{{ url('assets1/images/service-icon-01.png') }}" alt="">
                            </div>
                            <div class="down-content">
                                <h4>Best Education</h4>
                                <p>Suspendisse tempor mauris a sem elementum bibendum. Praesent facilisis massa non
                                    vestibulum.</p>
                            </div>
                        </div>

                        <div class="item">
                            <div class="icon">
                                <img src="{{ url('assets1/images/service-icon-02.png') }}" alt="">
                            </div>
                            <div class="down-content">
                                <h4>Best Teachers</h4>
                                <p>Suspendisse tempor mauris a sem elementum bibendum. Praesent facilisis massa non
                                    vestibulum.</p>
                            </div>
                        </div>

                        <div class="item">
                            <div class="icon">
                                <img src="{{ url('assets1/images/service-icon-03.png') }}" alt="">
                            </div>
                            <div class="down-content">
                                <h4>Best Students</h4>
                                <p>Suspendisse tempor mauris a sem elementum bibendum. Praesent facilisis massa non
                                    vestibulum.</p>
                            </div>
                        </div>

                        <div class="item">
                            <div class="icon">
                                <img src="{{ url('assets1/images/service-icon-02.png') }}" alt="">
                            </div>
                            <div class="down-content">
                                <h4>Online Meeting</h4>
                                <p>Suspendisse tempor mauris a sem elementum bibendum. Praesent facilisis massa non
                                    vestibulum.</p>
                            </div>
                        </div>

                        <div class="item">
                            <div class="icon">
                                <img src="{{ url('assets1/images/service-icon-03.png') }}" alt="">
                            </div>
                            <div class="down-content">
                                <h4>Best Networking</h4>
                                <p>Suspendisse tempor mauris a sem elementum bibendum. Praesent facilisis massa non
                                    vestibulum.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="our-courses" id="courses"></section>

    <section class="our-courses" id="courses">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Popular Test Series</h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="owl-courses-item owl-carousel">
                        @if (!empty($tests))
                            @foreach ($tests as $test)
                                <div class="item">
                                    <img src="{{ url('images/'.$test['images']) }}" alt="Test One" id="showImg">
                                    <div class="down-content">
                                        <h4>{{$test['name']}}</h4>
                                        <div class="info">
                                            <div class="row">
                                                <div class="col-8">
                                                    <ul>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                    </ul>
                                                </div>
                                                <div class="col-4">
                                                    <span>{{$test['test_duration']}}Hr</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="contact-us" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 align-self-center">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="contact" action="" method="post">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h2>Let's get in touch</h2>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset>
                                            <input name="name" type="text" id="name" placeholder="YOURNAME...*"
                                                required="">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset>
                                            <input name="email" type="text" id="email" pattern="[^ @]*@[^ @]*"
                                                placeholder="YOUR EMAIL..." required="">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset>
                                            <input name="subject" type="text" id="subject" placeholder="SUBJECT...*"
                                                required="">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12">
                                        <fieldset>
                                            <textarea name="message" type="text" class="form-control" id="message" placeholder="YOUR MESSAGE..."
                                                required=""></textarea>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12">
                                        <fieldset>
                                            <button type="submit" id="form-submit" class="button">SEND MESSAGE
                                                NOW</button>
                                        </fieldset>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="right-info">
                        <ul>
                            <li>
                                <h6>Phone Number</h6>
                                <span>010-020-0340</span>
                            </li>
                            <li>
                                <h6>Email Address</h6>
                                <span>info@meeting.edu</span>
                            </li>
                            <li>
                                <h6>Street Address</h6>
                                <span>Rio de Janeiro - RJ, 22795-008, Brazil</span>
                            </li>
                            <li>
                                <h6>Website URL</h6>
                                <span>www.meeting.edu</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endsection
