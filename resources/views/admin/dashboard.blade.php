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
    <div class="col-sm-6">
      <div class="card">
        <div class="card-body">
            <h6 class="text-center">{{trans('admin.test.data')}}</h6>
            <div class="pieChartStyle">
                <canvas class="pieChart" id="pieChart"></canvas>
            </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card">
        <div class="card-body">
            <h6 class="text-center">{{trans('admin.dashboard.data')}}</h6>
                <div class="dashboard-data map_canvas">
                    <canvas id="myChart"></canvas>
                </div>
        </div>
      </div>
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
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',  // Color for Students
                        'rgba(54, 162, 235, 0.2)', // Color for Tests
                        'rgba(13, 219, 120, 0.8)',  // Color for Questions
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(12, 192, 192, 1)'
                    ],
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
