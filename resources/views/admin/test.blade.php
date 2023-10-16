@extends('admin.layouts.main')
@section('title', 'Test')
@section('main-content')
 <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5">
        <h2 class="mb-4 text-center">{{trans('admin.add.test')}}</h2>
             <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTestModel">
          {{trans('admin.add.test')}}
        </button>
        @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<!-- Rest of your view file content -->

        <table class="table table-data">
          <thead class="thead-dark">
            
            <tr>
              
              <th scope="col">{{trans('admin.s.n')}}</th>
              <th scope="col">{{trans('admin.name')}}</th>
              <th scope="col">{{trans('admin.image')}}</th>
              <th scope="col">{{trans('admin.start.at')}}</th>
              <th scope="col">{{trans('admin.time.duration')}}</th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @php $serialNumber = ($tests->currentPage() - 1) * $tests->perPage() + 1; @endphp
              @foreach ($tests as $test)
              <tr class="table-row">
                <th scope="row">{{$serialNumber}}</th>
                <td>{{$test['name']}}</td>
                <td>
                    <div class="card" style="width: 150px; height:100px">      
                      <img class="card-img-top" src="{{ route('image.show', ['filename' => $test['images']]) }}" alt="Card image cap" id="showImg" >
                    </div>
                </td>
                <td>{{$test['start_at']}}</td>
                <td>{{$test['test_duration']}}</td>
                <td>
                  <a href="{{ route('addQna', ['id' => $test['id']]) }}">
                      <span class="fa fa-edit mr-3"></span>{{trans('admin.add.question')}}
                  </a>
              </td>
              
                <td>
                    <a href="#" class="edit-test" data-id="{{$test['id']}}">
                        <span class="fa fa-edit mr-3"></span>{{trans('admin.edit')}}
                    </a>
                </td>
                <td>
                    <a href="#" class="delete-test" data-id="{{$test['id']}}">
                        <span class="fa fa-trash mr-3"></span>{{trans('admin.delete')}}
                    </a>
                </td>
                @php $serialNumber++; @endphp
            </tr>
            @endforeach
        </tbody>
        </table>
        <h4 style="padding-left: 7in"> {{ $tests->links() }}</h4>
        
        <!--Add Test Modal -->
<div class="modal fade" id="addTestModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div id="successMessage" style="display:none;">
      {{trans('admin.success.note')}}
  </div>
    <form id="testForm" action="{{ route('tests.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{trans('admin.add.test')}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div>
            <label>{{trans('admin.name')}}:</label>
            <input type="text" name="name" id="name" placeholder="Enter Title" autocomplete="off">
          </div>
          <div>
            <label>{{trans('admin.start.at')}}:</label>
            <input type="datetime-local" name="start_at" id="date" placeholder="Enter time">
          </div>
          <div>
            <label>{{trans('admin.time.duration')}}:</label>
            <input type="time" name="test_duration" id="test_duration" placeholder="Enter Time Duration">
          </div>
          <div>
            <label>{{trans('admin.image')}}:</label>
            <input type="file" name="images" id="images" placeholder="Upload Image please:">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('admin.close')}}</button>
          <button id="submitButton" type="submit" class="btn btn-primary">{{trans('admin.add')}}</button> <!-- Change the button label to "Add" -->
        </div>
      </div>
    </form>
  </div>
</div>

        <!--Update test Modal -->
        <div class="modal fade" id="updateTestModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <form id="updateTestForm">
              @csrf
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">{{trans('admin.add.test')}}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div>
                    <label>{{trans('admin.name')}}:</label>
                    <input type="text" name="name" id="name" placeholder="Enter Title" autocomplete="off">
                  </div>
                  <div>
                    <label>{{trans('admin.start.at')}}:</label>
                    <input type="datetime-local" name="start_at" id="start_at" placeholder="Enter time">
                  </div>
                  <div>
                    <label>{{trans('admin.time.duration')}}:</label>
                    <input type="time" name="test_duration" id="test_duration" placeholder="Enter Time Duration">
                  </div>
                 
                  <div>
                    <label>{{trans('admin.image')}}:</label>
                    <input type="file" name="images" id="images" placeholder="Upload Image please:">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('admin.close')}}Close</button>
                  <button id="submitButton" type="submit" class="btn btn-primary">{{trans('admin.update')}}Update</button> <!-- Change the button label to "Add" -->
                </div>
              </div>
            </form>
          </div>
        </div>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var now = new Date();
        var oneYearLater = new Date(now);
        oneYearLater.setFullYear(oneYearLater.getFullYear() + 1);
        var formattedNow = now.toISOString().slice(0, 16);
        var formattedOneYearLater = oneYearLater.toISOString().slice(0, 16);
        document.getElementById('date').setAttribute('min', formattedNow);
        document.getElementById('date').setAttribute('max', formattedOneYearLater);
      });
    </script>
    <script>
    $(document).ready(function() {   
      $('.delete-test').click(function(e) {
          e.preventDefault();
          var testId = $(this).data('id');
          $.ajax({
              url: "/admin/delete-test/" + testId,
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type: 'DELETE',
              success: function(response) {
                window.location.href = "{{ route('test') }}";
              },
              error: function(xhr, status, error) {
                  console.error('Error:', error);
              }
          });
      });

    // Edit 
    $('.edit-test').on('click', function() {
    var testId = $(this).data('id');
    // Store data in session
    sessionStorage.setItem('id', testId);

    var editUrl = "/admin/test/" + testId + "/edit";

    // Make an AJAX GET request to retrieve the test data
    $.ajax({
      url: editUrl,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'GET',
      success: function(data) {

        $('#updateTestModel').find('#name').val(data.name);
        $('#updateTestModel').find('#start_at').val(data.start_at);
        $('#updateTestModel').find('#test_duration').val(data.test_duration);
        $('#updateTestModel').find('#images');
        $('#updateTestModel').modal('show');
        $("#updateTestModel").submit(function(e) {
          e.preventDefault();
          // Retrieve data from session
          var id = sessionStorage.getItem('id'); 
          var updatedName = $('#updateTestModel').find('#name').val();
          var updatedStartAt = $('#updateTestModel').find('#start_at').val();
          var updatedTestDuration = $('#updateTestModel').find('#test_duration').val();
          var updatedTestDuration = $('#updateTestModel').find('#images').val();

          var updateUrl = "/admin/update-test/" + id;
          var data = {};
          data['name'] = updatedName;
          data['start_at'] = updatedStartAt;
          data['test_duration'] = updatedTestDuration;
              $.ajax({
                  url: updateUrl,
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  type: 'POST',
                  data: data,
                  success: function(data) {
                    window.location.href = "{{ route('test') }}";
                  },
                  error: function(xhr, status, error) {
                      // Handle the error
                      console.error('Error:', error);
                  }
              });
          });

          },
          error: function(xhr, status, error) {
            // Handle the error
            console.error('Error:', error);
          }
        });
      });
  });
 </script>  
@endsection