@extends('layouts.main')
@section('title', 'Registration')
@section('main-content')
<section class="contact-us" id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 align-self-center">
          <div class="row">
            <div class="col-lg-12">
              <form id="contact" action="{{ route('registration.store') }}" method="post">
                @csrf
                <div class="row">
                  <div class="col-lg-12">
                    <h2>Registration</h2>
                  </div>
                  @if(session('success'))
                      <div class="alert alert-success">
                          {{ session('success') }}
                      </div>
                  @endif
                  <div class="col-lg-12">
                    @error('name')
                            <div class="error-message text-danger">{{ $message }}</div>
                    @enderror
                    <fieldset>
                      <input name="name" type="text" id="name" placeholder="YOUR NAME...*" required="" autocomplete="off">
                    </fieldset>
                  </div>
                  <div class="col-lg-12">
                    @error('email')
                            <div class="error-message text-danger">{{ $message }}</div>
                    @enderror
                    <fieldset>
                      <input name="email" type="text" id="email" pattern="[^ @]*@[^ @]*" placeholder="YOUR EMAIL..." required="" autocomplete="off">
                    </fieldset>
                  </div>
                  <div class="col-lg-12">
                    @error('mobile_number')
                            <div class="error-message text-danger">{{ $message }}</div>
                    @enderror
                    <fieldset>
                      <input name="mobile_number" type="text" id="mobile_number" placeholder="YOUR MOBILE...*" required="" autocomplete="off">
                    </fieldset>
                  </div>
                  <div class="col-lg-12">
                    @error('password')
                            <div class="error-message text-danger">{{ $message }}</div>
                    @enderror
                    <fieldset>
                      <input name="password" type="password" id="password" placeholder="Password...*" required="">
                    </fieldset>
                  </div>
                  <div class="col-lg-12">
                    @error('conf_password')
                            <div class="error-message text-danger">{{ $message }}</div>
                    @enderror
                    <fieldset>
                      <input name="conf_password" type="password" id="conf_password" placeholder="Confirm Password...*" required="">
                    </fieldset>
                  </div>
                  <div class="col-lg-12">
                    <fieldset>
                      <button type="submit" id="form-submit" class="button">Register</button>
                    </fieldset>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
