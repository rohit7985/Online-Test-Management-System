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

  <nav class="navbar navbar-light" style="background-color: black;">
    <a class="navbar-brand">{{trans('home.real.vision')}}</a>
        <div class="btn-group">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                {{ session('username') }}
            </button>
            <div class="dropdown-menu dropdown-menu-right">
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
            <h1><a href="{{ route('admin.dashboard') }}" class="logo">{{trans('admin.admin.dashboard')}}</a></h1>
            <ul class="list-unstyled components mb-5">
                <li class="active">
                    <a href="{{ route('admin.dashboard') }}"><span class="fa fa-home mr-3"></span> {{trans('home.dashboard')}}</a>
                </li>
                <li>
                    <a href="{{ route('admin.students') }}"><span class="fa fa-user mr-3"></span>{{trans('admin.students')}}</a>
                </li>
                <li>
                    <a type="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <span class="fa fa-user mr-3"></span> {{trans('admin.tests')}} <span class="fa fa-chevron-down" style="padding-left: 94px"></span>
                    </a>
                    <div class="collapse" id="collapseExample">
                        <a href="{{ route('test') }}"><span class="fa fa-user mr-3"></span>{{trans('admin.view.all.test')}}</a>
                        <a href="{{ route('test-result') }}"><span class="fa fa-clipboard mr-3"></span>{{trans('home.test.result')}}</a>
                    </div>
                </li>
                <li>
                    <a href="{{ route('admin.question') }}"><span class="fa fa-clipboard mr-3"></span>{{trans('home.questions')}}</a>
                </li>                
                <li>
                    <a href="{{ route('admin.contact') }}"><span class="fa fa-clipboard mr-3"></span>{{trans('home.contact')}}</a>
                </li>                
            </ul>
        </nav>
