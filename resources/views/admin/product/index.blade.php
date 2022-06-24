@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Product Page</h4>
        </div>
        <div class="new-product">
            <a href="/add-product" class="btn btn-success">
                Add New Product
            </a>
        </div>
        <div class="card-body">
            <div class="container">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Short Description</th>
                            {{-- <th>Original price</th> --}}
                            <th>Selling price</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->short_description }}</td>
                                {{-- <td>{{ $product->original_price }}</td> --}}
                                <td>{{ $product->selling_price }}</td>
                                <td>
                                    <img src="{{ asset('assets/images/products/' . $product->image) }}" alt="product-img"
                                        width="120px" height="50px">
                                </td>
                                <td>
                                    <a href="edit-product/{{ $product->id }}" class="btn btn-info btn-sm">Edit</a>
                                    <a href="delete-product/{{ $product->id }}"
                                        class="btn btn-danger btn-sm mt-2">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
