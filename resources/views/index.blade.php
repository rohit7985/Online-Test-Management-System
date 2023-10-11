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
                            <h6>{{trans('home.hello.student')}}</h6>
                            <h2>{{trans('home.welcome.real.vision')}}</h2>
                            <p>{{trans('home.welcome.message1')}}</p>
                            <div class="main-button-red">
                                <div class="scroll-to-section"><a href="#contact">{{trans('home.joinUsNow')}}</a></div>
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
                        <h2>{{trans('home.popularTests')}}</h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="owl-courses-item owl-carousel">
                        @if (!empty($tests))
                            @foreach ($tests as $test)
                                <div class="item">
                                    @if(Session::has('currentUserData'))
                                        <a href="{{route('test.instruction',  ['testID' => $test['id']])}}"><img src="{{ url('images/'.$test['images']) }}" alt="" id="showImg"></a>
                                    @else
                                        <a href="{{url('/login')}}"><img src="{{ url('images/'.$test['images']) }}" alt="" id="showImg"></a>
                                    @endif
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
                                                    <span>{{$test['test_duration']}}{{trans('home.hr')}}</span>
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
                            <form id="contact" action="{{ route('contact.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h2>{{trans('home.getInTouch')}}</h2>
                                    </div>
                                    <div class="col-lg-12">
                                        @if(session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                        @if($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset>
                                            <input name="name" type="text" id="name" placeholder="YOURNAME...*"
                                                required="" autocomplete="off">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset>
                                            <input name="email" type="text" id="email" pattern="[^ @]*@[^ @]*"
                                                placeholder="YOUR EMAIL..." required="" autocomplete="off">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset>
                                            <input name="subject" type="text" id="subject" placeholder="SUBJECT...*"
                                                required="" autocomplete="off">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12">
                                        <fieldset>
                                            <textarea name="message" type="text" class="form-control" id="message" placeholder="YOUR MESSAGE..."
                                                required="" autocomplete="off"></textarea>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12">
                                        <fieldset>
                                            <button type="submit" id="form-submit" class="button">{{trans('home.send.message')}}</button>
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
                                <h6>{{trans('home.phone.number')}}</h6>
                                <span>010-020-0340</span>
                            </li>
                            <li>
                                <h6>{{trans('home.email.address')}}</h6>
                                <span>info@realvison.edu</span>
                            </li>
                            <li>
                                <h6>{{trans('home.street.address')}}</h6>
                                <span>Rio de Janeiro - RJ, 22795-008, India</span>
                            </li>
                            <li>
                                <h6>{{trans('home.websiteUrl')}}</h6>
                                <span>www.realvision.edu</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endsection
