  <!-- Navbar -->
   @php
    use App\Models\Cart;
    $cartCount = auth()->check() ? Cart::where('user_id', auth()->id())->sum('quantity') : 0;
@endphp
    <nav class="custom-navbar navbar navbar-expand-lg navbar-dark fixed-top" data-spy="affix" data-offset-top="10">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#gallary">Gallery</a>
                </li>

            </ul>
            <a class="m-auto navbar-brand" href="{{ ('/') }}">
                <img src="assets/imgs/logo.png" class="brand-img" alt="">
                <span class="brand-txt">Espreso Brew</span>
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
                        <a class="nav-link" href="{{ url('my_orders') }}">My Orders</a>
                    </li>

                  <li class="nav-item">
                        <a class="nav-link position-relative" href="{{ url('my_cart') }}">
                            <i class="fa fa-shopping-cart" style="font-size: 1.5rem;"></i>
                            <span class="top-0 position-absolute start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $cartCount }}
                                <span class="visually-hidden"></span>
                            </span>
                        </a>
                    </li>
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
    <!-- header -->
    <header id="home" class="header">
        <div class="text-center text-white overlay">
            <h1 class="my-3 display-2 font-weight-bold">Espereso Brew</h1>
            <h2 class="mb-5 display-4">We serve the richest coffee in  the city!</h2>
            <a class="btn btn-lg btn-primary" href="#gallary">View Our gallery</a>
        </div>
    </header>
