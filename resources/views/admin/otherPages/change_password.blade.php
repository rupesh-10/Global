@extends('layouts.default')
@section('content')
<div class=" col-md-6 m-auto p-4">
<form action="/admin/updatePassword/{{auth()->user()->id}}" method="POST" class=" card mt-3 pt-3 pb-3 text-center">
            @csrf
        <div>
            <h4>Edit Your Info</h4>
        </div>
        <div class="container">
            <div class="row pt-2 ">
                <label class="col-md-3">Current Password:  </label>
                <input type="password" class="form-control col-md-7 @error('currentpassword') is-invalid @enderror"  name="currentpassword">
                @error('currentpassword')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
          

            <div class="row pt-2">
                <label class="col-md-3">New Password: </label>
                <input type="password" class="form-control col-md-7 @error('password') is-invalid @enderror " name="password" autocomplete="new-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
          
            <div class="row pt-2">
                <label class="col-md-3">Confirm Password: </label>
                <input type="password" name="confirmpassword" class="form-control col-md-7 @error('confirmpassword') is-invalid @enderror" autocomplete="new-password">
                @error('confirmpassword')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
            <div class="pt-4">
                <button class="btn btn-success"> Update Password </button>
            </div>
    </form>
<div>

@endsection