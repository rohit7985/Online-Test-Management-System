@extends('layouts.main')
@section('title', 'Login')
@section('main-content')
  <section class="heading-page header-text" id="top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h6>Get all details</h6>
          <h2>Online Teaching and Learning Tools</h2>
        </div>
      </div>
    </div>
  </section>
  <section class="contact-us" id="login">
      <div class="container">
        <div class="row">
          <div class="align-self-center">
            <div class="row">
              <div class="col-lg-4">
                <form id="contact" action="{{ route('form.login') }}" method="POST">
                  @csrf
                    <div class="row">
                        <h2>Login</h2>
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                          @error('email')
                            <div class="error-message text-danger">{{ $message }}</div>
                          @enderror
                        <fieldset>
                          <input name="email" type="text" id="email" pattern="[^ @]*@[^ @]*" placeholder="YOUR EMAIL..."  autocomplete="off">
                        </fieldset>
                       
                        @error('password')
                        <div class="error-message text-danger">{{ $message }}</div>
                    @enderror
                        <fieldset>
                          <input name="password" type="password" id="password" placeholder="Your Password....*" >
                        </fieldset>
                        
                     
                      <div class="col-lg-12">
                        <fieldset>
                          <button type="submit" id="form-submit" class="button">Submit</button>
                        </fieldset>
                      </div>
                      <i class="fa fa-lock">Forgot password </i>
                    </div>
                  </form>
              </div>
              <p style="color: aliceblue">Don't have an account?<a href="{{route('registration')}}">  Register</a></p>
            </div>
          </div>
        </div>
      </div>  
@endsection