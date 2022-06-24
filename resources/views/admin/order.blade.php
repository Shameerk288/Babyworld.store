@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>New Orders

                <a href="/orders-history" class="btn btn-info float-end">Completed Orders</a>
            </h3>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>Tracking Number</td>
                        <td>Total Price</td>
                        <td>Status</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->tracking_no }}</td>
                            <td>{{ $order->total_price }}</td>
                            <td>{{ $order->status == '0' ? 'pending' : 'Completed' }}</td>
                            <td>
                                <a href="admin/order-details/{{ $order->id }}" class="btn btn-success">details</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
