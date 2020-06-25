@extends('layouts.default')

@section('content')
<div class="col-md-12">
  <div class="card shadow">
    <div class="card-header bg-transparent border-0">
      <h3 class="mb-0">Transactions</h3>
    </div>
    <div class="table-responsive p-3">
      <table class="table align-items-center bg-white table-flush" id="dataTable">
        <thead>
          <tr>
            <th>S.N</th>
            <th>Date</th>
            <th>Order ID</th>
            <th>Client's Name</th>
            <th> Paid Amount</th>
            <th>Payment Method</th>
          </tr>
        </thead>
        <tbody>
          @foreach($sales as $key => $sale)
          <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $sale->created_at->toDateString() }}</td>
            <td class="text-danger">GS{{ $sale->id }}</td>
            <td>{{ $sale->client_name }}</td>
            {{-- @foreach($sale->SaleItem as $item) --}}
            <td>{{ $sale->SaleItem->sum('price') }}</td>
            {{-- @endforeach --}}
            <td>{{ $sale->payment_method }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>

@endsection