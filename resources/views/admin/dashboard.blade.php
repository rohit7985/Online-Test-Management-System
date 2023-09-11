@extends('admin.layouts.main')
@section('title', 'Dashboard')
@section('main-content')

    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5 pt-5">
        <h2 class="mb-4 text-center">Dashboard</h2>

        <!-- Show Graph Data -->
        <script src="https://cdnjs.com/libraries/Chart.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>

        <div class="map_canvas">
            <canvas id="myChart" width="auto" height="100"></canvas>
            <h6 class="text-center">Dashboard Data</h6>
        </div>

        <script>
            var students = {{ $students }};
            var tests = {{ $tests }};
            var questions = {{ $questions }};
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Students', 'Tests', 'Questions'],
                    datasets: [{
                        label: 'Total Numbers',
                        data: [students, tests, questions],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            max: 50,
                            min: 0,
                            ticks: {
                                stepSize: 10
                            }
                        }
                    },
                    plugins: {
                        title: {
                            display: false,
                            text: 'Custom Chart Title'
                        },
                        legend: {
                            display: false,
                        }
                    }
                }
            });
        </script>
    @endsection
