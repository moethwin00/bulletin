@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card border-primary">
        <div class="card-header bg-primary text-white">{{ __('Create User') }}</div>
        <div class="card-body">
          <form method="POST" action="{{ route('users#confirmCreate') }}" enctype="multipart/form-data">
            @csrf
            @if ($duplicate)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              User with Email Already Exist!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif

            <div class="form-group row">
              <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
              <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                  value="@if (isset($user->name)) {{ $user->name }} @endif" autocomplete="name" autofocus>
                @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
              <div class="col-md-6">
                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                  value="@if (isset($user->email)) {{ $user->email }} @endif" autocomplete="email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
              <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                  name="password" autocomplete="new-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="password-confirm"
                class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
              <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                  autocomplete="new-password">
              </div>
            </div>

            <div class="form-group row">
              <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>
              <div class="col-md-6">
                <select id="type" class="form-control" name="type">
                  <option value="0" @if (isset($user->type))
                    @if ($user->type ="0")
                    selected
                    @endif
                    @endif>
                    Admin
                  </option>
                  <option value="1" @if (isset($user->type))
                    @if ($user->type ="1")
                    selected
                    @endif
                    @endif>
                    User
                  </option>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>
              <div class="col-md-6">
                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                  value="@if (isset($user->phone)) {{ $user->phone }} @endif" autocomplete="phone" autofocus>
              </div>
            </div>

            <div class="form-group row">
              <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>
              <div class="col-md-6">
                <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value=
                  @if (isset($user->dob)) 
                    {{ $user->dob }} 
                  @endif autocomplete="dob" 
                autofocus>
              </div>
            </div>

            <div class="form-group row">
              <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
              <div class="col-md-6">
                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror"
                  name="address" value="@if (isset($user->address)) {{ $user->address }} @endif" autocomplete="address"
                  autofocus>
              </div>
            </div>

            <div class="form-group row">
              <label for="profile" class="col-md-4 col-form-label text-md-right">{{ __('Profile') }}</label>
              <div class="col-md-6">
                <div class="custom-file">
                  <input id="profile" type="file" accept="image/x-png,image/gif,image/jpeg"
                    class="form-control @error('profile') is-invalid @enderror" name="profile" value=
                    @if (isset($user->profile)) 
                      {{ $user->profile }} 
                    @endif autocomplete="profile" 
                  autofocus>
                </div>
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  {{ __('Confirm') }}
                </button>
                <a href="{{ route('register') }}" class="btn btn-danger">
                  {{ __('Clear') }}
                </a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection