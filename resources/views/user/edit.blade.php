@extends('layouts.app')
@section('content')
<div class=" col-md-6 m-auto p-4">
<form action="/user/info/update" method="POST" class=" card mt-3 pt-3 pb-3 text-center">
            @csrf
        <div>
            <h4>Edit Your Info</h4>
        </div>
        <div class="container">
            <div class="row pt-2 ">
                <label class="col-md-3">Name: </label>
                <input type="text" class="form-control col-md-7 @error('name') is-invalid @enderror"  name="name" value="{{ $user->name }}">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
          

            <div class="row pt-2">
                <label class="col-md-3">Email: </label>
                <input type="email" class="form-control col-md-7 @error('email') is-invalid @enderror " name="email" value="{{ $user->email }}">
                @error('email')
                <span class="invalid-feedback" role="alert">    
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
          
            <div class="row pt-2">
                <label class="col-md-3">Phone Number: </label>
                <input type="text" name="phone_number" class="form-control col-md-7 @error('phone_nubmer') is-invalid @enderror" value="{{ $user->phone_number }}">
                @error('phone_number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
            <div class="pt-4">
                <button class="btn btn-success"> Update Profile </button>
            </div>
    </form>
<div>
@endsection