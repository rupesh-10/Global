@extends('layouts.default')

@section('content')

<div class="col-12">
  <div id="accordion">
    <div class="col-md-12">
      <div class="card shadow">
        <div class="card-header bg-transparent border-0 p-0">

          <button class="btn btn-link collapsed text-dark" data-toggle="collapse" data-target="#collapseOne"
            aria-expanded="true" aria-controls="collapseOne">
            <h3> Add New Medium </h3>
          </button>

        </div>
      </div>
      <div id="collapseOne" class="collapse bg-white {{ $errors->count() ? 'show': '' }}" aria-labelledby="headingOne"
        data-parent="#accordion">
        <div class="card-body mt-2">
          <form method="post" action="{{ action('Admin\MediumController@store') }}">
            @csrf
            <div class="form-group row">
              <label for="medium" class="col-md-12 col-form-label text-md-left">{{ __('Medium Name') }}</label>

              <div class="col-md-12">
                <input id="medium" type="text" class="form-control @error('medium') is-invalid @enderror" name="medium"
                  autocomplete="off" autofocus>

                @error('medium')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="form-group text-right">
              <button class="btn btn-success">Add New Medium</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  @if(count($mediums)>=1)
  <div class="col-md-12 mt-3">
    <div class="card shadow">
      <div class="card-header bg-transparent border-0">
        <h3 class="text-warning mb-0">All Mediums : {{ $mediums->count() }}</h3>
      </div>
      <div class="table-responsive">
        <table class="table align-items-center bg-white table-flush">
          <thead>
            <tr>
              <th>S.N</th>
              <th>Mediums</th>
              <th width="150">Manage</th>
            </tr>
          </thead>
          <tbody>
            @foreach($mediums as $key=>$medium)
            <tr>
              <td>{{ $key+1 }}</td>
              <td>{{ $medium->name }}</td>
              <td>
                <a class="btn btn-sm btn-secondary" href="{{ action('Admin\MediumController@edit', $medium->id) }}">
                  <i class="fa fa-edit"></i>
                </a>
                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmDeletion">
                  <i class="fa fa-trash"></i>
                </button>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="confirmDeletion">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h4>Do you want to delete this?</h4>
      </div>
      <div class="modal-footer">
        <form method="post" action="{{ action('Admin\MediumController@destroy', $medium->id) }}">
          @csrf
          @method('DELETE')
          <button class="btn btn-danger">Confirm</button>
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
</div>
@else
<div class="col-md-12 text-center pt-4">
  <h3 class="text-danger">No Mediums Found</h3>
</div>
@endif
@endsection