@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card border-primary">
        <div class="card-header bg-primary text-white">{{ __('User Profile') }}</div>
        <div class="card-body">
          <div class="row">
            <a href="{{ route('users#edit', $user->id) }}" class="col-md-4 col-form-label text-md-right">Edit</a>
          </div>

          @if (App\Util\StringUtil::isEmptyString($user->profile))
          <img src="{{ url('images/nullimage.jpg') }}" class="position-absolute profile d-inline img-thumbnail right">
          @else
          <img src="{{ url('uploads/'.$user->profile) }}"
            class="position-absolute profile d-inline img-thumbnail right">
          @endif

          <div class="row">
            <p class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</p>
            <div class="col-md-6">
              <p class="txt-confirm">{{ $user->name }}</p>
            </div>
          </div>

          <div class="row">
            <p class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</p>
            <div class="col-md-6">
              <p class="txt-confirm">{{ $user->email }}</p>
            </div>
          </div>

          <div class="row">
            <p class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</p>
            <div class="col-md-6">
              <p class="txt-confirm">
                @if (Auth::user()->isAdmin())
                Admin
                @else
                User
                @endif
              </p>
            </div>
          </div>

          <div class="row">
            <p class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</p>
            <div class="col-md-6">
              <p class="txt-confirm">{{ $user->phone }}</p>
            </div>
          </div>

          <div class="row">
            <p class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</p>
            <div class="col-md-6">
              <p class="txt-confirm">{{ $user->dob }}</p>
            </div>
          </div>

          <div class="row">
            <p class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</p>
            <div class="col-md-6">
              <p class="txt-confirm">{{ $user->address }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection