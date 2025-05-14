<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')

    <style>
        body {
            background-color: #000;
            color: #fff;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            background-color: #111;
            border: 1px solid #444;
            border-radius: 10px;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
            color: #fff;
        }

        .table {
            background-color: #000;
            color: #fff;
        }

        .table thead th {
            background-color: #222;
            color: #fff;
            border-bottom: 2px solid #555;
        }

        .table tbody tr:nth-child(even) {
            background-color: #111;
        }

        .table tbody tr:hover {
            background-color: #222;
        }

        .pagination .page-link {
            background-color: #000;
            border: 1px solid #444;
            color: #fff;
        }

        .pagination .page-item.active .page-link {
            background-color: #444;
            border-color: #444;
        }

        .text-muted {
            color: #aaa !important;
        }
    </style>
</head>
<body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="container">
        <div class="card">
            <h2>Transaction List</h2>

            <table class="table table-hover">
            <thead>
    <tr>
        <th>#</th>
        <th>Product ID</th>
        <th>Product Name</th> {{-- Added --}}
        <th>Quantity</th>
        <th>Total Price</th>
        <th>Date of Sale</th>
    </tr>
            </thead class="thead-dark">
            <tbody>
                @forelse($transactions as $transaction)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $transaction->product_id }}</td>
                        <td>
                            {{ $transaction->product_name ?? 'Unknown' }} {{-- Assumes product_name exists or is joined --}}
                        </td>
                        <td>{{ $transaction->quantity }}</td>
                        <td>${{ number_format($transaction->total_price, 2) }}</td>
                        <td class="text-muted">{{ $transaction->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No transactions found.</td>
                    </tr>
                @endforelse
            </tbody>

            </table>

            @if ($transactions->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $transactions->links() }}
                </div>
            @endif
        </div>
    </div>

    @include('admin.js')
</body>
</html>
