<!DOCTYPE html>
<html>
<head>
    @include('admin.css')
</head>
<body>
    <div class="page">
    @include('admin.header')
        <div class="page-content d-flex align-items-stretch">
    @include('admin.sidebar')
            <div class="content-inner">
                <header class="page-header">
            <div class="container-fluid">
                        <h2 class="no-margin-bottom">Sales Report</h2>
                    </div>
                </header>
                <div class="breadcrumb-holder container-fluid">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Sales Report</li>
                    </ul>
                </div>
                <section class="dashboard-counts section-padding">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header d-flex align-items-center">
                                        <h3 class="h4">Total Revenue</h3>
                                    </div>
                                    <div class="card-body">
                                        <h2 class="text-primary">₱{{ number_format($totalRevenue, 2) }}</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header d-flex align-items-center">
                                        <h3 class="h4">Total Transactions</h3>
                                    </div>
                                    <div class="card-body">
                                        <h2 class="text-success">{{ number_format($totalTransactions) }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="charts">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header d-flex align-items-center">
                                        <h3 class="h4">Monthly Sales</h3>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="salesChart" height="100"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <footer class="main-footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <p>ALT-CTRL-DELETE 2025</p>
                            </div>
                            <div class="col-sm-6 text-right">
                                <p> <a href="#" class="external">Espresso Brew</a></p>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    @include('admin.js')
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
    document.addEventListener('DOMContentLoaded', function() {
                    const ctx = document.getElementById('salesChart').getContext('2d');
        const labels = @json($labels);
        const data = @json($data);

        new Chart(ctx, {
            type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                    label: 'Monthly Sales',
                                data: data,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                responsive: true,
                            scales: {
                                y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '₱' + value.toLocaleString();
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return '₱' + context.raw.toLocaleString();
                            }
                        }
                                }
                            }
                        }
        });
                    });
                </script>
</body>
</html>
