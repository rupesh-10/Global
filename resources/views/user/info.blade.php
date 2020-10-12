@extends('layouts.app')
@section('content')
<div class="container">
<div class="row p-4">
<div class="card p-2  m-auto bg-orange col-md-6">
	<div class="card-head text-center">
		<h3 class="text-white">Personal Information</h3>
	</div>
	<div class="card-body text-center">
		<h5 class="text-white">{{ $user->name }}</h5>
		<h5 class="text-white">{{ $user->phone_number }}</h5>
	    <h5 class="text-white">{{ $user->email }}</h5>
		<h5 class="text-white">Orders : {{ count($orders) }} </h5>
	</div>
	<div class="card-foot text-right">
  <a href="/user/info/edit"><h4 class="text-white">Edit</h4></a>
  <a href="/password"><h4 class="text-yellow">Change Password</h4></a>
	</div>
  </div>
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
		<h3 class="text-center" style="font-weight:600; font-size:35px; margin-top:10%;"> Sorry No Order Yet!! Go <a class="text-info" href="/">Here</a> for Order</h3>
		@endif

		@endsection