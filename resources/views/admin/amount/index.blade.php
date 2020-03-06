@extends('layouts.default')

@section('content')
<div class="col-12">
  <div id="accordion">
    <div class="col-md-12 mt-3">
      <div class="card bg-default shadow">
        <div class="card-header bg-transparent border-0">
          <h3 class="text-warning mb-0">All Amounts : {{ $amounts->count() }}</h3>
        </div>
        <div class="table-responsive">
          <table class="table align-items-center table-dark table-flush">
            <thead class="thead-dark">
              <tr>
                <th>S.N</th>
                <th>Location</th>
                <th width="150">Manage</th>
              </tr>
            </thead>
            <tbody>
              @foreach($amounts as $key=>$amount)
              <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $amount->item->name }}</td>
                <td>{{ $amount->medium->name }}</td>
                <td>{{ $amount->price??"---"}}</td>
                <td>{{ $amount->default_distance }}</td>
                <td>{{ $amount->per_km_price}}</td>
                <td>
                  <form method="post" action="{{ action('Admin\AmountController@destroy', $amount->id) }} }}">
                    @csrf
                    @method('DELETE')
                    <a class="btn btn-sm btn-secondary" href="{{ action('Admin\AmountController@edit', $amount->id) }}">
                      <i class="fa fa-edit"></i>
                    </a>
                    <button class="btn btn-danger btn-sm">
                      <i class="fa fa-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection