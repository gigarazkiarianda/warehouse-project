@extends('layouts.app')

@section('content')
    <h1 class="animate-text">Dashboard Admin</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card animate-card">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Pengguna</h5>
                    <p class="card-text">{{ $usersCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card animate-card">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Produk</h5>
                    <p class="card-text">{{ $productsCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card animate-card">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Gudang</h5>
                    <p class="card-text">{{ $gudangsCount }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card animate-card">
                <div class="card-body">
                    <h5 class="card-title">Statistik</h5>
                    <div class="chart-container">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Data for the chart
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Pengguna', 'Produk', 'Gudang'],
                datasets: [{
                    label: 'Jumlah',
                    data: [{{ $usersCount }}, {{ $productsCount }}, {{ $gudangsCount }}],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <style>
        .chart-container {
            position: relative;
            height: 400px;
        }
        @media (max-width: 768px) {
            .chart-container {
                height: 300px;
            }
        }

        /* Animation for the text and card elements */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-text {
            animation: fadeIn 1s ease-out;
        }

        .animate-card {
            animation: fadeIn 1.5s ease-out;
        }
    </style>
@endsection
