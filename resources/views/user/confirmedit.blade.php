@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">{{ __('Create User') }}</div>
                <div class="card-body">
                    <img src="{{ url('uploads/'.$user->profile) }}" class="position-absolute d-inline img-thumbnail right w-25">
                    <form method="post" action="{{ route('users.register') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="hidden" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
                                <p class="txt-confirm">{{ $user->name }}</p>
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
                                <input id="email" type="hidden" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">
                                <p class="txt-confirm">{{ $user->email }}</p>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>
                            
                            <div class="col-md-6">
                                <select id="type" class="form-control d-none" name="type" value="{{ $user->type }}">
                                    <option value="0">Admin</option>
                                    <option value="1">User</option>
                                </select>
                                <p class="txt-confirm">
                                    @if($user->type == "0")
                                        Admin
                                    @else 
                                        User
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="hidden" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}" required autocomplete="phone" autofocus>
                                <p class="txt-confirm">
                                    {{ $user->phone }}
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>
                            <div class="col-md-6">
                                <input id="dob" type="hidden" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ $user->dob }}" required autocomplete="dob" autofocus>
                                <p class="txt-confirm">
                                    {{ $user->dob }}
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                            <div class="col-md-6">
                                <input id="address" type="hidden" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $user->address }}" required autocomplete="address" autofocus>
                                <p class="txt-confirm">
                                    {{ $user->address }}
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="profile" class="col-md-4 col-form-label text-md-right">{{ __('Profile') }}</label>
                            <div class="col-md-6">
                                <input id="profile" type="text" class="form-control @error('profile') is-invalid @enderror" name="profile" value="{{ $user->profile }}" required autocomplete="profile" autofocus>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <input type="submit" class="btn btn-primary" value="{{ __('Create') }}">
                                <input type="reset" class="btn btn-danger" value="{{ __('Cancel') }}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
