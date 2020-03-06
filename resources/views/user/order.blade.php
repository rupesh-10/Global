@extends('layouts.app')
@section('content')
@if(count($orders)>=1)
<div class="p-4">
	<h3 class="text-center">Your Orders</h3>
	<div>
		<div class="m-5 text-center">
			<table class="table  m-auto" style="width:100%;">
				<thead>
					<tr>
						<th>Items</th>
						<th>By</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>Address</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>

					<tr>
						@foreach($orders as $key => $order)
						@foreach($order->saleItem as $order_item)
						<td>{{ $order_item->item->name}}</td>
						<td>{{ $order_item->medium->name}}</td>
						<td>{{ $order_item->quantity}}</td>
						<td>{{ $order_item->price }}</td>
						<td>{{ $order->address }}</td>
						<td>
						 @if($order->is_started==1 && $order->is_delivered ==0)
						 <span class="text-info">Product is on a way</span>
						@elseif($order->is_started==1 && $order->is_delivered==1)
						<span class="text-success">Delivered</span>
						@else
						<span class="text-danger">Delivery is remaining</span>
						</td>	
						@endif
					</tr>
					@endforeach
					@endforeach
				</tbody>
			</table>
		</div>
		@else
		<h2 class="text-center" style="font-weight:600; font-size:40px; margin-top:20%;"> Sorry No Order Yet!! Go <a class="text-info" href="/">Here</a> for Order</h2>
		@endif

		@endsection