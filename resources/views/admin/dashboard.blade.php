@extends('layouts.sidebar')

@section('title', 'Dashboard Admin')
@section('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/11.4.1/highcharts.js"></script>

    <style>
        .dashboard-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            padding: 10px 0;
        }

        .card-item {
            background: #FCFFFD;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4x 6px rgba(0, 0, 0, 0.05);
            border: 1px solid #eef0f5;
            display: flex;
            flex-direction: column;
            transition: transform 0.2s;
        }

        .card-item:hover {
            transform: translateY(-5px);
        }

        .card-label {
            font-size: 14px;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-value {
            font-size: 24px;
            font-weight: 700;
            color: #11101d;
        }

        .chart-card {
            grid-column: span 1;
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
            border: 1px solid #FCFFFD;
        }

        .parent {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            grid-template-rows: repeat(5, 1fr);
            background-color: aqua;
            gap: 8px;
        }

        @media (min-width: 1024px) {
            .chart-card {
                grid-column: span 2;
            }
        }
    </style>

    <main>
        <div class="header" style="margin-bottom: 20px;">
            <h2>Ringkasan Dashboard</h2>
        </div>

        <div class="dashboard-container">

            {{-- Card Notifikasi --}}
            <div class="card-item">
                <div class="card-label">
                    notifikasi
                    <i class="bx bx-bell" style="color: #635BFF;"></i>
                </div>
                <div class="card-value" style="font-size: 16px; font-weight: 300; margin-top: 10px;">Ada 3 pesan baru</div>
            </div>

            {{-- Card User --}}
            <div class="card-item">
                <div class="card-label">
                    Total user
                    <i class="bx bx-user" style="color: #635bff"></i>
                </div>
                <div class="card-value">{{ $TotalUser }}</div>
            </div>

            {{-- Card Pesanan --}}
            <div class="card-item">
                <div class="card-label">
                    mobil disewa
                    <i class="bx bx-cart" style="color:#635bff"></i>
                </div>
                <div class="card-value">85</div>
            </div>

            {{-- Card Keuntungan --}}
            <div class="card-item">
                <div class="card-label">
                    keuntungan
                    <i class="bx bx-money" style="color:#635bff"></i>
                </div>
                <div class="card-value">Rp 12.3M</div>
            </div>
        </div>

        <div class="chart-card">
            <div id="chart-penjualan"></div>
        </div>
    </main>


    {{-- Dashboard yang isinya adalah laporan sewaan dengan statisik --}}
    {{-- <div id="container"></div> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function () {


            Highcharts.chart('chart-penjualan', {
                chart: {
                    zooming: {
                        type: 'xy'
                    }
                },
                title: {
                    text: 'Penjualan Bulanan',
                    align: 'left'
                },
                credits: {
                    enabled: false,
                },
                xAxis: [{
                    categories: [
                        'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                        'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                    ],
                    crosshair: true
                }],
                yAxis: [{ // Primary yAxis
                    labels: {
                        format: '{value}°C'
                    },
                    title: {
                        text: 'Mobil Disewa'
                    },
                    lineColor: Highcharts.getOptions().colors[1],
                    lineWidth: 2
                }, { // Secondary yAxis
                    title: {
                        text: 'Keuntungan'
                    },
                    labels: {
                        format: '{value} mm'
                    },
                    lineColor: Highcharts.getOptions().colors[0],
                    lineWidth: 2,
                    opposite: true
                }],
                tooltip: {
                    shared: true
                },
                legend: {
                    align: 'left',
                    verticalAlign: 'top'
                },
                series: [{
                    name: 'Keuntungan',
                    type: 'column',
                    yAxis: 1,
                    data: [
                        45.7, 37.0, 28.9, 17.1, 39.2, 18.9, 90.2, 78.5, 74.6,
                        18.7, 17.1, 16.0
                    ],
                    tooltip: {
                        valueSuffix: ' mm'
                    }

                }, {
                    name: 'Mobil disewa',
                    type: 'spline',
                    data: [
                        -11.4, -9.5, -14.2, 0.2, 7.0, 12.1, 13.5, 13.6, 8.2,
                        -2.8, -12.0, -15.5
                    ],
                    tooltip: {
                        valueSuffix: '°C'
                    }
                }]
            });

            window.addEventListener('resize', function () {
                Highcharts.charts.forEach(chart => {
                    if (chart) {
                        chart.reflow();
                    }
                });
            });
        });
    </script>

@endsection