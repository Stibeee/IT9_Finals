<!DOCTYPE html>
<html lang="en">
<head>
    @include('home.css')

    <style>
        body {
            background: #23272b;
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        .order-container {
            background: #181a1b;
            border-radius: 18px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            padding: 40px 30px 30px 30px;
            margin: 40px auto 0 auto;
            max-width: 1100px;
        }
        h2.mb-4 {
            color: #fff;
            letter-spacing: 1px;
            font-weight: 700;
            margin-bottom: 32px !important;
        }
        table {
            border-radius: 12px;
            overflow: hidden;
            width: 100%;
            background: #23272b;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        th, td {
            padding: 18px 14px;
            text-align: center;
        }
        th {
            background: #111315;
            color: #f8f9fa;
            font-size: 1.08rem;
            border-bottom: 2px solid #343a40;
            letter-spacing: 0.5px;
        }
        td {
            color: #e9ecef;
            font-size: 1.01rem;
            border-bottom: 1px solid #343a40;
            vertical-align: middle;
        }
        tr:last-child td {
            border-bottom: none;
        }
        tr:hover {
            background: #2c3035;
            transition: background 0.2s;
        }
        .order-image {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #444;
            background: #fff;
        }
        .status-badge {
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.90rem;
            display: inline-block;
            letter-spacing: 0.5px;
        }
        .status-delivered {
            background-color: #28a745;
            color: white;
        }
        .status-processing {
            background-color: #ffc107;
            color: #23272b;
        }
        .status-pending {
            background-color:rgb(0, 0, 0);
            color: white;
        }
        .empty-orders {
            padding: 60px 20px;
            text-align: center;
            color: #fff;
        }
        .empty-orders img {
            width: 180px;
            margin-bottom: 30px;
            opacity: 0.85;
        }
        .empty-orders h3 {
            margin-bottom: 20px;
            color: #ddd;
            font-weight: 500;
        }
        .shop-btn {
            background-color: #dc3545;
            color: white;
            padding: 12px 28px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.05rem;
            transition: all 0.2s ease;
            box-shadow: 0 2px 8px rgba(220,53,69,0.08);
        }
        .shop-btn:hover {
            background-color: #c82333;
            transform: translateY(-2px) scale(1.04);
            color: #fff;
        }
        @media (max-width: 900px) {
            .order-container { padding: 18px 5px; }
            table, th, td { font-size: 0.98rem; }
            .order-image { width: 60px; height: 60px; }
        }
        @media (max-width: 600px) {
            .order-container { padding: 8px 0; }
            table, th, td { font-size: 0.93rem; }
            .order-image { width: 40px; height: 40px; }
        }
    </style>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">
    <br><br><br><br>
    
<nav class="custom-navbar navbar navbar-expand-lg navbar-dark fixed-top" data-spy="affix" data-offset-top="10">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-light" style="margin: 50px 0 0 50px; border-radius: 5px; font-weight: 1000; font-size: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); transition: background 0.2s;">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                </li>
    </nav>
     <br>
    <div id="gallery" class="text-center bg-dark text-light has-height-md middle-items wow fadeIn">
        <div class="order-container">
            <h2 class="mb-4">My Orders</h2>

            @if(count($orders) == 0)
                <div class="empty-orders">
                    <img src="assets/imgs/empty-order.png" alt="No Orders">
                    <h3>You haven't placed any orders yet!</h3>
                    <a href="{{ url('/') }}" class="shop-btn">
                        <i class="fa fa-shopping-cart"></i> Start Shopping
                    </a>
                </div>
            @else
                <table>
                    <tr>
                        <th>Order</th>
                        <th>Detail</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Status</th>
                    </tr>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->title }}</td>
                            <td>{{ $order->detail ?? '-' }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>₱{{ number_format($order->price * $order->quantity, 2) }}</td>
                            <td>
                                @php
                                    $imgFolder = (str_contains(strtolower($order->title), 'coffee')) ? 'coffee_img/' : 'food_img/';
                                @endphp
                                <img class="order-image" src="{{ $imgFolder . $order->image }}" alt="Order Image">
                            </td>
                            <td>
                                <span class="status-badge {{ $order->delivery_status == 'delivered' ? 'status-delivered' : ($order->delivery_status == 'processing' ? 'status-processing' : 'status-pending') }}">
                                    {{ ucfirst($order->delivery_status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <br>
            @endif
        </div>
        <br><br> <br><br>
    </div>
</body>
</html>