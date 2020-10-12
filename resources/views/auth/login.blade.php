@extends('layouts.app')
@section('content')
<div class="main-content bg-default">
<div class="header bg-orange py-7 py-lg-8">
    <div class="container">
        <div class="header-body text-center mb-7">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-6">
                    <h1 class="text-white">Global Suppliers</h1>
                    <p class="text-lead text-white">
                        GLobal Suppliers is the finest suppliers of sand,gravel,stone etc in Hetauda.
                    </p>
                </div>
            </div>
        </div>
    </div>
<div class="separator separator-bottom separator-skew zindex-100">
    <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
      <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
    </svg>
  </div>
</div>
<div class="container mt--8 pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card bg-secondary shadow border-0 p-2">
                <div class="card-header">
                   <h3>Login</h3>
                </div>

                <div class="card-body px-lg-5 py-lg-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                            </div>
                                <input id="email" type="email" class="form-control p-2 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  placeholder="Email or Phone Number" required autocomplete="email" autofocus>
                             
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>

                        <div class="form-group">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input id="password" type="password" class="form-control p-2 @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="remember">
                                      <span class="text-muted">  {{ __('Remember Me') }} </span>
                                    </label>
                                </div>
                            </div>

                        <div class="text-center">
                         <button type="submit" class="btn btn-primary my-4">
                                    {{ __('Login') }}
                                </button>
                            </div>
                            <div class="row mt-3">
                                <div class="col-6 text-center">
                                    @if (Route::has('password.request'))
                                    <a class="text-danger" href="{{ route('password.request') }}">
                                      <small>   {{ __('Forgot Your Password?') }} </small>
                                       </a>
                                  @endif
                               
                                </div>
                                <div class="col-6 text-center">
                                  <a href="/register" class="text-success">
                                    <small>Create new account </small>
                                    </a>
                                </div>
                              </div>
                              
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
