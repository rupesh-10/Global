@extends('layouts.default')
@section('content')
<div class="col-12">
    <div id="accordion">
        <div class="card ">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <a class="btn btn-secondary" href="{{ action('Admin\SalesController@order') }}">
                        <i class="fa fa-arrow-circle-left"></i>
                    </a>
                    <button class="btn btn-link text-dark" data-toggle="collapse" data-target="#collapseOne"
                        aria-expanded="true" aria-controls="collapseOne">
                        <h3>
                            Edit Order : <span class="text-danger">GS{{ $order->id }}</span>
                        </h3>
                    </button>
                </h5>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <form method="post" action="{{ action('Admin\SalesController@updateOrder', $order->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="item" class="col-md-3    col-form-label">Items:</label>
                            <div class="col-md-3">
                            <select name="item" class="form-control">
                                @foreach($order->saleItem as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            </div>
                            @error('item')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group text-right">
                            <button class="btn btn-primary">Update Item</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection