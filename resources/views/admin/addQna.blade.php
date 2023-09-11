@extends('admin.layouts.main')
@section('title', 'Add Question')
@section('main-content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5 pt-5">
        <h2 class="mb-4 text-center" name="testId" value="{{ $test['id'] }}">Test Name: {{ $test['name'] }}</h2>


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
        <a href="" class="btn btn-success" id="addQna">Add Selected</a>
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
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($questions))
                    <?php $i = 1; ?>
                    @foreach ($questions as $question)
                        <tr>
                            <th>
                                <input type="checkbox" class="checkboxId" name="qid" value="{{ $question['id'] }}"
                                    aria-label="Checkbox for following text input">
                            </th>
                            <th scope="row">{{ $i }}</th>
                            <td>{{ $question['question'] }}</td>
                            <td>{{ $question['option1'] }}</td>
                            <td>{{ $question['option2'] }}</td>
                            <td>{{ $question['option3'] }}</td>
                            <td>{{ $question['option4'] }}</td>
                            <td>{{ $question['correct_option'] }}</td>
                            <td>{{ $question['time'] }}</td>

                            <?php $i++; ?>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>


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
                    var element = document.querySelector('[name="testId"]');
                    var testId = element.getAttribute('value');

                    $.ajax({
                        url: "/admin/add-questions-to-test",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        data: {
                            ids: all_ids,
                            testId: testId
                        },
                        success: function(data) {
                            window.location.href = "{{ route('test') }}";
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                });

            });
        </script>

    @endsection
