<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->

    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/mdb.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/admin.min.css') }}" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>


</head>

<body>
    <div id="app">
        <!--Main Navigation-->
        <header>
            <!-- Navbar -->
            <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
                <div class="container">

                    <img src="{{ asset('assets/images/logo2.PNG') }}" alt="" class="navbar-brand waves-effect">

                    <!-- Collapse -->
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <!-- Links -->
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
                                <a href="/dashboard" class="nav-link waves-effect">Dashboard</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="" class="nav-link waves-effect">Homepage</a>
                            </li> --}}
                            <li class="nav-item {{ Request::is('categories') ? 'active' : '' }}">
                                <a href="/categories" class="nav-link waves-effect">Categories</a>
                            </li>
                            <li class="nav-item {{ Request::is('products') ? 'active' : '' }}">
                                <a href="/products" class="nav-link waves-effect">Products</a>
                            </li>
                            <li class="nav-item {{ Request::is('orders') ? 'active' : '' }}">
                                <a href="/orders" class="nav-link waves-effect">Orders</a>
                            </li>
                            <li class="nav-item {{ Request::is('users') ? 'active' : '' }}">
                                <a href="/users" class="nav-link waves-effect">Users</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link waves-effect" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                                         document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Navbar -->

            <!-- Sidebar -->
            <div class="sidebar-fixed position-fixed">
                <h1 class="logo-wrapper waves-effect">Admin Dashboard</h1>

                <div class="list-group list-group-flush">
                    <ul style="list-style-type: none;">
                        <li>
                            <a href="/dashboard"
                                class="btn btn-primary mb-2 {{ Request::is('dashboard') ? 'active' : '' }}">Dashboard</a>
                        </li>
                        {{-- <li>
                            <a href="" class="list-group-item active waves-effect mb-2">Homepage</a>
                        </li> --}}
                        <li>
                            <a href="/categories"
                                class="btn btn-primary waves-effect mb-2 {{ Request::is('categories') ? 'active' : '' }}">Categories</a>
                        </li>
                        <li>
                            <a href="/products"
                                class="btn btn-primary waves-effect mb-2 {{ Request::is('products') ? 'active' : '' }}">Products</a>
                        </li>
                        <li>
                            <a href="/orders"
                                class="btn btn-primary waves-effect mb-2 {{ Request::is('orders') ? 'active' : '' }}">Orders</a>
                        </li>
                        <li>
                            <a href="/users"
                                class="btn btn-primary waves-effect mb-2 {{ Request::is('users') ? 'active' : '' }}">Users</a>
                        </li>
                        <li>
                            <a class="btn btn-primary waves-effect mb-2" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                                         document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Sidebar -->
        </header>

        <!--Main layout-->

        <main class="py-4">
            <div class="container-fluid mt-5">
                @yield('content')
            </div>
        </main>



    </div>



    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/mdb.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    @if (session('status'))
        <script>
            swal("{{ session('status') }}");
        </script>
    @endif


</body>

</html>
