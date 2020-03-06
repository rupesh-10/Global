@extends('layouts.default')

@section('content')
<div class="col-md-12">
  <div class="card shadow">
    <div class="card-header bg-transparent border-0">
      <h3 class=" mb-0">Orders</h3>
    </div>
    <div class="table-responsive p-3" style="max-height:1200px;">
      <table class="table align-items-center table-flush bg-white" id="dataTable">
        <thead>
          <tr>
            <th>S.N</th>
            <th class="text-center" style="width:10%;">Order</th>
            <th> User Name</th>
            <th> Address</th>
            <th>Phone N.</th>
            <th>Is Paid</th>
            <th>Start Delivery</th>

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
                <tr class="bg-warning text-white display-1">
                  <td>{{ $sale->item->name }}</td>
                  <td> {{ $sale->medium->name }}</td>
                  <td>{{ $sale->price }}</td>
                  <td>{{ $sale->quantity }}</td>
                </tr>
                @endforeach
              </table>
            </td>
            <td>
              <h5> {{ $order->client_name }}</h5>
            </td>
            <td>
              <h5> {{ $order->address  }}</h5>
            </td>
            <td>

              <h5> {{ $order->phone_number  }}</h5>
            </td>
            @if($order->is_finalized==0)
            <td>
            <h5 class="text-warning">Pending</h5>
            </td>
            @else
            <td>
              <h5 class="text-success">Success</h5>
            </td>
            @endif
              @if($order->is_started==1)
              <td class="text-success"> Started </td>
              @else
              <td> <a href="delivery/start/{{ $order->id}}"> <button class="btn btn-warning"> Start Delivery </button></a>
              </td>
              @endif
          </tr>
          @endforeach

        </tbody>
      </table>
    </div>
  </div>
</div>
</div>

@endsection