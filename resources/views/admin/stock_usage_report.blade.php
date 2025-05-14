<!DOCTYPE html>
<html>
<head>
    @include('admin.css')
    <style>
        .report-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .report-table th, .report-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .report-table th {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="container-fluid">
            <h2>Stock Usage Report</h2>

            <!-- Chart Container -->
            <div style="width: 800px; margin: 20px auto;">
                <canvas id="stockChart"></canvas>
            </div>

            @include('admin.js')
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                const ctx = document.getElementById('stockChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: @json($labels),
                        datasets: [{
                            label: 'Stock In',
                            data: @json($stockIn),
                            backgroundColor: 'rgba(75, 192, 192, 0.6)',
                            borderWidth: 1
                        }, {
                            label: 'Stock Out',
                            data: @json($stockOut),
                            backgroundColor: 'rgba(255, 99, 132, 0.6)',
                            borderWidth: 1
                        }, {
                            label: 'Current Stock',
                            data: @json($currentStock),
                            backgroundColor: 'rgba(54, 162, 235, 0.6)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Quantity'
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Ingredients'
                                }
                            }
                        }
                    }
                });
            </script>
            
            <table class="report-table">
                <thead>
                    <tr>
                        <th>Ingredient</th>
                        <th>Total Restocked</th>
                        <th>Total Used</th>
                        <th>Net Usage</th>
                        <th>Current Stock</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usageData as $data)
                    <tr>
                        <td>{{ $data->stock->ingredient_name }}</td>
                        <td>{{ $data->total_in }}</td>
                        <td>{{ $data->total_out }}</td>
                        <td>{{ $data->total_in - $data->total_out }}</td>
                        <td>{{ $data->stock->quantity }} {{ $data->stock->unit }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('admin.js')
</body>
</html>