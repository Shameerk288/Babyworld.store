@extends('layouts.customer')

@section('title')
@endsection

@section('content')
    <div class="container my-3">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    @if ($verified_purchase->count() > 0)
                        <h5 class="my-2">Write Review For {{ $product->name }}</h5>
                        <form action="/add-review" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <textarea name="user_review" id="" rows="5" class="form-control" placeholder="Write a review"></textarea>
                            <button type="submit" class="btn btn-success my-2">Submit Review</button>
                        </form>
                    @else
                    <h3>You are not eligible to review this product.Please purchase the product first.</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
