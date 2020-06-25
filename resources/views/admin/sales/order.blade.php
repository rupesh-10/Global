@extends('layouts.default')

@section('content')
<div class="col-md-12">
  <div class="card shadow">
    <div class="card-header bg-transparent border-0">
      <h3 class=" mb-0">Orders</h3>
    </div>
    <div class="table-responsive p-3" style="max-height:800px;">
      <table class="table align-items-center table-flush bg-white" id="dataTable">
        <thead>
          <tr>
            <th>S.N</th>
            <th>Date</th>
            <th>Order Id</th>
            <th class="text-center" style="width:10%;">Order</th>
            <th> User Name</th>
            <th> Address</th>
            <th>Phone N.</th>
            <th>Payment</th>
            <th>Start Delivery</th>
            <th>Manage Orders</th>

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
            <td>
              {{ $order->client_name }}
            </td>
            <td>
              {{ $order->address  }}
            </td>
            <td>

              {{ $order->phone_number  }}
            </td>
            @if($order->is_finalized==0)
            <td>
              <span class="text-warning">Pending</span>
            </td>
            @else
            <td>
              <span class="text-success">Success</span>
            </td>
            @endif
            @if($order->is_started==1)
            <td class="text-success"> Started <a class="btn btn-danger btn-sm text-white"
                href="delivery/cancel/{{ $order->id }}"><i class="fa fa-cross"></i>Cancel</a></td>
            @else
            <td> <a href="delivery/start/{{ $order->id}}"> <button class="btn btn-warning"> Start Delivery </button></a>
            </td>
            @endif
            <td>
              <a href="/admin/order/edit/{{ $order->id }}" class="btn btn-secondary btn-sm">
                <i class="fa fa-edit"></i>

              </a>
              <a data-toggle="modal" data-target="#confirmDeletion" class="btn btn-danger btn-sm">
                <i class="fa fa-edit"></i>
            </td>
          </tr>
          @endforeach

        </tbody>
      </table>
    </div>
  </div>
  <div class="modal" tabindex="-1" role="dialog" id="confirmDeletion">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <h4>Do you want to delete this?</h4>
        </div>
        <div class="modal-footer">
          <a class="btn btn-danger" href="/admin/order/delete/{{ $order->id }}">Confirm</a>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</div>

@endif
@endsection