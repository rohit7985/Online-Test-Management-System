@extends('admin.layouts.main')
@section('title', 'Question')
@section('main-content')

    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5 pt-5">
        <h2 class="mb-4 text-center">Question</h2>
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
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addQuestionModel">
            Add Question
        </button>
        <a href="" class="btn btn-dark" id="uploadPDF" data-toggle="modal" data-target="#uploadPdfModal">Upload Excel File</a>
        <div class="modal fade" id="uploadPdfModal" tabindex="-1" aria-labelledby="uploadPdfModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadPdfModalLabel">Upload MCQ Excel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if(session('success1'))
                            <div class="alert alert-success">{{ session('success1') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <form action="{{ route('import.excel') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="pdf">Choose Excel File</label>
                                <input type="file" name="excel_file" accept=".xlsx, .xls">
                            </div>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Rest of your view file content -->

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">
                        Select All
                        <input type="checkbox" name="" id="selectAllId"
                            aria-label="Checkbox for following text input">
                    </th>
                    <th scope="col">S.No.</th>
                    <th scope="col">Question</th>
                    <th scope="col">Option-A</th>
                    <th scope="col">Option-B</th>
                    <th scope="col">Option-C</th>
                    <th scope="col">Option-D</th>
                    <th scope="col">Correct Answer</th>
                    <th scope="col">Time</th>
                    <th></th>
                    <th>
                        <div class="btn-group">
                          <i class="fa fa-ellipsis-v fa-2x" aria-hidden="true" style="color: aqua" data-toggle="dropdown"></i>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="#" id="addQna"><span class="fa fa-trash mr-3"></span>Delete</a>
                            </div>
                        </div>                  
                    </th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($questions))
                @php $serialNumber = ($questions->currentPage() - 1) * $questions->perPage() + 1; @endphp
                
                    @foreach ($questions as $question)
                        <tr>
                            <td>
                                <input type="checkbox" class="checkboxId" name="qid" value="{{ $question['id'] }}"
                                    aria-label="Checkbox for following text input">
                            </td>
                            <td>{{ $serialNumber }}</td>
                            <td>{{ $question['question'] }}</td>
                            <td>{{ $question['option1'] }}</td>
                            <td>{{ $question['option2'] }}</td>
                            <td>{{ $question['option3'] }}</td>
                            <td>{{ $question['option4'] }}</td>
                            <td>{{ $question['correct_option'] }}</td>
                            <td>{{ $question['time'] }}</td>

                            <td>
                                <a href="#" class="edit-question" data-id="{{ $question['id'] }}">
                                    <span class="fa fa-edit mr-3"></span>Edit
                                </a>
                            </td>
                            
                            @php $serialNumber++; @endphp
                        </tr>
                    @endforeach
                @endif
                {{ $questions->links() }}
            </tbody>
        </table>

        <!--Add Test Modal -->
        <div class="modal fade" id="addQuestionModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form id="questionForm">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Question</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <label>Question:</label>
                                <textarea id="w3review" name="question" rows="4" cols="35"></textarea>
                            </div>
                            <div>
                                <label>Option-1</label>
                                <input type="text" name="option1" id="option1" placeholder="option-1">
                            </div>
                            <div>
                                <label>Option-2</label>
                                <input type="text" name="option2" id="option2" placeholder="option-2">
                            </div>
                            <div>
                                <label>Option-3</label>
                                <input type="text" name="option3" id="option3" placeholder="option-3">
                            </div>
                            <div>
                                <label>Option-4</label>
                                <input type="text" name="option4" id="option4" placeholder="option-4">
                            </div>
                            <div>
                                <label>Correct_option</label>
                                <input type="text" name="correct_option" id="correct_option"
                                    placeholder="Correct_option">
                            </div>
                            <div>
                                <label>Time</label>
                                <input type="text" name="time" id="time" placeholder="Time">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button id="submitButton" type="submit" class="btn btn-primary">Add</button>
                            <!-- Change the button label to "Add" -->
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!--Update test Modal -->
        <div class="modal fade" id="updateQuestionModel" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form id="updateQuestionForm">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Question</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <label>Question:</label>
                                <textarea id="question" name="question" rows="4" cols="35"></textarea>
                            </div>
                            <div>
                                <label>Option-1</label>
                                <input type="text" name="option1" id="option1" placeholder="option-1">
                            </div>
                            <div>
                                <label>Option-2</label>
                                <input type="text" name="option2" id="option2" placeholder="option-2">
                            </div>
                            <div>
                                <label>Option-3</label>
                                <input type="text" name="option3" id="option3" placeholder="option-3">
                            </div>
                            <div>
                                <label>Option-4</label>
                                <input type="text" name="option4" id="option4" placeholder="option-4">
                            </div>
                            <div>
                                <label>Correct_option</label>
                                <input type="text" name="correct_option" id="correct_option"
                                    placeholder="Correct_option">
                            </div>
                            <div>
                                <label>Time</label>
                                <input type="text" name="time" id="time" placeholder="Time">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button id="submitButton" type="submit" class="btn btn-primary">Update</button>
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
                        url: "/admin/delete-question/" + all_ids,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'DELETE',
                        success: function(response) {
                            window.location.href = "{{ route('admin.question') }}";
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                });

            });

            $(document).ready(function() {
                $("#questionForm").submit(function(e) {
                    e.preventDefault();
                    var data = {};
                    data['question'] = $('[name="question"]').val();
                    data['option1'] = $('[name="option1"]').val();
                    data['option2'] = $('[name="option2"]').val();
                    data['option3'] = $('[name="option3"]').val();
                    data['option4'] = $('[name="option4"]').val();
                    data['correct_option'] = $('[name="correct_option"]').val();
                    data['time'] = $('[name="time"]').val();

                    var url = "{{ route('question.store') }}";
                    $.ajax({
                        url: url,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        data: data,
                        success: function(data) {
                            window.location.href = "{{ route('admin.question') }}";
                        },
                        error: function(xhr, status, error) {
                            // Handle the error
                            console.error('Error:', error);
                        }
                    });
                });

                // $('.delete-question').click(function(e) {
                //     e.preventDefault();
                //     var questionId = $(this).data('id');
                //     $.ajax({
                //         url: "/admin/delete-question/" + questionId,
                //         headers: {
                //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //         },
                //         type: 'DELETE',
                //         success: function(response) {
                //             window.location.href = "{{ route('admin.question') }}";
                //         },
                //         error: function(xhr, status, error) {
                //             console.error('Error:', error);
                //         }
                //     });
                // });

                // Edit 
                $('.edit-question').on('click', function() {
                    var questionId = $(this).data('id');
                    // Store data in session
                    sessionStorage.setItem('id', questionId);

                    var editUrl = "/admin/question/" + questionId + "/edit";

                    // Make an AJAX GET request to retrieve the test data
                    $.ajax({
                        url: editUrl,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'GET',
                        success: function(data) {
                            $('#updateQuestionModel').find('#question').val(data.question);
                            $('#updateQuestionModel').find('#option1').val(data.option1);
                            $('#updateQuestionModel').find('#option2').val(data.option2);
                            $('#updateQuestionModel').find('#option3').val(data.option3);
                            $('#updateQuestionModel').find('#option4').val(data.option4);
                            $('#updateQuestionModel').find('#correct_option').val(data
                                .correct_option);
                            $('#updateQuestionModel').find('#time').val(data.time);

                            $('#updateQuestionModel').modal('show');

                            $("#updateQuestionModel").submit(function(e) {
                                e.preventDefault();
                                // Retrieve data from session
                                var id = sessionStorage.getItem('id');
                                var updatedQuestion = $('#updateQuestionModel').find(
                                    '#question').val();
                                var updatedOption1 = $('#updateQuestionModel').find(
                                    '#option1').val();
                                var updatedOption2 = $('#updateQuestionModel').find(
                                    '#option2').val();
                                var updatedOption3 = $('#updateQuestionModel').find(
                                    '#option3').val();
                                var updatedOption4 = $('#updateQuestionModel').find(
                                    '#option4').val();
                                var updatedCorrectOption = $('#updateQuestionModel').find(
                                    '#correct_option').val();
                                var updatedTime = $('#updateQuestionModel').find('#time')
                                    .val();

                                var updateUrl = "/admin/update-question/" + id;
                                var data = {};
                                data['question'] = updatedQuestion;
                                data['option1'] = updatedOption1;
                                data['option2'] = updatedOption2;
                                data['option3'] = updatedOption3;
                                data['option4'] = updatedOption4;
                                data['correct_option'] = updatedCorrectOption;
                                data['time'] = updatedTime;
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
