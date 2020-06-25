@extends('layouts.app')
@section('content')
<div class="card mt-3 p-2" style="width: 20rem;">
	<div class="card-head text-center">
		<h4>Personal Information</h4>
	</div>
	<div class="card-body text-center ">
		<h5>{{ $user->name }}</h5>
		<h5>{{ $user->phone_number }}</h5>
	    <h5>{{ $user->email }}</h5>
		<h5>Orders : {{ count($orders) }} </h5>
	</div>
	<div class="card-foot text-right">
<a class="text-info" href="/user/info/edit">Edit</a>
	</div>
  </div>
@if(count($orders)>=1)
<div class="p-4">
	<h3 class="text-center">Your Orders</h3>
	<div>
		<div class="mt-5 text-center">
			<table class="table table-responsive m-auto" style="max-width:100%;">
				<thead>
					<tr>
						<th>S.N</th>
						<th>Date</th>
					    <th class="text-center" style="width:10%;">Orders</th>
						<th>Address</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					@foreach($orders as $key => $order)
					<tr>
						<td>{{ $key+1 }}</td>
					<td>{{ $order->created_at->toDateString() }}</td>
						<td>
							<table class="table-responsive p-3 text-center">
							  <tr class="bg-success">
								<th>Item </th>
								<th> Medium</th>
								<th>Price</th>
								<th>Quantity</th>
							  </tr>
							@foreach($order->saleItem as $sale)
							  <tr class="bg-danger text-white">
								<td>{{ $sale->item->name }}</td>
								<td> {{ $sale->medium->name }}</td>
								<td>{{ $sale->price }}</td>
								<td>{{ $sale->quantity }}</td>
							  </tr>
							  @endforeach
							</table>
						  </td>
						<td>{{ $order->address }}</td>
						<td>
						 @if($order->is_started==1 && $order->is_delivered ==0)
						 <span class="text-info">Items are on a way</span>
						@elseif($order->is_started==1 && $order->is_delivered==1)
						<span class="text-success">Delivered</span>
						@else
						<span class="text-danger">Delivery is remaining</span>
						</td>	
						@endif
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
		@else
		<h2 class="text-center" style="font-weight:600; font-size:40px; margin-top:10%;"> Sorry No Order Yet!! Go <a class="text-info" href="/">Here</a> for Order</h2>
		@endif

		@endsection