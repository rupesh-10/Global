@extends('layouts.default')

@section('content')
<div class="col-md-12">
  <div class="card shadow">
    <div class="card-header bg-transparent border-0">
      <h3 class="mb-0">Sales</h3>
    </div>
    <div class="table-responsive p-3">
      <table class="table align-items-center bg-white table-flush" id="dataTable">
        <thead>
          <tr>
            <th>S.N</th>
            <th style="width:10%" class="text-center">Orders</th>
            <th>Client's Name</th>
            <th> Address</th>
            <th>Phone No.</th>
          </tr>
        </thead>
        <tbody>
          @foreach($orders as $key=>$order)
          <tr>
            <td>{{ $key+1 }}</td>
            <td>
              <table class="table-responsive p-3">
                <tr class="bg-info">
                  <th>Item </th>
                  <th> Medium</th>
                  <th>Price</th>
                  <th>Quantity</th>
                </tr>
                @foreach($order->saleItem as $sale)
                <tr class="bg-warning text-white">  
                  <td>{{ $sale->item->name }}</td>
                  <td> {{ $sale->medium->name }}</td>
                  <td>{{ $sale->price }}</td>
                  <td>{{ $sale->quantity }}</td>
                </tr>
                @endforeach
              </table>
            </td>
            <td> {{ $order->client_name }}</td>
            <td> {{ $order->address }}</td>
            <td> {{ $order->phone_number }} </td>

          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>

@endsection