@extends('admin.layouts.main')
@section('title', 'Test Response')
@section('main-content')

    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5 pt-5">
        <h2 class="mb-4 text-center">{{trans('admin.test.result')}}</h2>
        <!-- Button trigger modal -->
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        <!-- Rest of your view file content -->

        <table class="table table-data">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">
                        <input type="checkbox" name="" id="selectAllId" aria-label="Checkbox for following text input">{{trans('admin.select.all')}}
                    </th>
                    <th scope="col">{{trans('admin.test')}}</th>
                    <th scope="col">{{trans('admin.student')}}</th>
                    <th scope="col">{{trans('admin.attempt')}}</th>
                    <th scope="col">{{trans('admin.score')}}</th>

                    <th></th>
                    <th>
                        <div class="btn-group">
                          <i class="fa fa-ellipsis-v fa-2x" aria-hidden="true" style="color: #04f18a;" data-toggle="dropdown"></i>
                          {{-- <i class="fa-solid fa-ellipsis-vertical fa-beat-fade" style="color: #04f18a;" data-toggle="dropdown"></i> --}}
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="#" id="addQna"><span class="fa fa-trash mr-3"></span>{{trans('admin.delete')}}</a>
                            </div>
                        </div>                  
                    </th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($tests))  
                    @foreach ($tests as $test)
                        <tr class="table-row">
                            <td>
                                <input type="checkbox" class="checkboxId" name="qid" value="{{ $test['id'] }}"
                                    aria-label="Checkbox for following text input">
                            </td>
                            
                            <td>{{ $test['test_name'] }}</td>
                            <td>{{ $test['student'] }}</td>
                            <td>{{ $test['attempt'] }}</td>
                            <td>{{ $test['score'] }}</td>
                            <td>
                                <a href="#" class="edit-test-response" data-id="{{ $test['id'] }}">
                                    <span class="fa fa-edit mr-3"></span>{{trans('admin.edit')}}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
            <h4 style="padding-left: 7in"> </h4>
            

        <!--Update test Modal -->
        <div class="modal fade" id="updateTestResModel" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form id="updateQuestionForm">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{trans('admin.update.test.res')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            
                            <div>
                                <label>{{trans('admin.option.1')}}</label>
                                <input type="text" name="test_id" id="test_id" placeholder="option-1">
                            </div>
                            <div>
                                <label>{{trans('admin.option.2')}}</label>
                                <input type="text" name="attempt" id="attempt" placeholder="option-2">
                            </div>
                            <div>
                                <label>{{trans('admin.option.3')}}</label>
                                <input type="text" name="score" id="score" placeholder="option-3">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('admin.close')}}</button>
                            <button id="submitButton" type="submit" class="btn btn-primary">{{trans('admin.update')}}</button>
                            <!-- Change the button label to "Add" -->
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <script>
            $(function(e) {
                $("#selectAllId").click(function() {
                    $('.checkboxId').prop('checked', $(this).prop('checked'));
                });

                $('#addQna').click(function(e) {
                    e.preventDefault();
                    var all_ids = [];
                    $('input:checkbox[name=qid]:checked').each(function() {
                        all_ids.push($(this).val());
                    });

                    $.ajax({
                        url: "/admin/delete-test-response/" + all_ids,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'DELETE',
                        success: function(response) {
                            window.location.href = "{{ route('test-result') }}";
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                });

            });

            $(document).ready(function() {
                // Edit 
                $('.edit-test-response').on('click', function() {
                    var testResId = $(this).data('id');
                    // Store data in session
                    sessionStorage.setItem('id', testResId);

                    var editUrl = "/admin/testResponse/" + testResId + "/edit";

                    // Make an AJAX GET request to retrieve the test data
                    $.ajax({
                        url: editUrl,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'GET',
                        success: function(data) {
                            console.log(data);
                            $('#updateTestResModel').find('#test_id').val(data.test['name']);
                            $('#updateTestResModel').find('#attempt').val(data.attempt);
                            $('#updateTestResModel').find('#score').val(data.score);
                            $('#updateTestResModel').modal('show');
                            $("#updateTestResModel").submit(function(e) {
                                e.preventDefault();
                                // Retrieve data from session
                                var id = sessionStorage.getItem('id');
                                var updatedQuestion = $('#updateTestResModel').find(
                                    '#question').val();
                                var updatedtest = $('#updateTestResModel').find(
                                    '#test').val();
                                var updatedattempt = $('#updateTestResModel').find(
                                    '#attempt').val();
                                var updatedscore = $('#updateTestResModel').find(
                                    '#score').val();
                                var updatedOption4 = $('#updateTestResModel').find(
                                    '#option4').val();
                                var updatedCorrectOption = $('#updateTestResModel').find(
                                    '#correct_option').val();

                                var updateUrl = "/admin/update-question/" + id;
                                var data = {};
                                data['question'] = updatedQuestion;
                                data['test'] = updatedtest;
                                data['attempt'] = updatedattempt;
                                data['score'] = updatedscore;
                                data['option4'] = updatedOption4;
                                data['correct_option'] = updatedCorrectOption;
                                $.ajax({
                                    url: updateUrl,
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                            .attr('content')
                                    },
                                    type: 'POST',
                                    data: data,
                                    success: function(data) {
                                        window.location.href =
                                            "{{ route('admin.question') }}";
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
