@extends('admin.layouts.main')
@section('title', 'Question')
@section('main-content')

    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5 pt-5">
        <h2 class="mb-4 text-center">{{trans('admin.question')}}</h2>
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
            {{trans('admin.add.questions')}}
        </button>
        @if(Session::has('testId'))
            <button type="button" class="btn btn-primary" id="addQnatoTest" data-toggle="modal" data-target="#addQuestionModel">{{trans('admin.add.in.test')}}</button>
        @endif
        <a href="" class="btn btn-dark" id="uploadPDF" data-toggle="modal" data-target="#uploadPdfModal">{{trans('admin.upload.excel.file')}}</a>
        <div class="modal fade" id="uploadPdfModal" tabindex="-1" aria-labelledby="uploadPdfModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadPdfModalLabel">{{trans('admin.upload.mcq.excel')}}</h5>
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
                                <label for="pdf">{{trans('admin.choose.excel.file')}}</label>
                                <input type="file" name="excel_file" accept=".xlsx, .xls">
                            </div>
                            <button type="submit" class="btn btn-primary">{{trans('admin.upload')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Rest of your view file content -->

        <table class="table table-data">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">
                        <input type="checkbox" name="" id="selectAllId" aria-label="Checkbox for following text input">{{trans('admin.')}}Select All
                    </th>
                    <th scope="col">{{trans('admin.s.n')}}</th>
                    <th scope="col">{{trans('admin.question')}}</th>
                    <th scope="col">{{trans('admin.option.a')}}</th>
                    <th scope="col">{{trans('admin.option.b')}}</th>
                    <th scope="col">{{trans('admin.option.c')}}</th>
                    <th scope="col">{{trans('admin.option.d')}}</th>
                    <th scope="col">{{trans('admin.correct.answer')}}</th>
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
                @if (!empty($questions))
                @php $serialNumber = ($questions->currentPage() - 1) * $questions->perPage() + 1; @endphp
                
                    @foreach ($questions as $question)
                        <tr class="table-row">
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
                            <td>
                                <a href="#" class="edit-question" data-id="{{ $question['id'] }}">
                                    <span class="fa fa-edit mr-3"></span>{{trans('admin.edit')}}
                                </a>
                            </td>
                            
                            @php $serialNumber++; @endphp
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
            <h4 style="padding-left: 7in"> {{ $questions->links() }}</h4>
            

        
        <!--Add Test Modal -->
        <div class="modal fade" id="addQuestionModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form id="questionForm">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{trans('admin.add.question')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <label>{{trans('admin.question')}}:</label>
                                <textarea id="w3review" name="question" rows="4" cols="35"></textarea>
                            </div>
                            <div>
                                <label>{{trans('admin.option.1')}}</label>
                                <input type="text" name="option1" id="option1" placeholder="option-1" autocomplete="off">
                            </div>
                            <div>
                                <label>{{trans('admin.option.2')}}</label>
                                <input type="text" name="option2" id="option2" placeholder="option-2" autocomplete="off">
                            </div>
                            <div>
                                <label>{{trans('admin.option.3')}}</label>
                                <input type="text" name="option3" id="option3" placeholder="option-3" autocomplete="off">
                            </div>
                            <div>
                                <label>{{trans('admin.option.4')}}</label>
                                <input type="text" name="option4" id="option4" placeholder="option-4" autocomplete="off">
                            </div>
                            <div>
                                <label>{{trans('admin.correct.option')}}</label>
                                <input type="text" name="correct_option" id="correct_option"
                                    placeholder="Correct_option" autocomplete="off">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('admin.close')}}</button>
                            <button id="submitButton" type="submit" class="btn btn-primary">{{trans('admin.add')}}</button>
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
                            <h5 class="modal-title" id="exampleModalLabel">{{trans('admin.add.question')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <label>{{trans('admin.question')}}:</label>
                                <textarea id="question" name="question" rows="4" cols="35"></textarea>
                            </div>
                            <div>
                                <label>{{trans('admin.option.1')}}</label>
                                <input type="text" name="option1" id="option1" placeholder="option-1">
                            </div>
                            <div>
                                <label>{{trans('admin.option.2')}}</label>
                                <input type="text" name="option2" id="option2" placeholder="option-2">
                            </div>
                            <div>
                                <label>{{trans('admin.option.3')}}</label>
                                <input type="text" name="option3" id="option3" placeholder="option-3">
                            </div>
                            <div>
                                <label>{{trans('admin.option.4')}}</label>
                                <input type="text" name="option4" id="option4" placeholder="option-4">
                            </div>
                            <div>
                                <label>{{trans('admin.correct.option')}}</label>
                                <input type="text" name="correct_option" id="correct_option"
                                    placeholder="Correct_option">
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

                $('#addQnatoTest').click(function(e) {
                    e.preventDefault();
                    var all_ids = [];
                    $('input:checkbox[name=qid]:checked').each(function() {
                        all_ids.push($(this).val());
                    });

                    $.ajax({
                        url: "/admin/add-question/" + all_ids,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        data: all_ids,
                        success: function(response) {
                            window.location.href = "{{ route('test') }}";
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

                                var updateUrl = "/admin/update-question/" + id;
                                var data = {};
                                data['question'] = updatedQuestion;
                                data['option1'] = updatedOption1;
                                data['option2'] = updatedOption2;
                                data['option3'] = updatedOption3;
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
