<!DOCTYPE html>
<html>
<head>
    @include('admin.css')
</head>
<body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">

                @yield('content')
                <div class="container mt-5">
                    <h2 class="text-center">Sales Overview</h2>
                    <canvas id="salesChart" width="400" height="200"></canvas>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    // Prepare data for the chart
                    const labels = @json($labels); // Preprocessed labels from the controller
                    const data = @json($data); // Preprocessed data from the controller

                    // Create the chart
                    const ctx = document.getElementById('salesChart').getContext('2d');
                    const salesChart = new Chart(ctx, {
                        type: 'bar', // You can change this to 'line', 'pie', etc.
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Total Orders',
                                data: data,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                </script>


            </div>
        </div>
    </div>

    @include('admin.js')
</body>
</html>
