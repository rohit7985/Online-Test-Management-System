<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <title>@yield('title', 'Online Test Management System')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ url('vendor1/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ url('assets1/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ url('assets1/css/templatemo-edu-meeting.css') }}">
    <link rel="stylesheet" href="{{ url('assets1/css/owl.css') }}">
    <link rel="stylesheet" href="{{ url('assets1/css/lightbox.css') }}">
    <link rel="stylesheet" href="{{ url('assets1/css/main.css') }}">

</head>

<body>

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="{{ route('home') }}" class="logo">
                            {{trans('home.real.vision')}}
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="{{ route('home') }}">{{trans('home.home')}}</a></li>
                            <li><a href="{{ route('aboutUs') }}">{{trans('home.aboutUs')}}</a></li>
                            <li></li>
                            @if(Session::has('currentUserData'))
                            <li><a href="{{ route('student.dashboard') }}">{{trans('home.dashboard')}}</a></li>
                                <li>
                                    <div class="dropdown">
                                        <button class="small-button">{{Session::get('currentUserData')['name']}}</button>
                                        <div class="dropdown-content">
                                            <a href="{{ route('student.profile') }}">{{trans('home.profile')}}</a>
                                            <a href="{{ route('logout') }}">{{trans('home.logout')}}</a>
                                        </div>
                                    </div>
                                </li>
                            @else
                                <div class="main-button-red">
                                    <a href="{{ route('login') }}">{{trans('home.login')}}</a>
                                </div> 
                                <li class="or">{{trans('home.or')}}</li>
                                <div class="main-button-red">
                                    <a href="{{ route('google.login') }}"><i class="fa fa-google google" aria-hidden="true"></i>{{trans('home.login')}}</a>
                                </div> 
                            @endif
                        </ul>
                        <a class='menu-trigger'>
                            <span>{{trans('home.menu')}}</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->
