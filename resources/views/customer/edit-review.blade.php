@extends('layouts.customer')

@section('title')
@endsection

@section('content')
    <div class="container my-3">
        <div class="row">
            <div class="card">
                <div class="card-body">
                
                        <h5 class="my-2">Write Review For {{ $review->product->name }}</h5>
                        <form action="/update-review" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="review_id" value="{{ $review->id }}">
                            <textarea name="user_review" id="" rows="5" class="form-control" placeholder="Edit a review">{{ $review->user_review }}</textarea>
                            <button type="submit" class="btn btn-success my-2">Update Review</button>
                        </form>
              
                </div>
            </div>
        </div>
    </div>
@endsection
