@extends('layouts.customer')

@section('title')
    {{ $product->name }}
@endsection

<style>
    /* rating */
    .rating-css div {
        color: orange;
        font-size: 20px;
        font-family: sans-serif;
    }

    .rating-css input {
        display: none;
    }

    .rating-css input:checked+label~label {
        color: #b4afaf;
        cursor: pointer;
    }

    .rating-css label:active {
        transform: scale(0.8);
        transition: 0.3s ease;
    }

    .checked {
        color: orange;
    }

    /* End of Star Rating */
</style>

@section('content')
    <style>
        .product {
            background-color: #eee;
        }

        .act-price {
            color: red;
            font-weight: 700;
        }

        .about {
            font-size: 14px;
        }





        .might-like-section {
            padding: 40px 0 70px;
            background: #F5F5F5;
        }

        .might-like-section h2 {
            padding-bottom: 30px;
        }

        .might-like-section .might-like-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            grid-gap: 30px;
        }

        .might-like-section .might-like-product {
            border: 1px solid #979797;
            background: white;
            padding: 30px 0 20px;
            text-align: center;
            text-decoration: none;
        }

        .might-like-section .might-like-product img {
            width: 70%;
        }

        .might-like-section .might-like-product-price {
            color: #919191;
        }
    </style>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Product Detail</h4>
                        <div class="breadcrumb__links">
                            <a href="/">Home</a>
                            <a href="/shop">Shop</a>
                            <span>Product Detail</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <div class="container mt-2 mb-5">
        <div class="row d-flex justify-content-center">
            <h2 class="text-center my-1">Product Details</h2>


            <div class="col-md-10">
                <div class="card">
                    <form action="/add-to-cart" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="images mt-4">
                                    <div class="text-center">
                                        <img src="{{ asset('assets/images/products/' . $product->image) }}"
                                            alt="productimage" Height="250px">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="product p-4">
                                    <div>
                                        @if ($product->trending == '1')
                                            <label style="font-size:16px;"
                                                class="float-end badge bg-danger">Trending</label>
                                        @endif
                                        <h3 class="text-uppercase my-2">
                                            {{ $product->name }}
                                        </h3>

                                        <hr>

                                        <label class="me-3">Original
                                            Price : <s>RS {{ $product->original_price }}</s></label>
                                        <label class="fw-bold">Selling Price : Rs
                                            {{ $product->selling_price }}</label>
                                        @php
                                            $rating_num = number_format($rating_value);
                                        @endphp

                                        <div class="rating">
                                            @for ($i = 1; $i <= $rating_num; $i++)
                                                <i class="fa fa-star checked"></i>
                                            @endfor
                                            @for ($j = $rating_num; $j < 5; $j++)
                                                <i class="fa fa-star"></i>
                                            @endfor
                                            <span>
                                                @if ($rating->count() > 0)
                                                    {{ $rating->count() }} Ratings
                                                @else
                                                    No Rating
                                                @endif
                                            </span>
                                        </div>
                                        <p class="mt-1">
                                            {{ $product->short_description }}
                                        </p>
                                        <div>
                                            @if ($product->qty > 0)
                                                <label class="badge bg-success">In Stock</label>
                                            @else
                                                <label class="badge bg-danger">Out Of Stock</label>
                                            @endif
                                        </div>
                                        <div class="mt-2">
                                            <label for="Quantity">Quantity</label>

                                            <div class="input-group text-center" style="width: 130px;">
                                                <button class="input-group-text decrement-btn">-</button>
                                                <input type="text" value="1" name="quantity"
                                                    class="form-control qty-input text-center">
                                                <button class="input-group-text increment-btn">+</button>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($product->qty > 0)
                                        <div class="cart mt-3 align-items-center">

                                            <input type="hidden" name="id" value="{{ $product->id }}">
                                            <button class="btn btn-primary btn-sm text-uppercase" type="submit">Add To
                                                Cart</button>
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </form>
                </div>

                <div class="my-3">
                    <h3 class="fw-bold">Description</h3>
                    <p>{{ $product->description }}</p>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <h4 class="fw-bold">Rate this product : </h4>
                        <form action="/add-rating" method="POST">
                            @csrf
                            <input type="hidden" name="prod_id" value="{{ $product->id }}">
                            <div class="rating-css">
                                <div class="star-icon">
                                    @if ($user_rating)
                                        @for ($i = 1; $i <= $user_rating->stars_rated; $i++)
                                            <input type="radio" value="{{ $i }}" name="product_rating" checked
                                                id="rating{{ $i }}">
                                            <label for="rating{{ $i }}" class="fa fa-star"></label>
                                        @endfor
                                        @for ($j = $user_rating->stars_rated + 1; $j <= 5; $j++)
                                            <input type="radio" value="{{ $j }}" name="product_rating"
                                                id="rating{{ $j }}">
                                            <label for="rating{{ $j }}" class="fa fa-star"></label>
                                        @endfor
                                    @else
                                        <input type="radio" value="1" name="product_rating" checked id="rating1">
                                        <label for="rating1" class="fa fa-star"></label>
                                        <input type="radio" value="2" name="product_rating" id="rating2">
                                        <label for="rating2" class="fa fa-star"></label>
                                        <input type="radio" value="3" name="product_rating" id="rating3">
                                        <label for="rating3" class="fa fa-star"></label>
                                        <input type="radio" value="4" name="product_rating" id="rating4">
                                        <label for="rating4" class="fa fa-star"></label>
                                        <input type="radio" value="5" name="product_rating" id="rating5">
                                        <label for="rating5" class="fa fa-star"></label>
                                    @endif

                                    <button type="submit" class="btn btn-success btn-sm">Submit Rating</button>
                                </div>
                            </div>

                        </form>
                        <div>
                            <a href="/add-review/{{ $product->slug }}/user-review"> <button
                                    class="btn btn-primary btn-sm"> Add a
                                    review</button></a>
                        </div>
                    </div>
                    <div class="col-md-9 mt-3">
                        @foreach ($reviews as $review)
                            <div class="user_review">
                                <b><label for="" style="text-decoration: underline;">{{ $review->user->name }}</label></b>
                                <br>

                                @php
                                    $rating = App\Models\Rating::where('prod_id', $product->id)
                                        ->where('user_id', $review->user_id)
                                        ->first();
                                @endphp

                                @if ($rating)
                                    @php
                                        $user_rated = $rating->stars_rated;
                                    @endphp

                                    @for ($i = 1; $i <= $user_rated; $i++)
                                        <i class="fa fa-star checked"></i>
                                    @endfor
                                    @for ($j = $user_rated; $j < 5; $j++)
                                        <i class="fa fa-star"></i>
                                    @endfor
                                @endif
                                <small>Reviewed on {{ $review->created_at->format('d M Y') }}</small>
                                <p>
                                    {{ $review->user_review }}
                                    @if ($review->user_id == Auth::id())
                                        <a href="/edit-review/{{ $product->slug }}/user-review" class="float-end">Edit</a>
                                    @endif
                                </p>

                            </div>
                        @endforeach
                    </div>
                </div>





            </div>

        </div>
    </div>


    {{-- <div class="might-like-section">
        <div class="container">
            <h2>You might also like...</h2>
            <div class="might-like-grid">
                @foreach ($mightAlsoLike as $product)
                    <a href="/shop/{{ $product->id }}" class="might-like-product">
                        <img src="{{ asset('images/products/' . $product->image) }}" alt="product" height="100px"
                            width="100px">
                        <div class="might-like-product-name">{{ $product->name }}</div>
                        <div class="might-like-product-price">{{ $product->price }}</div>
                    </a>
                @endforeach

            </div>
        </div>
    </div> --}}
@endsection


@section('scripts')
    <script>
        $(document).ready(function() {
            $('.increment-btn').click(function(e) {
                e.preventDefault();

                var inc_value = $('.qty-input').val();
                var value = parseInt(inc_value, 10);
                value = isNaN(value) ? 0 : value;

                if (value < 10) {
                    value++;
                    $('.qty-input').val(value);
                }
            });

            $('.decrement-btn').click(function(e) {
                e.preventDefault();

                var inc_value = $('.qty-input').val();
                var value = parseInt(inc_value, 10);
                value = isNaN(value) ? 0 : value;

                if (value > 1) {
                    value--;
                    $('.qty-input').val(value);
                }
            });
        });
    </script>
@endsection
