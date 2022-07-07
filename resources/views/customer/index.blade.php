@extends('layouts.customer')

@section('title')
    Babyworld.store
@endsection

<style>
    /* rating */
    .rating-css div {
        /* color: orange; */
        font-size: 15px;
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
    <div style="background-color: whitesmoke;">
        <div class="container-fluid">
            <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel"
                data-bs-interval="3000">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('assets/images/sliderimg1.jpg') }}" alt="SliderImg1" class="d-block w-100"
                            Height="400px">

                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/images/sliderimg2.jpg') }}" alt="SliderImg2" class="d-block w-100"
                            Height="400px">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/images/sliderimg3.jpg') }}" alt="SliderImg3" class="d-block w-100"
                            Height="400px">
                    </div>
                </div>
            </div>
        </div>

        <div class="container py-5">
            <div class="row">
                <h3 class="mb-3">Best Sellers

                </h3>
                <div class="owl-carousel featured-carousel owl-theme">
                    @foreach ($trending_products as $trending_product)
                        <div class="item">
                            <div class="card">
                                <a href="/shop/{{ $trending_product->slug }}">
                                    <img src="{{ asset('assets/images/products/' . $trending_product->image) }}"
                                        alt="Product Image" Height="200px">
                                </a>
                                <div class="card-body">
                                    <a href="/shop/{{ $trending_product->slug }}" style="text-decoration: none;">
                                        <h5 class="mb-2">{{ Str::limit($trending_product->name, 23) }}</h5>
                                    </a>


                                    <div class="rating-css mb-2">
                                        <div class="star-icon">

                                            @php
                                                $total_rating = 0;
                                                $rating_count = 0;
                                                $rating_num = 0;
                                            @endphp

                                            @foreach ($ratings as $rating)
                                                @if ($trending_product->id == $rating->prod_id)
                                                    @php
                                                        $total_rating = $total_rating + $rating->stars_rated;
                                                        $rating_count = App\Models\Rating::where('prod_id', $trending_product->id)->count();
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

                                            @for ($i = 1; $i <= $rating_num; $i++)
                                                <i class="fa fa-star checked"></i>
                                            @endfor
                                            @for ($j = $rating_num; $j < 5; $j++)
                                                <i class="fa fa-star"></i>
                                            @endfor
                                        </div>
                                    </div>

                                    <span class="float-left" style="color: blue;"><b>Rs :
                                            {{ $trending_product->selling_price }}</b></span>
                                    <span class="float-end"><s><b>Rs :
                                                {{ $trending_product->original_price }}</b></s></span>

                                    <form action="/add-to-cart" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="id" value="{{ $trending_product->id }}">
                                        <input type="hidden" name="quantity" value="1">

                                        @if ($trending_product->qty > 0)
                                            <button class="btn btn-primary btn-sm" type="submit">Add To Cart</button>
                                        @else
                                            <button class="btn btn-primary btn-sm" disabled>Out Of Stock</button>
                                        @endif

                                    </form>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-3">
                    <a href="/shop"><button class="btn btn-outline-danger float-end">Shop More</button></a>
                </div>
            </div>
        </div>

        <div class="container py-3">
            <div class="row">
                <h3 class="mb-3">Trending Category

                </h3>
                <div class="owl-carousel featured-carousel owl-theme">
                    @foreach ($trending_categories as $trending_category)
                        <div class="item">
                            <div class="card">
                                <a href="/shop/category/{{ $trending_category->slug }}">
                                    <img src="{{ asset('assets/images/category/' . $trending_category->image) }}"
                                        alt="Product Image" Height="200px">
                                </a>
                                <div class="card-body">
                                    <a href="/shop/{{ $trending_category->id }}" style="text-decoration: none;">
                                        <h4>{{ $trending_category->name }}</h4>
                                    </a>
                                    <p>{{ Str::limit($trending_category->description, 30) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-3">
                    <a href="/shop/category"><button class="btn btn-outline-danger float-end">Browse More
                            Categories</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.featured-carousel').owlCarousel({
            loop: true,
            margin: 10,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            dots: false,

            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 4
                }
            }
        })
    </script>
@endsection
