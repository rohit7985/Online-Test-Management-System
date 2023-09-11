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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


</head>

<body>

  <nav class="navbar navbar-light" style="background-color: black;">
    <a class="navbar-brand">REAL VISION</a>
        <div class="btn-group">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                {{ session('username') }}
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('admin.logout') }}"><span class="fa fa-sign-out mr-3"></span>Logout</a>

            </div>
        </div>
    </nav>

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </div>
            <h1><a href="{{ route('admin.dashboard') }}" class="logo">Admin Dashboard</a></h1>
            <ul class="list-unstyled components mb-5">
                <li class="active">
                    <a href="{{ route('admin.dashboard') }}"><span class="fa fa-home mr-3"></span> Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('admin.students') }}"><span class="fa fa-user mr-3"></span>Students</a>
                </li>
                <li>
                    <a href="{{ route('test') }}"><span class="fa fa-user mr-3"></span>Tests</a>
                </li>
                <li>
                    <a href="{{ route('admin.question') }}"><span class="fa fa-clipboard mr-3"></span>Questions</a>
                </li>
            </ul>

        </nav>
