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
                                <h3 class="mb-4">Category Details</h3>
                            </div>
                        </div>
                        <form action="/update-category/{{ $category->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name"
                                    value="{{ $category->name }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Slug</label>
                                <input type="text" class="form-control" name="slug" placeholder="Slug"
                                    value="{{ $category->slug }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Description</label>
                                <textarea name="description" rows="3" class="form-control">{{ $category->description }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Status</label>
                                <input type="checkbox" {{ $category->status == '1' ? 'checked' : '' }} name="status">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Popular</label>
                                <input type="checkbox" {{ $category->popular == '1' ? 'checked' : '' }} name="popular">
                            </div>
                            <div class="form-group mb-3">
                                <img src="{{ asset('assets/images/category/' . $category->image) }}" alt="category image"
                                    height="100px" width="150px">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Image : </label>
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
