@extends('admin.layouts.main')
@section('title', 'Student')
@section('main-content')

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5">
        <h2 class="mb-4 text-center">Student</h2>
             <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStudentModel">
          Add Student 
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

        <table class="table">
          <thead class="thead-dark">
            
            <tr>
              <th scope="col">S.No.</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">mobile number</th>
              <th scope="col">User Type</th>
              <th scope="col"></th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <?php $i=1;?>
            @foreach ($students as $student)
            <tr>
              <th scope="row">{{$i}}</th>
              <td>{{$student['name']}}</td>
              <td>{{$student['email']}}</td>
              <td>{{$student['mobile_number']}}</td>
              <td>{{$student['user_type']}}</td>
              <td>
                <a href="#" class="edit-student" data-id="{{$student['id']}}">
                    <span class="fa fa-edit mr-3"></span>Edit
                </a>
              </td>              
              <td>
                <a href="#" class="delete-student" data-id="{{$student['id']}}">
                    <span class="fa fa-trash mr-3"></span>Delete
                </a>
              </td>
              <?php $i++;?>
              </tr>  
            @endforeach
          </tbody>
        </table>
        
        <!--Add Test Modal -->
<div class="modal fade" id="addStudentModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="studentForm">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div>
            <label>Name:</label>
            <input type="text" name="name" id="name" placeholder="Enter Title">
          </div>
          <div>
            <label>Email</label>
            <input type="email" name="email" id="email" placeholder="Enter time">
          </div>
          <div>
            <label>Password</label>
            <input type="password" name="password" id="password" placeholder="Enter Time Duration">
          </div>
          <div>
            <label>Mobile Number</label>
            <input type="text" name="mobile_number" id="mobile-number" placeholder="Enter Mobile Number">
          </div>
          <div >
            <div >
              <label for="inputGroupSelect01">Options</label>
                </div>
                    <select class="custom-select" id="inputGroupSelect01">
                    <option selected>Choose...</option>
                    <option value="S">S</option>
                    <option value="A">A</option>
                    </select>
                </div>
            </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="submitButton" type="submit" class="btn btn-primary">Add</button> <!-- Change the button label to "Add" -->
        </div>
      </div>
    </form>
  </div>
</div>

        <!--Update test Modal -->
        <div class="modal fade" id="updateStudentModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <form id="updateStudentForm">
                @csrf
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div>
                        <label>Name:</label>
                        <input type="text" name="name" id="name" placeholder="Enter Title">
                      </div>
                      <div>
                        <label>Email</label>
                        <input type="email" name="email" id="email" placeholder="Enter time">
                      </div>
                      <div>
                        <label>Mobile Number</label>
                        <input type="text" name="mobile_number" id="mobile_number" placeholder="Enter Mobile Number">
                      </div>
                      <div >
                        <div >
                          <label for="inputGroupSelect01">Options</label>
                            </div>
                                <select class="custom-select" id="inputGroupSelect01">
                                <option selected id="user_type">Choose...</option>
                                <option value="S" >S</option>
                                <option value="A">A</option>
                                </select>
                            </div>
                        </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="submitButton" type="submit" class="btn btn-primary">Update</button> <!-- Change the button label to "Add" -->
                  </div>
                </div>
              </form>
          </div>
        </div>


    <script>
    $(document).ready(function() {
      $("#studentForm").submit(function(e) {
          e.preventDefault();
          var data = {};
          data['name'] = $('[name="name"]').val();
          data['email'] = $('[name="email"]').val();
          data['password'] = $('[name="password"]').val();
          data['mobile_number'] = $('[name="mobile_number"]').val();
          data['user_type'] = $('[name="user_type"]').val();
          data['registerVia'] = 'Admin';
          var url = "{{ route('registration.store') }}";
          $.ajax({
              url: url,
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type: 'POST',
              data: data,
              success: function(data) {
                window.location.href = "{{ route('admin.students') }}";
              },
              error: function(xhr, status, error) {
                  // Handle the error
                  console.error('Error:', error);
              }
          });
      });
      
      $('.delete-student').click(function(e) {
          e.preventDefault();
          var studentId = $(this).data('id');
          $.ajax({
              url: "/admin/delete-student/" + studentId,
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type: 'DELETE',
              success: function(response) {
                window.location.href = "{{ route('admin.students') }}";
              },
              error: function(xhr, status, error) {
                  console.error('Error:', error);
              }
          });
      });

    // Edit 
    $('.edit-student').on('click', function() {
    var studentId = $(this).data('id');
    // Store data in session
    sessionStorage.setItem('id', studentId);

    var editUrl = "/admin/student/" + studentId + "/edit";

    // Make an AJAX GET request to retrieve the test data
    $.ajax({
      url: editUrl,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'GET',
      success: function(data) {
        $('#updateStudentModel').find('#name').val(data.name);
        $('#updateStudentModel').find('#email').val(data.email);
        $('#updateStudentModel').find('#mobile_number').val(data.mobile_number);
        $('#updateStudentModel').find('.custom-select').val(data.user_type);
        
        $('#updateStudentModel').modal('show');
        
        $("#updateStudentModel").submit(function(e) {
          e.preventDefault();
          // Retrieve data from session
          var id = sessionStorage.getItem('id'); 
          var updatedName = $('#updateStudentModel').find('#name').val();
          var updatedEmail = $('#updateStudentModel').find('#email').val();
          var updatedMobile = $('#updateStudentModel').find('#mobile_number').val();
          var updatedUserType = $('#updateStudentModel').find('.custom-select').val();

          var updateUrl = "/admin/update-student/" + id;
          var data = {};
          data['name'] = updatedName;
          data['email'] = updatedEmail;
          data['mobile_number'] = updatedMobile;
          data['user_type'] = updatedUserType;
              $.ajax({
                  url: updateUrl,
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  type: 'POST',
                  data: data,
                  success: function(data) {
                    window.location.href = "{{ route('admin.students') }}";
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