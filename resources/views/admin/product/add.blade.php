@extends('layouts.admin')

@section('content')
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-11">
                    <div class="login-wrap p-4 p-lg-5">
                        <div class="d-flex">
                            <div class="w-100">
                                <div class="alert alert-success" role="alert">
                                </div>
                                <h3 class="mb-4">Product Details</h3>
                            </div>
                        </div>
                        <form action="/insert-product" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <select class="form-select" name="cat_id">
                                    <option selected>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Slug</label>
                                <input type="text" class="form-control" name="slug" placeholder="Slug">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Short Description</label>
                                <textarea name="short_description" rows="3" class="form-control"></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Description</label>
                                <textarea name="description" rows="3" class="form-control"></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Original price</label>
                                <input type="number" class="form-control" name="original_price"
                                    placeholder="Original Price">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Selling price</label>
                                <input type="number" class="form-control" name="selling_price"
                                    placeholder="Selling Price">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Quantity</label>
                                <input type="number" class="form-control" name="qty" placeholder="Quantity">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Status</label>
                                <input type="checkbox" name="status">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Trending</label>
                                <input type="checkbox" name="trending">
                            </div>
                            <div class="form-group mb-3">

                                <input type="file" name="image">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
