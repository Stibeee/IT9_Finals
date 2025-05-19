<html lang="en">
<head>
    @include('home.css')


    <style>
        table {
            border: 1px solid white;
            margin: 40px;
            padding: 40px;
        }

        th {
            padding: 10px;
            text-align: center;
            background-color:black;
            color: white;
            font-weight: bold;
        }

        td {
            padding: 10px;
            text-align: center;
            color: white;
        }

        .div_center {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;

        }

        label
        {
            display: inline-block;
            width: 200px;

        }

        .div_deg
        {
            padding: 10px;
            text-align: center;

        }

    </style>

    </head>
    <body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">
        <br> <br> <br> <br>

    <!-- Navbar -->
    <nav class="custom-navbar navbar navbar-expand-lg navbar-dark fixed-top" data-spy="affix" data-offset-top="10">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#gallery">Gallery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('my_orders') }}">My Orders</a>
                </li>
            </ul>
            <a class="m-auto navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('assets/imgs/logo.png') }}" class="brand-img" alt="">
                <span class="brand-txt">Espreo Brew</span>
            </a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#blog">Coffee<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#food">Food<span class="sr-only">(current)</span></a>
                </li>

                @if (Route::has('login'))
                    @auth

        <li class="nav-item">
            <a class="nav-link position-relative" href="{{ url('my_cart') }}">
                <i class="fa fa-shopping-cart" style="font-size: 1.5rem;"></i>
                <span class="top-0 position-absolute start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $cart_items->sum('quantity') }}
                    <span class="visually-hidden"></span>
                </span>
            </a>
        </li>

                                <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <input class="btn btn-primary ml-xl-4 " type="submit" value="Logout">
                        </form>


                     @else


                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>


                <li class="nav-item">
                    <a class="nav-link" href="{{ route(name: 'register') }}">Register</a>
                </li>

                   @endauth
                    @endif


            </ul>
        </div>
    </nav>
    <div id="gallery" class="text-center bg-dark text-light has-height-md middle-items wow fadeIn">

    @if($cart_items->isEmpty())
        <div class="p-4">
            <h3 class="text-white">Your cart is empty</h3>
            <a href="{{ url('/') }}" class="btn btn-primary mt-3">Continue Shopping</a>
        </div>
    @else
        <table>
            <tr>
                <th>Title</th>
                <th>Detail</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Image</th>
                <th>Action</th>
            </tr>

            <?php
        $total_price = 0;
        ?>

            @foreach ($cart_items as $item)
    <tr>
                <td>{{ $item->coffee_title ?? $item->food_title }}</td>
                <td>{{ $item->detail }}</td>
                <td>{{ $item->quantity }}</td>
                <td>₱{{ $item->price }}</td>
                <td>
                    @if($item->coffee_title)
                        <img width="150" src="coffee_img/{{ $item->image }}" alt="Coffee Image">
                    @else
                        <img width="150" src="food_img/{{ $item->image }}" alt="Food Image">
                    @endif
                </td>
                <td>
                    <a onclick="return confirm('Are you sure you want to remove this?')" class="btn btn-danger" href="{{ url('remove_cart', $item->id) }}">Remove</a>
                </td>
            </tr>

            <?php
        $total_price += $item->price;
    ?>
    @endforeach
        </table>

                    <div class="div_center">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#orderModal">
                            View Order Details
                        </button>
                    </div>

                <!-- Modal -->
            <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h5 class="text-black modal-title" id="orderModalLabel">Order Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                        <form action="{{ route('confirm_order') }}" method="post">
                                    @csrf

                                    @foreach ($cart_items as $item)
                                        <input type="hidden" name="item_id[]" value="{{ $item->id }}">
                                        <input type="hidden" name="title[]" value="{{ $item->coffee_title ?? $item->food_title }}">
                                        <input type="hidden" name="quantity[]" value="{{ $item->quantity }}">
                                        <input type="hidden" name="price[]" value="{{ $item->price }}">
                                        <input type="hidden" name="image[]" value="{{ $item->image }}">
                                    @endforeach

                                    <!-- Customer info fields here -->
                                    <div class="form-group">
                                        <label for="name" class="text-dark fw-bold">Name:</label>
                                    <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="text-dark fw-bold">Email:</label>
                                    <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone" class="text-dark fw-bold">Phone:</label>
                                    <input type="number" class="form-control" name="phone" value="{{ Auth::user()->phone }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="address" class="text-dark fw-bold">Address:</label>
                                    <input type="text" class="form-control" name="address" value="{{ Auth::user()->address }}" required>
                                </div>

                                <!-- Order Summary -->
                                <div class="mt-4">
                                    <h5 class="text-dark fw-bold">Order Summary</h5>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($cart_items as $item)
                                                <tr>
                                                    <td>{{ $item->coffee_title ?? $item->food_title }}</td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>₱{{ number_format($item->price, 2) }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="2">Total:</th>
                                                    <th>₱{{ number_format($total_price, 2) }}</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                                    <div class="mt-3 text-center form-group">
                                    <input class="btn" type="submit" value="Proceed to Payment" style="background-color: #28a745; color: white;">
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
</body>