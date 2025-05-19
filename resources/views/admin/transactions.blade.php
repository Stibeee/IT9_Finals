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
                        <h2 class="no-margin-bottom">Transaction List</h2>
                    </div>
                </header>
                <div class="breadcrumb-holder container-fluid">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Transaction List</li>
                    </ul>
                </div>
                <section class="tables">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
        <div class="card">
                                    <div class="card-header d-flex align-items-center">
                                        <h3 class="h4">Transaction History</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
            <thead>
    <tr>
                                                        <th>Product Name</th>
        <th>Quantity</th>
                                                        <th>Price</th>
                                                        <th>Total</th>
                                                        <th>Customer</th>
                                                        <th>Date</th>
    </tr>
                                                </thead>
            <tbody>
                @forelse($transactions as $transaction)
                    <tr>
                                                            <td>{{ $transaction->product_name }}</td>
                        <td>{{ $transaction->quantity }}</td>
                                                            <td>₱{{ number_format($transaction->price, 2) }}</td>
                                                            <td>₱{{ number_format($transaction->total_price, 2) }}</td>
                                                            <td>{{ $transaction->user->name }}</td>
                                                            <td>{{ $transaction->created_at->format('M d, Y H:i:s') }}</td>
                    </tr>
                @empty
                    <tr>
                                                            <td colspan="6" class="text-center">No transactions found</td>
                    </tr>
                @endforelse
            </tbody>
            </table>
                                        </div>
                                        <div class="mt-4">
                    {{ $transactions->links() }}
                </div>
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
                                <p><a href="#" class="external">Espresso Brew</a></p>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    @include('admin.js')
</body>
</html>
