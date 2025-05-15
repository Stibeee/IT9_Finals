
<!DOCTYPE html>
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
                    <a class="nav-link" href="{{ ('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#gallery">Gallery</a>
                </li>

            </ul>
            <a class="m-auto navbar-brand" href="{{ ('/') }}">
                <img src="assets/imgs/logo.svg" class="brand-img" alt="">
                <span class="brand-txt">Espreo Brew</span>
            </a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#blog">Coffee<span class="sr-only">(current)</span></a>
                </li>

                @if (Route::has('login'))
                    @auth

                        <li class="nav-item">
            <a class="nav-link position-relative" href="{{ url('my_cart') }}">
                <i class="fa fa-shopping-cart" style="font-size: 1.5rem;"></i>
                <span class="top-0 position-absolute start-100 translate-middle badge rounded-pill bg-danger">
                    {{ session('cart') ? count(session('cart', [])) : 0 }}
                    <span class="visually-hidden">items in cart</span>
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

        <table>
            <tr>
                <th>Coffee Title</th>
                <th>Coffee Detail</th>
                <th>Coffee Quantity</th>
                <th>Coffee Price</th>
                <th>Coffee Image</th>
                <th>Action</th>
            </tr>

            @php
                $total_price = 0;
            @endphp

            @foreach ($coffee as $coffees)
            <tr>
                <td>{{ $coffees->coffee_title }}</td>
                <td>{{ $coffees->detail }}</td>
                <td>{{ $coffees->quantity }}</td>
                <td>${{ number_format($coffees->price, 2) }}</td>
                <td>
                    <img src="coffee_img/{{ $coffees->image }}" alt="Coffee Image" width="100">
                </td>
                <td>
                    <a href="{{ url('remove_cart', $coffees->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to remove this item?')">
                                <i class="fa fa-trash"></i>
                </td>
            </tr>

            @endforeach
        </table>

                    </div>

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

                            <form action="{{ url('confirm_order') }}" method="post">
                                @csrf

                                @php $total_price = 0; @endphp

                                @foreach ($coffee as $coffees)
                                    <input type="hidden" name="coffee_id[]" value="{{ $coffees->id }}">
                                    <input type="hidden" name="coffee_title[]" value="{{ $coffees->coffee_title }}">
                                    <input type="hidden" name="quantity[]" value="{{ $coffees->quantity }}">
                                    <input type="hidden" name="price[]" value="{{ $coffees->price }}">
                                    <input type="hidden" name="image[]" value="{{ $coffees->image }}">
                                    @php $total_price += $coffees->price; @endphp
                                @endforeach

                                <div class="form-group">
                                    <label for="name" class="text-dark fw-bold">Name:</label>
                                    <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                                </div>

                                <div class="form-group">
                                    <label for="email" class="text-dark fw-bold">Email:</label>
                                    <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}">
                                </div>

                                <div class="form-group">
                                    <label for="phone" class="text-dark fw-bold">Phone:</label>
                                    <input type="number" class="form-control" name="phone" value="{{ Auth::user()->phone }}">
                                </div>

                                <div class="form-group">
                                    <label for="address" class="text-dark fw-bold">Address:</label>
                                    <input type="text" class="form-control" name="address" value="{{ Auth::user()->address }}">
                                </div>

                                    <!-- Total Price Section -->
                                <div class="my-3 text-center rounded" style="background-color: white;">
                                    <h5 class="mb-1 text-dark fw-bold">Total Price:</h5>
                                    <p class="h5 text-dark fw-bold">${{ number_format($total_price, 2) }}</p>
                                </div>

                                <div class="mt-3 text-center form-group">
                                    <input class="btn" type="submit" value="Order Now" style="background-color: #28a745; color: white;">
                                </div>
                            </form>

                        </div>

