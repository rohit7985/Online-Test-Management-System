@extends('layouts.main')
@section('title', 'Attempt Test Pannel')
@section('main-content')

<section class="heading-page header-text" id="top">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h6>{{trans('home.current.test')}}</h6>
        <h2>{{trans('home.attempt.test')}}</h2>
      </div>
    </div>
  </div>
</section>
  <div class="container">
      <div class="row">
          <div class="col-lg-12 align-self-center">
              <div class="row">
                  <div class="col-lg-12">
                      <form id="submitForm" action={{route('submit.test')}} method="post">
                        @csrf
                          <div class="row questions">
                              <div class="col-lg-9">
                                <input type="hidden" name="testId" value={{ $testId }}>
                                <input type="hidden" name="questions" value={{ $questions }}>
                                @foreach($questions as $question)
                                <h5>{{ $question->question }}</h5>
                                <fieldset>
                                    <input type="radio" name="responses[{{ $question->id }}]" value="{{ $question->option1 }}"> {{ $question->option1 }}
                                </fieldset><br>
                                    <fieldset>
                                        <input type="radio" name="responses[{{ $question->id }}]" value="{{ $question->option2 }}"> {{ $question->option2 }}
                                    </fieldset><br>
                                    <fieldset>
                                        <input type="radio" name="responses[{{ $question->id }}]" value="{{ $question->option3 }}"> {{ $question->option3 }}
                                    </fieldset><br>
                                    <fieldset>
                                        <input type="radio" name="responses[{{ $question->id }}]" value="{{ $question->option4 }}"> {{ $question->option4 }}
                                    </fieldset><br>
                                @endforeach
                                  <fieldset>
                                      <button type="submit" id="form-submit" class="small-button">{{trans('home.submit')}}</button>
                                  </fieldset>
                              </div>
                              <div class="col-lg-3">
                                <div class="right-info">
                                    <div id="countdownArea" class="text-center">
                                        <div class="clock">
                                            <img src={{url('student/clock.gif')}} class="clock" alt="timer">
                                        </div>
                                        <span id="timer">{{ $test_duration }}</span>
                                    </div>
                                </div>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <script>
    var testDuration = "{{ $test_duration }}";
    var parts = testDuration.split(":");
    var minutes = parseInt(parts[0], 10);
    var seconds = parseInt(parts[1], 10);

    function updateTimer() {
        var timerElement = document.getElementById('timer');
        timerElement.innerHTML = (minutes < 10 ? '0' : '') + minutes + ":" + (seconds < 10 ? '0' : '') + seconds;

        if (minutes == 0 && seconds == 0) {
            // Time's up! You can add additional logic here if needed.
            document.getElementById('submitForm').submit(); // Automatically submit when time is up
        } else {
            if (seconds > 0) {
                seconds--;
            } else {
                minutes--;
                seconds = 59;
            }
            setTimeout(updateTimer, 1000);
        }
    }

    updateTimer();
</script>
@endsection



