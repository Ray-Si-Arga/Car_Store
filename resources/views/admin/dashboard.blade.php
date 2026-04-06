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
        <x-page-header>
            <x-slot:title>Dashboard</x-slot:title>
            <x-slot:subtitle>Ringkasan Informasi</x-slot:subtitle>
        </x-page-header>

        <div class="dashboard-container">

            {{-- Card Persetujuan --}}
            <div class="card-item">
                <div class="card-label">
                    Butuh Persetujuan
                    <i class="bx bx-bell" style="color: #635BFF;"></i>
                </div>
                <div class="card-value">
                    {{ $bookings->where('status', 'pending')->count() }}
                </div>
            </div>

            {{-- Card User --}}
            <div class="card-item">
                <div class="card-label">
                    Total user
                    <i class="bx bx-user" style="color: #635bff"></i>
                </div>
                <div class="card-value">
                    {{ $TotalUser }}
                </div>
            </div>

            {{-- Card Disewa --}}
            <div class="card-item">
                <div class="card-label">
                    mobil disewa
                    <i class="bx bx-cart" style="color:#635bff"></i>
                </div>
                <div class="card-value">
                    {{ $cars->where('status', 'disewa')->count() }}
                </div>
            </div>

            {{-- Card Keuntungan --}}
            <div class="card-item">
                <div class="card-label">
                    keuntungan
                    <i class="bx bx-money" style="color:#635bff"></i>
                </div>
                <div class="card-value">
                    Rp {{ number_format($bookings->where('status', 'selesai')->sum('total_harga'), 0, ',', '.') }}
                </div>
            </div>
        </div>

        <div class="chart-card">
            <div id="chart-penjualan"></div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Highcharts.chart('chart-penjualan', {
                chart: {
                    zooming: {
                        type: 'xy'
                    }
                },
                title: {
                    text: 'Keuntungan & Sewa',
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
                        format: '{value}'
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
                        formatter: function () {
                            return 'Rp ' + this.value.toLocaleString('id-ID');
                        }
                    },
                    lineColor: Highcharts.getOptions().colors[0],
                    lineWidth: 2,
                    opposite: true
                }],
                tooltip: {
                    shared: true,
                    headerFormat: '<b>{point.x}</b><br/>'
                },
                legend: {
                    align: 'left',
                    verticalAlign: 'top'
                },
                series: [{
                    name: 'Keuntungan',
                    type: 'column',
                    yAxis: 1,
                    data: @json($profits),
                    tooltip: {
                        pointFormat: '<span style="color:{point.color}">\u25CF</span> {series.name}: <b>Rp {point.y:,.0f}</b><br/>'
                    }

                }, {
                    name: 'Mobil disewa',
                    type: 'spline',
                    data: @json($counts),
                    tooltip: {
                        pointFormat: '<span style="color:{point.color}">\u25CF</span> {series.name}: <b>{point.y} Mobil</b><br/>'
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