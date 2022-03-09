@extends('layouts.admin')

@section('personalCss')
    <link rel="stylesheet" href="{{ asset('css/app.css') }} ">
    <link href="{{ asset('css/restaurantEdit.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="scroll">
        <div class="container mt-5">
            <div>
                <canvas id="canvas" width="240px" height="135px"></canvas>
            </div>

            <div class="pt-5">
                <canvas id="canvas2" width="240px" height="135px"></canvas>
            </div>
        </div>
    </div>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

<script type="module">
    /* var data_y = "<?php echo json_encode($monthOrders); ?>" */
    var data_y = JSON.parse('{!! json_encode($monthOrders) !!}')
    var data_x1 = JSON.parse('{!! json_encode($months) !!}')
    var data_y2 = JSON.parse('{!! json_encode($amountOrders) !!}')
    Chart.defaults.global.defaultFontColor = "#fff";
    console.log(data_y, data_x1, data_y2[0].sums);
    var barChartData = {
        labels: data_x1,
        datasets: [{
            label: 'Total Orders',
            backgroundColor: "#ca1d1f87",
            data: data_y,
        }]
    };
    var barChartData2 = {
        labels: data_x1,
        datasets: [{
            label: 'Amount orders',
            backgroundColor: "#ca1d1f87",
            data: data_y2,
        }]
    };

    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 0,
                        borderColor: '#fff',
                        borderSkipped: 'bottom',
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Numero Ordini per anno/mese',
                    color: '#ffffff',
                    fontSize: 18,
                },
                scales: {
                    yAxes: [{
                        display: true,
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        var ctx = document.getElementById("canvas2").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData2,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 0,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom',
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Fatturato per mese/anno',
                    color: '#ffffff',
                    fontSize: 18,
                },
                scales: {
                    yAxes: [{
                        display: true,
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    };
</script>
