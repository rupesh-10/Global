@extends('layouts.default')
@section('content')

  <div class="main-content p-2">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href='dashboard'>Dashboard</a>
       
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <div class="media-body ml-2 d-none d-lg-block">
                <span class="mb-0 text-sm  font-weight-bold"></span>
                </div>
              </div>
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <!-- End Navbar -->
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Users</h5>
                    <span class="h2 font-weight-bold mb-0">{{ count($users) }}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fa fa-user"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <a href="/admin/sales">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Sales</h5>
                    <span class="h2 font-weight-bold mb-0">{{ count($sales) }}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                        <i class="fa fa-shopping-cart"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </a>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <a href="/admin/order">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Delivery to Start</h5>
                    <span class="h2 font-weight-bold mb-0">{{ count($to_start) }}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                        <i class="fa fa-truck"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <a href="/admin/delivery">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Pending Deliveries</h5>
                    <span class="h2 font-weight-bold mb-0">{{ count($deliveries) }}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                        <i class="fa fa-truck"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <h3 class="mt-2">Filter By:</h3>
    <div class="row mt-2">
      <div class="col-md-3">
        User's Name: 
        <input type="text" class="form-control">
      </div>
      <div class="col-md-3"> Date: 
        <input type="text" class="form-control" name="daterange" id="daterangepicker">
      </div>
      <div class="col-md-3">
        Address:
        <input type="text" class="form-control" name="address" id="address">
      </div>
      <div class="col-md-3">
        Item:
        <input type="text" class="form-control" name="items" id="item">
      </div>

    </div>
    <div class="mt-2">
      <table class="table align-items-center bg-white table-flush">
        <thead>
          <tr>
            <th>S.N</th>
            <th>Date</th>
            <th style="width:10%" class="text-center">Orders</th>
            <th>Client's Name</th>
            <th> Address</th>
            <th>Phone No.</th>
          </tr>
        </thead>
        <tbody>
          @foreach($sales as $key=>$sale)
          <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $sale->created_at->toDateString() }}</td>
            <td>
              <table class="table-responsive p-3">
                <tr class="bg-info">
                  <th>Item </th>
                  <th> Medium</th>
                  <th>Price</th>
                  <th>Quantity</th>
                </tr>
                @foreach($sale->saleItem as $saleItem)
                <tr class="bg-warning text-white">  
                  <td>{{ $saleItem->item->name }}</td>
                  <td> {{ $saleItem->medium->name }}</td>
                  <td>{{ $saleItem->price }}</td>
                  <td>{{ $saleItem->quantity }}</td>
                </tr>
                @endforeach
              </table>
            </td>
            <td> {{ $sale->client_name }}</td>
            <td> {{ $sale->address }}</td>
            <td> {{ $sale->phone_number }} </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection