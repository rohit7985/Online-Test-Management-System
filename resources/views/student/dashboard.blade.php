@extends('layouts.main')
@section('title', 'Dashboard')
@section('main-content')


  <section class="heading-page header-text" id="top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h6>Welcome to the</h6>
          <h2>Student Dashboard</h2>
        </div>
      </div>
    </div>
  </section>

  <section class="meetings-page" id="meetings">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-12">
              <div class="filters">
                {{-- <ul>
                  <li data-filter="*"  class="active">All Tests</li>
                  <li data-filter=".soon">Soon</li>
                  <li data-filter=".imp">Important</li>
                  <li data-filter=".att">Attractive</li>
                </ul> --}}
              </div>
                  @if(session('success'))
                      <div class="alert alert-success">{{ session('success') }}</div>
                  @endif
                  @if(session('error'))
                      <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
            </div>
            <div class="col-lg-12">
              <div class="row grid">
                @if (!empty($tests))
                  @foreach ($tests as $test)
                <div class="col-lg-4 templatemo-item-col all soon">
                  <div class="meeting-item">
                    <div class="thumb">
                      <div class="price">
                        <span>Free</span>
                      </div>
                      <a href="{{route('test.instruction',  ['testID' => $test['id']])}}"><img src="{{ url('images/'.$test['images']) }}" alt="" id="showImg"></a>
                    </div>
                    <div class="down-content">
                      <div class="date">
                        <h6>Nov <span>12</span></h6>
                      </div>
                      <a href="#"><h4>{{$test['name']}}</h4></a>
                      <p>Morbi in libero blandit lectus<br>cursus ullamcorper.</p>
                    </div>
                  </div>
                </div>
                @endforeach
                @endif
              </div>
            </div>
            <div class="col-lg-12">
              {{-- <div class="pagination">
                <ul>
                  <li><a href="#">1</a></li>
                  <li class="active"><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                </ul>
              </div> --}}
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
