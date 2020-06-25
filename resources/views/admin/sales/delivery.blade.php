@extends('layouts.default')

@section('content')

<div class="col-md-12">
  <div class="card shadow">
    <div class="card-header bg-transparent border-0">
      <h3 class="mb-0">Delivery</h3>
    </div>
    <div class="table-responsive p-2">
      <table class="table align-items-center table-flush" id="dataTable">
        <thead>
          <tr>
            <th>S.N</th>
            <th>Date</th>
            <th>Order ID</th>
            <th class="text-center" style="width:10%;">Orders</th>
            <th>Client's Name</th>
            <th> Address</th>
            <th>Phone N.</th>
            <th>Delivery</th>
            <th>Completed Date</th>
          </tr>
        </thead>
        <tbody>
          @if(count($orders)>=1)
          @foreach($orders as $key=>$order)
          <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $order->created_at->toDateString() }}</td>
            <td class="text-danger">GS{{ $order->id }}</td>

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
            <td>{{ $order->address }}</td>
            <td> {{ $order->phone_number }} </td>
            @if($order->is_delivered==1)
            <td class="text-success"> Completed </td>
            @else
            <td> <a href="delivery/{{ $order->id}}"> <button class="btn btn-warning"> Complete delivery </button></a>
            </td>
            @endif
            @if($order->is_delivered==1)
            <td>{{ $order->updated_at->toDateString() }}</td>
            @else
            <td>......</td>
            @endif
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
@endif
@endsection