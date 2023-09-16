@extends('layouts.main')
@section('title', 'Dashboard')
@section('main-content')
<section class="heading-page header-text" id="top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h2>Test Instruction</h2>
        </div>
      </div>
    </div>
  </section>

      <div class="jumbotron">
        <p class="lead text-center">Read all the Instructions carefully before attempting the Test.</p>
        <hr class="my-4">
        <h6>Login and Authentication:</h6>
  
          <p> "Please log in using your registered credentials before starting the test."</p> 
          <p>"Ensure you are using the correct login details provided to you."</p>              
        <p class="lead">
        <a class="btn btn-primary btn-lg" href="#" role="button">Start</a>
        </p>
      </div>
@endsection
