@extends('layouts.customer')

@section('title')
    My Orders
@endsection

@section('content')
    <div class="container py-5">

        <div class="row">
            <div class="col-md-6">
                <h3 class="fw-bold">Shipping Details</h3>
                <hr>
                <label for="" class="fw-bold pt-2">Name</label>
                <div class="border p-2">{{ $orders->name }}</div>
                <label for="" class="fw-bold pt-2">Contact Number</label>
                <div class="border p-2">{{ $orders->phone }}</div>
                <label for="" class="fw-bold pt-2">Email</label>
                <div class="border p-2">{{ $orders->email }}</div>
                <label for="" class="fw-bold pt-2">Address</label>
                <div class="border p-2">{{ $orders->address }}</div>
                <label for="" class="fw-bold">Country</label>
                <div class="border p-2">{{ $orders->country }}</div>
                <label for="" class="fw-bold">City</label>
                <div class="border p-2">{{ $orders->city }}</div>
                <label for="" class="fw-bold">State</label>
                <div class="border p-2">{{ $orders->state }}</div>
                <label for="" class="fw-bold pt-2">Code</label>
                <div class="border p-2">{{ $orders->code }}</div>

            </div>

            <div class="col-md-6">
                <a href="/orders" class="btn btn-info mb-3 float-end">Back</a>
                <h3 class="fw-bold">Order Details</h3>
                <hr>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>name</td>
                            <td>Quantity</td>
                            <td>Price</td>
                            <td>Image</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders->orderItems as $order)
                            <tr>
                                <td>{{ $order->products->name }}</td>
                                <td>{{ $order->qty }}</td>
                                <td>{{ $order->price }}</td>
                                <td>
                                    <img src="{{ asset('assets/images/products/' . $order->products->image) }}" alt=""
                                        height="50px" width="50px">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <h4>Grand Total : {{ $orders->total_price }}</h4>
                <div class="mt-3">
                    <label for="" class="fw-bold">Order Status</label>
                    <form action="/update-order/{{ $orders->id }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select class="form-select" aria-label="" name="order_status">
                            <option {{ $orders->status == '0' ? 'selected' : '' }} value="0">Pending</option>
                            <option {{ $orders->status == '1' ? 'selected' : '' }} value="1">Completed</option>
                        </select>
                        <button type="submit" class="btn btn-primary mt-2 float-end">Update</button>
                    </form>
                </div>
            </div>


        </div>
    </div>
@endsection
