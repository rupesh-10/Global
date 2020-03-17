@extends('layouts.app')
@section('content')
<div class="text-center mt-5">
  <H3>Your Profile</H3>
</div>
<div class="card m-auto" style="width: 30%">
      <div class="card-header text-center">
        <i class="fa fa-user" style="font-size:55px; color:orange; border-radius:50%; background:red; padding:7%;"></i>
      </div>
      <div class="card-body">
      <h5>Name: {{ $user->name }}</h5>
      <h5>Phone Number: {{ $user->phone_number }}</h5>
      <h5>Total Orders: {{ count($orders) }}</h5>
      </div>
    <div class="card-footer text-center">
      <button class="btn btn-success mr-3">Edit Profile</button>
      <button class="btn btn-danger ml-3">Change Password</button>
    </div>
  </div>
@endsection