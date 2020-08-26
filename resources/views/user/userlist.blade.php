@extends('layouts.app')

@section('users-active', 'active')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <form action="{{ route('users#search') }}" method="POST" role="search">
        {{ csrf_field() }}
        <div class="row">
          <div class="col-lg-3 col-md-6 col-12 mb-2">
            <input type="text" class="form-control" name="name" placeholder="Name" value="@if(isset($name)) {{ $name }} @endif">
          </div>
          <div class="col-lg-3 col-md-6 col-12 mb-2">
            <input type="text" class="form-control" name="email" placeholder="Email" value="@if(isset($email)) {{ $email }} @endif">
          </div>
          <div class="col-lg-3 col-md-6 col-12 mb-2">
            <input type="date" class="form-control" name="createdfrom" placeholder="Created From" value=@if(isset($createdfrom)) {{ $createdfrom }} @endif>
          </div>
          <div class="col-lg-3 col-md-6 col-12 mb-2">
            <input type="date" class="form-control" name="createdto" placeholder="Created To" value=@if(isset($createdto)) {{ $createdto }} @endif>
          </div>
          <div class="col-lg-3 col-md-3 col-4 mb-2"><input type="submit" class="btn btn-primary display-block w-100 pd-2" value="Search"></div>
          @auth
            <div class="col-lg-3 col-md-3 col-4 mb-2"><a href="{{ route('register') }}" class="btn btn-primary w-100 pd-2">Add</a></div>
          @endauth
        </div>
      </form>
      @if(isset($userList))
        @if(sizeof($userList) > 0)
          <div class="table-responsive">
            <table class="table table-bordered text-nowrap">
              <thead class="text-center">
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Created User</th>
                  <th>Phone</th>
                  <th>Birth Date</th>
                  <th>Address</th>
                  <th>Created Date</th>
                  <th>Updated Date</th>
                  @auth
                    <th colspan="2">Actions</th>
                  @endauth
                </tr>
              </thead>
              <tbody>
                @foreach($userList as $user)
                  <tr>
                    <td>{{ $user -> name }}</td>
                    <td>{{ $user -> email }}</td>
                    <td>{{ $user -> user -> name }}</td>
                    <td>{{ $user -> phone }}</td>
                    <td>{{ $user -> dob }}</td>
                    <td>{{ $user -> address }}</td>
                    <td>{{ $user -> created_at }}</td>
                    <td>{{ $user -> updated_at }}</td>
                    @auth
                      <td><a href="{{ route('users#edit', $user->id) }}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Edit</a></td>
                      <td><a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-user{{$user->id}}"><i class="fa fa-trash"></i> Delete</td>
                      <div class="modal fade" id="delete-user{{$user->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header border-0 bg-danger text-white">
                              <h5 class="modal-title"><i class="fa fa-trash"> Delete User!</i></h5>
                              <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              Are you sure to delete this record?
                            </div>
                            <div class="modal-footer border-0">
                              <a href="{{ route('users#delete', $user->id) }}" type="button" class="btn btn-danger">Confirm</a>
                              <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endauth
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @else
          <div class="card border-danger mt-3">
            <div class="card-header bg-danger text-white">{{ __('No User available') }}</div>
              <div class="card-body text-secondary">
                {{ $message }}
              </div>
            </div>
          </div>
        @endif
      @endif
      @if($userList instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <center>{!! $userList->render() !!}</center>
      @endif 
    </div>
  </div>
</div>
@endsection
