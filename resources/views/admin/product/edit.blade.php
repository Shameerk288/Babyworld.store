@extends('layouts.admin')

@section('content')
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-11">
                    <div class="login-wrap p-4 p-lg-5">
                        <div class="d-flex">
                            <div class="w-100">
                                {{-- <div class="alert alert-success" role="alert">
                                </div> --}}
                                <h3 class="mb-4">Product Details</h3>
                            </div>
                        </div>
                        <form action="/update-product/{{ $product->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="">Category</label>
                                <select class="form-select" name="cat_id">
                                    <option value="">{{ $product->category->name }}</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name"
                                    value="{{ $product->name }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Slug</label>
                                <input type="text" class="form-control" name="slug" placeholder="Slug"
                                    value="{{ $product->slug }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Short Description</label>
                                <textarea name="short_description" rows="3" class="form-control">{{ $product->short_description }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Description</label>
                                <textarea name="description" rows="3" class="form-control">{{ $product->description }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Original price</label>
                                <input type="number" class="form-control" name="original_price"
                                    placeholder="Original Price" value="{{ $product->original_price }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Selling price</label>
                                <input type="number" class="form-control" name="selling_price" placeholder="Selling Price"
                                    value="{{ $product->selling_price }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Quantity</label>
                                <input type="number" class="form-control" name="qty" placeholder="Quantity"
                                    value="{{ $product->qty }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Status</label>
                                <input type="checkbox" {{ $product->status == true ? 'checked' : '' }} name="status">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Trending</label>
                                <input type="checkbox" {{ $product->trending == true ? 'checked' : '' }} name="trending">
                            </div>
                            @if ($product->image)
                                <img src="{{ asset('assets/images/products/' . $product->image) }}" alt="product-img"
                                    height="100px" width="200px" class="mb-3">
                            @endif
                            <div class="form-group mb-3">
                                <input type="file" name="image">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
