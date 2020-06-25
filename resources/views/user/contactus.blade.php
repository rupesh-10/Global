@extends('layouts.app')
@section('content')
<div class="main-content bg-default">
    <div class="header bg-gradient-primary py-7 py-lg-8">
        <div class="container">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6">
                        <h1 class="text-white">Global Suppliers</h1>
                        <p class="text-lead text-light">
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
                       <h3>Contact Us</h3>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="col-md-10 contact-left-content">
                            <div class="address-con">
                                <h4 class="mb-2"><i class="ni ni-mobile-button text-info"></i> Phone</h4>
                                <p>+977 9803190056</p>
                            </div>
                            <div class="address-con my-4">
                                <h4 class="mb-2"><i class="ni ni-email-83 text-orange"></i> Email </h4>
                                <p><a href="mailto:info@example.com">globalsuppliers@gmail.com</a></p>
                            </div>
                            <div class="address-con mb-4">
                                <h4 class="mb-2"><i class="ni ni-world-2 text-warning"></i> Website</h4>
                                <p><a href="https://www.globalsuppliers.com.np">Global Suppliers</a></p>
                            </div>
                            <div class="address-con">
                                <h4 class="mb-2"><i class="ni ni-square-pin text-danger"></i> Location </h4>
        
                                <p>Buddha Chowk, Hetauda </p>
                            </div>
        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection