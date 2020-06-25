@extends('layouts.default')
@section('content')
        <div class="col-12">
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <a class="btn btn-secondary" href="{{ action('Admin\MediumController@index') }}">
                                <i class="fa fa-arrow-circle-left"></i>
                            </a>
                            <button class="btn btn-link text-dark" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <h3>
                                <strong class="text-warning">
                                    Edit: {{ $medium->name }}
                                </strong>
                            </h3>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <form method="post" action="{{ action('Admin\MediumController@update', $medium->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label for="medium" class="col-md-12 col-form-label text-md-left text-white">Medium Name</label>

                                    <div class="col-md-12">
                                        <input id="medium" type="text" class="form-control @error('medium') is-invalid @enderror" name="medium" value="{{ $medium->name }}" required autocomplete="off" autofocus>

                                        @error('medium')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                    <button class="btn btn-primary">Update Medium</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
