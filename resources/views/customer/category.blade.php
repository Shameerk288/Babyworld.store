@extends('layouts.customer')

@section('title')
    Babyworld.store/Categories
@endsection

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Categories</h4>
                        <div class="breadcrumb__links">
                            <a href="/">Home</a>
                            <a href="/shop">Shop</a>
                            <span>Categories</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <div class="container py-5">
        <div class="row">
            <h2 class="mb-3">All categories</h2>
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="card mt-3">
                            <a href="/shop/category/{{ $category->slug }}" class="mx-auto">
                                <img src="{{ asset('assets/images/category/' . $category->image) }}" alt="Product Image"
                                    Height="200px">
                            </a>
                            <div class="card-body">
                                <a href="/shop/category/{{ $category->slug }}" style="text-decoration: none;">
                                    <h4>{{ $category->name }}</h4>
                                </a>
                                <p>{{ $category->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
