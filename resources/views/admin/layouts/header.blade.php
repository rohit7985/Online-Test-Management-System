<!doctype html>
<html lang="en">

<head>
    <title>@yield('title', 'Admin Dashboard')</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ url('admin/css/style.css') }}">

    <link rel="stylesheet" href="{{ url('assets1/css/main.css') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



</head>

<body>

  <nav class="navbar navbar-light">   
            <a href="#" class="navbar-brand"><h2 class="tittle">{{trans('home.real.vision')}}</h2></a>
        {{-- <div class="btn-group">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                {{ session('username') }}
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('admin.logout') }}"><span class="fa fa-sign-out mr-3"></span>{{trans('home.logout')}}</a>

            </div>
        </div> --}}

        <div class="dropdown">
            <button class="small-button">{{ session('username') }}</button>
            <div class="dropdown-content">
                <a href="{{ route('admin.logout') }}"><span class="fa fa-sign-out mr-3"></span>{{trans('home.logout')}}</a>
            </div>
        </div>
    </nav>

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">{{trans('admin.toggle.menu')}}</span>
                </button>
            </div>
            <div class="thumb">
                <a href="{{ route('admin.dashboard') }}" class="logo">
                    <img class="profile_img" src={{url('student/user.png')}} alt="check">
                </a>
                <h5> {{ session('username') }}</h5>
            </div>
            <ul class="list-unstyled components mb-5">
                <li class="{{ request()->is('admin-dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}"><span class="fa fa-home mr-3"></span> {{trans('home.dashboard')}}</a>
                </li>
                <li class="{{ request()->is('admin/students') ? 'active' : '' }}">
                    <a href="{{ route('admin.students') }}"><span class="fa fa-user mr-3"></span>{{trans('admin.students')}}</a>
                </li>
                <li class="{{ request()->is(['admin/test', 'admin/test-result']) ? 'active' : '' }}">
                    <a type="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <span class="fa fa-user mr-3"></span> {{trans('admin.tests')}} <span class="fa fa-chevron-down" style="padding-left: 94px"></span>
                    </a>
                    <div class="collapse" id="collapseExample">
                        <a href="{{ route('test') }}"><span class="fa fa-user mr-3"></span>{{trans('admin.view.all.test')}}</a>
                        <a href="{{ route('test-result') }}"><span class="fa fa-clipboard mr-3"></span>{{trans('home.test.result')}}</a>
                    </div>
                </li>
                <li class="{{ request()->is('admin/question') ? 'active' : '' }}">
                    <a href="{{ route('admin.question') }}"><span class="fa fa-clipboard mr-3"></span>{{trans('home.questions')}}</a>
                </li>                
                <li class="{{ request()->is('admin/contact') ? 'active' : '' }}">
                    <a href="{{ route('admin.contact') }}"><span class="fa fa-clipboard mr-3"></span>{{trans('home.contact')}}</a>
                </li>                
            </ul>
        </nav>

  

