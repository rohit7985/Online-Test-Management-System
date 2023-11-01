@extends('layouts.main')
@section('title', 'Login Pannel')
@section('main-content')
  <section class="heading-page header-text" id="top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h6>{{trans('home.welcome')}}</h6>
          <h2>{{trans('home.student.login.pannel')}}</h2>
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
                        <h2>{{trans('home.login')}}</h2>
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
                          <button type="submit" id="form-submit" class="button">{{trans('home.submit')}}</button>
                        </fieldset>
                      </div>
                      <i class="fa fa-lock">{{trans('home.forgot.password')}}</i>
                    </div>
                  </form>
              </div>
              <div class="col-lg-8">
                
              </div>
              <p style="color: aliceblue">{{trans('home.dont.have.an.account')}}<a href="{{route('registration')}}">  {{trans('home.register')}}</a></p>
            </div>
          </div>
        </div>
      </div>  
@endsection