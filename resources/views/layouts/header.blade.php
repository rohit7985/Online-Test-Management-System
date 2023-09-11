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
                            Real Vision
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('aboutUs') }}">About Us</a></li>
                            <li></li>
                            <li></li>
                            @auth
                                <div class="main-button-red">
                                    <a href="{{ route('logout') }}">Logout</a>
                                </div>
                            @endauth

                            @if(request()->is('user/access*') ||(request()->is('student-dashboard*') ))
                            
                            @else
                            <div class="main-button-red">
                                <a href="{{ route('login') }}">Login</a>
                            </div>   
                            @endif
                        
                        
                            




                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->
