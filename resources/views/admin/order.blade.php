<!DOCTYPE html>
<html>
  <head>

    @include('admin.css')

    <style>
        table {
            border: 1px solid white;
            margin: auto;
            margin-top: 20px;
            width: 100%;
            text-align: center;
            border-collapse: collapse;
        }

        th {
            background: #DCDCDC;
            color: black;
            padding: 10px;
        }

        td {
            color: white;
            padding: 10px;
        }

        .btn {
            padding: 8px 12px;
            font-size: 14px;
            margin: 5px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-info {
            background-color: #17a2b8;
            color: white;
        }

        .btn-warning {
            background-color: #ffc107;
            color: white;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        td .btn {
            white-space: nowrap;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
        }

        .button-group .btn {
            margin-right: 10px;
        }

        .button-group .btn:last-child {
            margin-right: 0;
        }
    </style>

  </head>
  <body>
    @include('admin.header')

    @include('admin.sidebar')

    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">

                <table>
                    <tr>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Coffee Title</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Delivery Status</th>
                    </tr>

                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->email }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->address }}</td>
                        <td>{{ $order->title }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>${{ number_format($order->price, 2) }}</td>
                        <td><img src="coffee_img/{{ $order->image }}" alt="Order Image" style="width: 100px;"></td>
                        <td>{{ $order->delivery_status }}</td>

                        <td>
                            <div class="button-group">
                                <a class="btn btn-info" href="{{ url('on_the_way',$order->id)}}">On the Way</a>
                                <a class="btn btn-warning" href="{{ url('delivered',$order->id)}}">Delivered</a>
                                <a class="btn btn-danger" href="{{ url('canceled',$order->id)}}">Cancel</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </table>

            </div>
        </div>
    </div>

    <!-- JavaScript files-->
    @include('admin.js')

  </body>
</html>
