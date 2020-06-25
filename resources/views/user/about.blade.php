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
  
    </div>
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card bg-secondary shadow border-0 p-2">
                    <div class="card-header">
                       <h1>About Us</h1>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="inner-sec py-md-5 px-lg-5">
                            <h3 class="tittle text-center"> Welcome To Our Website</h3>
                            <p class="mb-4 text-center px-lg-4"> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Velit quae consequatur illum voluptate aperiam
                                 quisquam architecto fugiat minima neque, ipsa corrupti, nostrum suscipit quod, dolorum ad distinctio quidem similique. Voluptates?</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="about py-md-5 py-5">
            <div class="container py-md-3">
                <h2 class="tittle text-center text-white">What We Offer</h2>
                <div class="feature-grids row">
                    <div class="col-md-4 gd-bottom mt-lg-4 bg-white">
                        <div class="bottom-gd p-lg-5 p-4">
                            <span class="ni ni-delivery-fast text-danger" aria-hidden="true" style="font-size:25px;"></span>
                            <h3 class="my-3">FAST DELIVERY</h3>
                            <p>Integer sit amet mattis quam, sit amet ultricies velit. Praesent ullamcorper dui turpis.</p>
                        </div>
                    </div>
                    <div class="col-md-4 gd-bottom mt-lg-4 bg-danger">
                        <div class="bottom-gd2-active p-lg-5 p-4">
                            <span class="ni ni-money-coins text-white" aria-hidden="true" style="font-size:25px;"></span>
                            <h3 class="my-3 text-white">Cash On Delivery</h3>
                            <p class="text-white">Integer sit amet mattis quam, sit amet ultricies velit. Praesent ullamcorper dui turpis.</p>
                        </div>
                    </div>
                    <div class="col-md-4 gd-bottom mt-lg-4 bg-white">
                        <div class="bottom-gd p-lg-5 p-4">
                            <span class="ni ni-square-pin text-danger" aria-hidden="true" style="font-size:25px;"></span>
                            <h3 class="my-3">Delivery along Hetauda</h3>
                            <p>Integer sit amet mattis quam, sit amet ultricies velit. Praesent ullamcorper dui turpis.</p>
                        </div>
                    </div>
    
                </div>
            </div>
        </section>
    </div>
@endsection