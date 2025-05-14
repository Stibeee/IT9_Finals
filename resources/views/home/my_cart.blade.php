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
                    <a class="nav-link" href="#gallery">Gallary</a>
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
                        <a class="nav-link" href="{{ ('my_cart') }}">
                            <i class="bi bi-cart"></i>
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

<div class="p-4 bg-gray-100 rounded-xl w-fit">
    <h3 class="text-lg text-gray-700">Total Price:</h3>
    <p class="text-2xl font-bold text-green-600">₱{{ number_format($total_price, 2) }}</p>
</div>
@endif
</div>

</body>
</html>
