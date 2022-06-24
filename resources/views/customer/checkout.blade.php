@extends('layouts.customer')

@section('title')
    Checkout
@endsection

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Check Out</h4>
                        <div class="breadcrumb__links">
                            <a href="/">Home</a>
                            <a href="/shop">Shop</a>
                            <span>Check Out</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                @php
                    $totalprice = 0;
                @endphp
                <form action="/create-order" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-7 col-md-6">
                            <h6 class="checkout__title">Billing Details</h6>

                            <div class="checkout__input">
                                <p>Name<span>*</span></p>
                                <input type="text" name="name" required value="{{ Auth::user()->name }}">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" name="phone" required value="{{ Auth::user()->phone }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="email" name="email" required value="{{ Auth::user()->email }}">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" placeholder="Street Address" required class="checkout__input__add"
                                    name="address" value="{{ Auth::user()->address }}">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Country<span>*</span></p>
                                        <input type="text" name="country" required value="{{ Auth::user()->country }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>City<span>*</span></p>
                                        <input type="text" name="city" required value="{{ Auth::user()->city }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>State<span>*</span></p>
                                        <input type="text" name="state" required value="{{ Auth::user()->state }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Postcode / ZIP<span>*</span></p>
                                        <input type="text" name="code" required value="{{ Auth::user()->code }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6">

                            <div class="checkout__order">
                                <h4 class="order__title fw-bold">Your order</h4>
                                <div class="checkout__order__products fw-bold">Product <span>Total</span></div>

                                <ul class="checkout__total__products">
                                    @foreach ($cartItems as $item)
                                        <li>{{ $item->products->name }}<span>Rs
                                                {{ $item->products->selling_price * $item->prod_qty }}</span></li>
                                        @php
                                            $totalprice = $totalprice + $item->products->selling_price * $item->prod_qty;
                                        @endphp
                                    @endforeach
                                </ul>
                                <ul class="checkout__total__all">
                                    <li>Subtotal <span>Rs : {{ $totalprice }}</span></li>
                                    <li>Total <span>Rs : {{ $totalprice }}</span></li>
                                </ul>
                                {{-- <div class="checkout__input__checkbox">
                                    <label for="COD">
                                        Cash On Delivery
                                        <input type="checkbox" id="COD" name="COD">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="stripe">
                                        Stripe payment
                                        <input type="checkbox" id="stripe" name="stripe">
                                        <span class="checkmark"></span>
                                    </label>
                                </div> --}}

                                <button type="submit" class="site-btn">PLACE ORDER</button>

                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection
