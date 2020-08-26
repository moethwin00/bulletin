@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card border-primary">
          <div class="card-header bg-primary text-white">Upload CSV File</div>
          <div class="card-body">
            <div class="container col-8">
              @if (\Session::has('message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {!! \Session::get('message') !!}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              @endif
              <form action="{{ route('posts#upload') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <label for="profile" class="form-label font-weight-bold">Import File From : </label>
                <input id="profile" type="file" accept=".csv" class="form-control @error('profile') is-invalid @enderror" name="profile" value=@if (isset($user->profile)) {{ $user->profile }} @endif autocomplete="profile" autofocus>
                @error('profile')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
                <input type="submit" class="btn btn-primary mt-3" value="Import File"> 
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
