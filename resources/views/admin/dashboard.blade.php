@extends('admin.layouts.main')
@section('title', 'Dashboard')
@section('main-content')

    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5 pt-5">
        <h2 class="mb-4 text-center">{{trans('dashboard')}}</h2>
        <!-- Show Pie  Chart Data -->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <!-- Show Column Chart Data -->
        <script src="https://cdnjs.com/libraries/Chart.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
        <?php
    // Assuming you have $data available
    $labels = [];
    $values = [];
    $backgroundColors = [];

    foreach ($data as $label => $value) {
        $labels[] = $label;
        $values[] = $value;
        $backgroundColors[] = "rgba(".rand(0, 255).", ".rand(0, 255).", ".rand(0, 255).", 0.6)";

    }
?>


        
        <div class="row">
            <div class="col-md-8">
                <div class="map_canvas">
                    <canvas id="myChart" width="auto" height="100"></canvas>
                    <h6 class="text-center">{{trans('admin.dashboard.data')}}</h6>
                </div>
            </div>
            <div class="col-md-4 "></div>
        </div>
        <div class="gap"></div>
       <div class="row">
                <div class="col-md-8"></div>
                <div class="col-md-4 ">
                    <h6 class="text-center">{{trans('admin.test.data')}}</h6>
                    <canvas id="pieChart" width="40" height="10"></canvas>
                </div>
       </div>

       <script>
            var dynamicData = @json(['labels' => $labels, 'values' => $values, 'backgroundColors' => $backgroundColors]);
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('pieChart').getContext('2d');
            var pieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: dynamicData.labels,
                    datasets: [{
                        data: dynamicData.values,
                        backgroundColor: dynamicData.backgroundColors,
                    }]
                },
                options: {
                    responsive: true,
                }
            });
        });
    </script>
      
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
