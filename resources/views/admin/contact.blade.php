@extends('admin.layouts.main')
@section('title', 'Student')
@section('main-content')

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5">
        <h2 class="mb-4 text-center">{{trans('admin.contact.us.details')}}</h2>
       
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
              <th scope="col">{{trans('admin.email')}}</th>
              <th scope="col">{{trans('admin.subject')}}</th>
              <th scope="col">{{trans('admin.message')}}</th>
              <th scope="col"></th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <?php $i=1;?>
            @foreach ($contacts as $contact)
            <tr class="table-row">
              <th scope="row">{{$i}}</th>
              <td>{{$contact['name']}}</td>
              <td>{{$contact['email']}}</td>
              <td>{{$contact['subject']}}</td>
              <td>{{$contact['message']}}</td>             
              <td>
                <a href="#" class="delete-contact" data-id="{{$contact['id']}}">
                    <span class="fa fa-trash mr-3"></span>{{trans('admin.delete')}}
                </a>
              </td>
              <?php $i++;?>
              </tr>  
            @endforeach
          </tbody>
        </table>
        
    <script>
    $(document).ready(function() {
      
      
      $('.delete-contact').click(function(e) {
          e.preventDefault();
          var contactId = $(this).data('id');
          $.ajax({
              url: "/admin/delete-contact/" + contactId,
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type: 'DELETE',
              success: function(response) {
                window.location.href = "{{ route('admin.contact') }}";
              },
              error: function(xhr, status, error) {
                  console.error('Error:', error);
              }
          });
      });
  });

 </script>
    
@endsection