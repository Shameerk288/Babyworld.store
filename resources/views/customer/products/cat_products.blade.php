@extends('layouts.customer')

@section('title')
    {{ $category->name }}
@endsection

<style>
    /* rating */
    .rating-css div {
        /* color: orange; */
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
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shop</h4>
                        <div class="breadcrumb__links">
                            <a href="/">Home</a>
                            <a href="/shop">Shop</a>
                            <a href="/shop/category">Categories</a>
                            <span>{{ $category->name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <div class="container py-3">
        <div class="row">

            <div class="col-lg-2">
                <a href="/shop"><button type="submit" class="btn btn-link">ALL Products</button>
                </a>
                @foreach ($categories as $item)
                    <a href="/shop/category/{{ $item->slug }}"><button type="submit"
                            class="btn btn-link">{{ $item->name }}</button>
                    </a>
                    <br>
                @endforeach
            </div>

            <div class="col-lg-10">
                <div class="row">
                    <h2>{{ $category->name }}</h2>
                    @foreach ($products as $product)
                        @if ($product->count() > 0)
                            <div class="col-xl-4 col-lg-4 col-md-6">
                                <div class="card mt-3">
                                    <a href="/shop/{{ $product->slug }}" class="mx-auto">
                                        <img src="{{ asset('assets/images/products/' . $product->image) }}"
                                            alt="Product Image" Height="150px" Width="150px">
                                    </a>

                                    <div class="card-body">
                                        <a href="/shop/{{ $product->slug }}">
                                            <h5 class="fw-bold">{{ Str::limit($product->name, 23) }}</h5>
                                        </a>
                                        <p class="card-text">{{ $product->selling_price }}</p>

                                        <div class="rating-css mb-3">
                                            <div class="star-icon">

                                                @php
                                                    $total_rating = 0;
                                                    $rating_count = 0;
                                                    $rating_num = 0;
                                                @endphp

                                                @foreach ($ratings as $rating)
                                                    @if ($product->id == $rating->prod_id)
                                                        @php
                                                            $total_rating = $total_rating + $rating->stars_rated;
                                                            $rating_count = App\Models\Rating::where('prod_id', $product->id)->count();
                                                            $rating = $total_rating / $rating_count;
                                                            if ($rating > 0) {
                                                                $rating_num = number_format($rating);
                                                            } else {
                                                                $rating_num = 0;
                                                            }
                                                            
                                                        @endphp
                                                    @else
                                                    @endif
                                                @endforeach

                                                {{-- <p>{{ $total_rating }}</p>
                                            <p>{{ $rating_count }}</p>
                                            <p>{{ $rating_num }}</p> --}}

                                                @for ($i = 1; $i <= $rating_num; $i++)
                                                    <i class="fa fa-star checked"></i>
                                                @endfor
                                                @for ($j = $rating_num; $j < 5; $j++)
                                                    <i class="fa fa-star"></i>
                                                @endfor

                                                <span>
                                                    @if ($rating_count > 0)
                                                        ({{ $rating_count }})
                                                    @else
                                                        Not Rated
                                                    @endif
                                                </span>
                                            </div>
                                        </div>




                                        <a href="#" class="btn btn-primary">Add To Cart</a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <h2>No Products Found</h2>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
