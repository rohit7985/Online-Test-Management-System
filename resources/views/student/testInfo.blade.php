@extends('layouts.main')
@section('title', 'Dashboard')
@section('main-content')

<section class="heading-page header-text" id="top">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h6>Here are our upcoming meetings</h6>
        <h2>Upcoming Meetings</h2>
      </div>
    </div>
  </div>
</section>

<section class="contact-us" id="contact">
  <div class="container">
      <div class="row">
          <div class="col-lg-12 align-self-center">
              <div class="row">
                @if(session('error'))
                  <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                  <div class="col-lg-12">
                      <form id="contact" action={{route('attempt.test')}} method="post">
                        @csrf
                        <input type="hidden" name="testId" value={{$testId}}>
                          <div class="row">
                              <div class="col-lg-12">
                                  <h2>Test instruction rules</h2>
                              </div>
                              <div class="col-lg-12 testInfo">
                                  <h5>Login and Authentication:</h5>
                                  <ul>
                                    <li>Please log in using your registered credentials before starting the test.</li>
                                    <li>Ensure you are using the correct login details provided to you.</li>
                                  </ul> 
                              </div>
                              <div class="col-lg-12 testInfo">
                                  <h5>Test Duration:</h5>
                                  <ul>
                                    <li>You will have a total of 60 minutes to complete this test.</li>
                                    <li>Please keep an eye on the timer displayed on the screen.</li>
                                  </ul> 
                              </div>
                              <div class="col-lg-12 testInfo">
                                  <h5>Question Navigation:</h5>
                                  <ul>
                                    {{-- <li>You can navigate between questions using the 'Next' and 'Previous' buttons.</li> --}}
                                    <li>Make sure to review your answers before submitting.</li>
                                  </ul> 
                              </div>
                              <div class="col-lg-12 testInfo">
                                  <h5>Answer Submission:</h5>
                                  <ul>
                                    <li>You must submit your answers before the time limit expires.</li>
                                    {{-- <li>Incomplete tests will not be considered for evaluation.</li> --}}
                                  </ul> 
                              </div>
                              <div class="col-lg-12 testInfo">
                                  <h5>Single Answer Selection:</h5>
                                  <ul>
                                    <li>For multiple-choice questions, select the best answer by clicking on the corresponding option.</li>
                                    <li>Only one answer is correct for each multiple-choice question.</li>
                                  </ul> 
                              </div>
                             
                              <div class="col-lg-12">
                                  <fieldset>
                                      <button type="submit" id="form-submit" class="button">Start</button>
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
