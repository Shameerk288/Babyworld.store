<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/customer.css') }}" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <style>
        .ui-menu {
            z-index: 3500 !important;
        }
    </style>


</head>

<body>
    @php
        $totalprice = 0;
    @endphp
    <div id="app">
        <!-- Offcanvas Menu Begin -->
        <div class="offcanvas-menu-overlay"></div>
        <div class="offcanvas-menu-wrapper">
            <div class="offcanvas__option">
                <div class="offcanvas__links">
                    @guest
                        @if (Route::has('login'))
                            <a href="/login">Sign in</a>
                        @endif
                        @if (Route::has('register'))
                            <a href="/register">Register</a>
                        @endif
                    @else
                        <a href="#">
                            {{ Auth::user()->name }}
                        </a>
                        <a href="/my-orders">
                            My Orders
                        </a>

                        <a href="/logout"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="/logout" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endguest
                </div>
            </div>
            <div class="offcanvas__nav__option">
                <a href="/cart"><img src="{{ asset('assets/images/icon/cart.png') }}" alt=""
                        style="width:26px;">
                    <span style="color: red;font-size:14px;">{{ Cart::count() }}</span>
                </a>
                <div class="price">RS : </div>
            </div>
            <div id="mobile-menu-wrap"></div>
            <div class="offcanvas__text">
                <p>Free shipping, 30-day return or refund guarantee.</p>
            </div>
        </div>
        <!-- Offcanvas Menu End -->

        <!-- Header Section Begin -->
        <header class="header">
            <div class="header__top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-7">
                            <div class="header__top__left">
                                <p>Free shipping, 30-day return or refund guarantee.</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-5">
                            <div class="header__top__right">
                                <div class="header__top__links">
                                    @guest
                                        @if (Route::has('login'))
                                            <a href="/login">Sign in</a>
                                        @endif
                                        @if (Route::has('register'))
                                            <a href="/register">Register</a>
                                        @endif
                                    @else
                                        <a href="#">
                                            {{ Auth::user()->name }}
                                        </a>
                                        <a href="/my-orders">
                                            My Orders
                                        </a>

                                        <a href="/logout"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="/logout" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-2">
                        <div class="header__logo">
                            <a href="/"><img src="{{ asset('assets/images/logo.JPG') }}" alt="Company Logo"></a>

                        </div>
                    </div>

                    <div class="col-lg-5 col-md-5">
                        <nav class="header__menu mobile-menu">
                            <ul>
                                <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="/">Home</a></li>
                                <li class="{{ Request::is('shop') ? 'active' : '' }}"><a href="/shop">Shop</a>
                                </li>
                                <li class="{{ Request::is('cart') ? 'active' : '' }}"><a href="/cart">Cart</a>
                                </li>
                                <li class="{{ Request::is('about') ? 'active' : '' }}"><a href="/about">About
                                        Us</a>
                                </li>
                                <li class="{{ Request::is('contact') ? 'active' : '' }}"><a
                                        href="/contact">Contact</a></li>
                            </ul>
                        </nav>
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <form action="searchproduct" method="POST">
                            @csrf
                            <div class="input-group mt-4">
                                <input type="search" id="search_product" name="product_name" required class="form-control" placeholder="Search"
                                    aria-label="Search" aria-describedby="basic-addon1">
                                <button class="input-group-text" type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>

                    <div class="col-lg-2 col-md-2">
                        <div class="header__nav__option">

                            <a href="/cart"><img src="{{ asset('assets/images/icon/cart.png') }}" alt=""
                                    style="width:26px;">
                                <span style="color: red;font-weight:bold;font-size:15px;">
                                    @if (Auth::check())
                                        {{ $cartCount }}
                                    @else
                                        0
                                    @endif

                                </span>
                            </a>

                            @if (Auth::check())
                                @foreach ($cart_items as $item)
                                    @php
                                        $totalprice = $totalprice + $item->products->selling_price * $item->prod_qty;
                                    @endphp
                                @endforeach
                                <div class="price">RS : {{ $totalprice }}</div>
                            @else
                                <div class="price">RS : 0</div>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="canvas__open"><i class="fa fa-bars"></i></div>
            </div>
        </header>
        <!-- Header Section End -->

        <main>
            @yield('content')
        </main>


        <!-- Footer Section Begin -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h4 style="color: white;">Babyworld.store</h4>
                        <div class="footer__copyright__text">
                            <p>
                                Copyright ©
                                2022
                                All rights reserved
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        {{-- <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="footer__about">
                            <div class="footer__logo">
                                <h3 style="color: white;">Babyworld.store</h3>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                        <div class="footer__widget">
                            <h6>Shopping</h6>
                            <ul>
                                <li><a href="#">Clothing Store</a></li>
                                <li><a href="#">Trending Shoes</a></li>
                                <li><a href="#">Accessories</a></li>
                                <li><a href="#">Sale</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-6">
                        <div class="footer__widget">
                            <h6>Shopping</h6>
                            <ul>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Payment Methods</a></li>
                                <li><a href="#">Delivary</a></li>
                                <li><a href="#">Return & Exchanges</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="footer__copyright__text">
                            <p>Copyright © 2022.All rights reserved
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer> --}}
        <!-- Footer Section End -->
    </div>



    <!-- Js Plugins -->

    <script src="{{ asset('assets/jquery/jquery-3.6.0.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

    <script>
        $(function() {
            var availableTags = [];
            $.ajax({
                method: "GET",
                url: "/product-list",
                success: function(response) {
                    console.log(response);
                    startAutoComplete(response);
                }
            });

            function startAutoComplete(availableTags) {
                $("#search_product").autocomplete({
                    source: availableTags
                });
            }

        });
    </script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    @if (session('status'))
        <script>
            swal("{{ session('status') }}");
        </script>
    @endif

    @yield('scripts')
</body>

</html>
