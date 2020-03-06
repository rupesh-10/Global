@extends('layouts.default')
@section('content')
        <div class="col-12">
            <div id="accordion">
                <div class="card bg-default ">
                    <div class="card-header bg-default" id="headingOne">
                        <h5 class="mb-0">
                            <a class="btn btn-secondary" href="{{ action('Admin\ItemController@index') }}">
                                <i class="fa fa-arrow-circle-left"></i>
                            </a>
                            <button class="btn btn-link text-dark" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <h3>
                                <strong class="text-warning">
                                    Edit: {{ $item->name }}
                                </strong>
                            </h3>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <form method="post" action="{{ action('Admin\ItemController@update', $item->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label for="item" class="col-md-12 col-form-label text-md-left text-white">Item Name</label>

                                    <div class="col-md-12">
                                        <input id="item" type="text" class="form-control @error('item') is-invalid @enderror" name="item" value="{{ $item->name }}" required autocomplete="off" autofocus>

                                        @error('item')
                                        <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
                                        @enderror
                                    </div>
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
