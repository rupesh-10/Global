@extends('layouts.default')
@section('content')
        <div class="col-12">
            <div id="accordion">
                <div class="card bg-default">
                    <div class="card-header bg-default" id="headingOne">
                        <h5 class="mb-0">
                            <a class="btn btn-secondary" href="{{ action('Admin\AmountController@index') }}">
                                <i class="fa fa-arrow-circle-left"></i>
                            </a>
                            <button class="btn btn-link text-dark" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <h3 class="text-white">
                                    Edit
                                </h3>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <form method="post" action="{{ action('Admin\AmountController@update',$amount->id) }}">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                <div class=" col-md-4 form-group row">
                                    <label for="medium" class="col-md-12 col-form-label text-md-left text-white">{{ __('Medium Name') }}</label>
    
                                   
                                        <select id="medium" type="text"
                                            class="form-control @error('medium') is-invalid @enderror" name="medium"
                                    required autocomplete="off" autofocus>
                                           @foreach($mediums as $medium)
                                    <option {{$amount->medium->name ? 'selected':''}} value="{{ $medium->id }} "> {{ $medium->name }}</option>
                                     @endforeach
                                    </select>
    
                                        @error('medium')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                <div class=" col-md-4 form-group">
                                    <label for="item" class="col-form-label text-md-left text-white">{{ __('Item Name') }}</label>
    
                                  
                                        <select id="item" type="text"
                                            class="form-control @error('item') is-invalid @enderror" name="item"
                                    required autocomplete="off" autofocus value="{{ $amount->item->name }}">
                                           @foreach($items as $item)
                                    <option {{ $amount->item->name? 'selected':'' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                           @endforeach
                                    </select>
    
                                        @error('item')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                  
                                </div>
                           
                                <div class=" col-md-4 form-group row">
                                    <label for="price" class="col-md-12 col-form-label text-md-left text-white">{{ __('Price') }}</label>
                                        <input id="price" type="text"
                                            class="form-control @error('price') is-invalid @enderror" name="price"
                                    required autocomplete="off" value="{{ $amount->price }}" autofocus>
    
                                        @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                </div>
                                 </div>
                                <div class="form-group text-center">
                                    <button class="btn btn-success">Update Amount</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
