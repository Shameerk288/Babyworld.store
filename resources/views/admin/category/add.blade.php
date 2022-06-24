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
                        <form action="/insert-category" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Slug</label>
                                <input type="text" class="form-control" name="slug" placeholder="Slug">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Description</label>
                                <textarea name="description" rows="3" class="form-control"></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Status</label>
                                <input type="checkbox" name="status">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Popular</label>
                                <input type="checkbox" name="popular">
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
