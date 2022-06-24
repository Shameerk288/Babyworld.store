@extends('layouts.customer')

@section('title')
    {{-- {{ $category->name }} --}}
@endsection

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shopping Cart</h4>
                        <div class="breadcrumb__links">
                            <a href="/">Home</a>
                            <a href="/shop">Shop</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    @php
                        $totalprice = 0;
                    @endphp

                    <div class="shopping__cart__table">

                        @if ($cart_items->count() > 0)
                            <table>
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart_items as $item)
                                        <tr>

                                            <td class="product__cart__item">
                                                <div class="product__cart__item__pic">
                                                    <img src="{{ asset('assets/images/products/' . $item->products->image) }}"
                                                        alt="" height="50px" width="50px">
                                                </div>
                                                <div class="product__cart__item__text">
                                                    <h6>{{ $item->products->name }}</h6>
                                                    <h5>Rs {{ $item->products->selling_price }}</h5>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($item->products->qty > $item->prod_qty)
                                                    <div class="product_data">
                                                        <input type="hidden" value="{{ $item->prod_id }}"
                                                            class="prod_id">
                                                        <div class="input-group text-center" style="width: 120px;">
                                                            <button
                                                                class="input-group-text change-qty decrement-btn">-</button>
                                                            <input type="text" value="{{ $item->prod_qty }}"
                                                                name="quantity" class="form-control qty-input text-center">
                                                            <button
                                                                class="input-group-text change-qty increment-btn">+</button>
                                                        </div>
                                                    </div>
                                                @else
                                                    <h5>Out Of Stock</h5>
                                                @endif
                                            </td>
                                            @if ($item->products->qty >= $item->prod_qty)
                                                <td class="cart__price">Rs :
                                                    {{ $item->products->selling_price * $item->prod_qty }}</td>
                                            @else
                                                <td class="cart__price">Rs : 0
                                                </td>
                                            @endif
                                            <form action="/cart/{{ $item->id }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <td class="cart__close">
                                                    <button type="submit" style="border: none;">
                                                        <i class="fa fa-close"></i>
                                                    </button>
                                                </td>
                                            </form>

                                        </tr>
                                        @php
                                            $totalprice = $totalprice + $item->products->selling_price * $item->prod_qty;
                                        @endphp
                                    @endforeach
                                </tbody>
                            @else
                                <h2>Empty Cart</h2>
                        @endif
                        </table>



                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="/shop">Continue Shopping</a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4">
                    <div class="cart__total">
                        <h6>Cart total</h6>
                        <ul>
                            <li>Subtotal <span>Rs : {{ $totalprice }}</span></li>
                            <li>Total <span>Rs : {{ $totalprice }}</span></li>
                        </ul>
                        @if ($cart_items->count() > 0)
                            <a href="/checkout" class="primary-btn">Proceed to checkout</a>
                        @else
                            <button class="btn btn-dark px-4" style="border-radius: 0px;" disabled>PROCEED TO
                                CHECKOUT</button>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
@endsection


@section('scripts')
    <script>
        $(document).ready(function() {
            $('.increment-btn').click(function(e) {
                e.preventDefault();

                var inc_value = $(this).closest('.product_data').find('.qty-input').val();
                var value = parseInt(inc_value, 10);
                value = isNaN(value) ? 0 : value;

                if (value < 10) {
                    value++;
                    $(this).closest('.product_data').find('.qty-input').val(value);
                }
            });

            $('.decrement-btn').click(function(e) {
                e.preventDefault();

                var dec_value = $(this).closest('.product_data').find('.qty-input').val();
                var value = parseInt(dec_value, 10);
                value = isNaN(value) ? 0 : value;

                if (value > 1) {
                    value--;
                    $(this).closest('.product_data').find('.qty-input').val(value);
                }
            });

            $('.change-qty').click(function(e) {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var prod_id = $(this).closest('.product_data').find('.prod_id').val();
                var prod_qty = $(this).closest('.product_data').find('.qty-input').val();
                data = {
                    'prod_id': prod_id,
                    'prod_qty': prod_qty
                }

                $.ajax({
                    method: "POST",
                    url: "update-cart",
                    data: data,
                    success: function(response) {
                        window.location.reload();
                    }
                });
            });

        });
    </script>
@endsection
