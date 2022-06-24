@extends('layouts.admin')

@section('content')
    <div class="container py-5">

        <div class="row">
            <h3 class="fw-bold">User Details
                <a href="/users" class="btn btn-info float-end">Back</a>
            </h3>
            <hr>
            <div class="col-md-6">
                <label for="" class="fw-bold pt-2">Role</label>
                <div class="border p-2">{{ $user->role == '0' ? 'User' : 'Admin' }}</div>
                <label for="" class="fw-bold pt-2">Name</label>
                <div class="border p-2">{{ $user->name }}</div>
                <label for="" class="fw-bold pt-2">Contact Number</label>
                <div class="border p-2">{{ $user->phone }}</div>
                <label for="" class="fw-bold pt-2">Email</label>
                <div class="border p-2">{{ $user->email }}</div>
                <label for="" class="fw-bold pt-2">Address</label>
                <div class="border p-2">{{ $user->address }}</div>
            </div>
            <div class="col-md-6">
                <label for="" class="fw-bold">Country</label>
                <div class="border p-2">{{ $user->country }}</div>
                <label for="" class="fw-bold">City</label>
                <div class="border p-2">{{ $user->city }}</div>
                <label for="" class="fw-bold">State</label>
                <div class="border p-2">{{ $user->state }}</div>
                <label for="" class="fw-bold pt-2">Code</label>
                <div class="border p-2">{{ $user->code }}</div>

            </div>

        </div>
    </div>
@endsection
