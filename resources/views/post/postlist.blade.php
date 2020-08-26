@extends('layouts.app')

@section('posts-active', 'active')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <form action="{{ route('posts#search') }}" method="POST" role="search">
        {{ csrf_field() }}
        <div class="row">
          <div class="col-lg-4 col-md-8 col-8 mb-2">
          <input type="text" class="form-control" name="q" value="@if(isset($q)) {{ $q }} @endif">
          </div>
          <div class="col-lg-2 col-md-4 col-4 mb-2"><input type="submit" class="btn btn-primary display-block w-100 pd-2" value="Search"></div>
          @auth
            <div class="col-lg-2 col-md-4 col-4 mb-2"><a href="{{ route('posts#create') }}" class="btn btn-primary w-100 pd-2">Add</a></div>
            <div class="col-lg-2 col-md-4 col-4 mb-2"><a href="{{ route('posts#showUpload') }}" class="btn btn-primary w-100 pd-2">Upload</a></div>
            <div class="col-lg-2 col-md-4 col-4 mb-2"><a href="{{ route('posts#download') }}" class="btn btn-primary w-100 pd-2">Download</a></div>
          @endauth
        </div>
      </form>
      @if(isset($postList))
        @if(sizeof($postList) > 0)
          <div class="table-responsive">
            <table class="table table-bordered text-nowrap">
              <thead class="text-center">
                <tr>
                  <th>Post Title</th>
                  <th>Post Description</th>
                  <th>Posted User</th>
                  <th>Posted Date</th>
                  @auth
                    <th colspan="2">Actions</th>
                  @endauth
                </tr>
              </thead>
              <tbody>
                @foreach($postList as $post)
                  <tr>
                    <td><a href="#" data-toggle="modal" data-target="#post-detail{{ $post->id }}">{{ $post -> title }}</td>
                    <div class="modal fade" id="post-detail{{$post->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content position-relative">
                          @if ($post->status == "1") 
                            <span class="badge badge-success position-absolute" 
                              style="top: 0; left: 0; margin-top: -5px; margin-left: -5px;">
                              Published
                            </span>
                          @else 
                            <span class="badge badge-danger position-absolute" 
                              style="top: 0; left: 0; margin-top: -5px; margin-left: -5px;">
                              UnPublished
                            </span>
                          @endif
                          <div class="modal-header border-0">
                            <h6 class="modal-title" style="width: 80%;">
                              <img class="rounded-circle float-left" 
                                @if (App\Util\StringUtil::isEmptyString( $post->user->profile ))
                                  src="{{ asset('images/nullimage.jpg') }}"
                                @else
                                  src="{{ asset('uploads/'.$post->user->profile) }}" 
                                @endif
                                style="width: 60px; height: 60px; margin-right: 10px;">
                              <span class="text-justified d-block mt-2 font-weight-bold" style="line-height: 20px; font-size: 90%;">
                                {{ $post->user->name }}
                              </span>
                              <span class="text-secondary small" style="line-height: 10px;">Updated at 
                                <?php 
                                  echo date_format($post->updated_at, 'Y-m-d');
                                ?>
                              </span>
                            </h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p class="font-weight-bold">&OpenCurlyDoubleQuote;{{ $post->title }}&CloseCurlyDoubleQuote;</p>
                            <p class="text-justified text-secondary font-weight-bold">{{ $post->description }}</p>
                          </div>
                          <div class="modal-footer border-0">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <td>
                      <?php 
                        $description = $post -> description;
                        $description = strlen($description) > 15 ? substr($description, 0, 15)."..." : $description; 
                    ?>
                    {{ $description }}</td>
                    <td>{{ $post -> user -> name }}</td>
                    <td>{{ $post -> created_at }}</td>
                    @auth
                      <td><a href="{{ route('posts#edit', $post -> id) }}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Edit</a></td>
                      <td><a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-post{{$post->id}}"><i class="fa fa-trash"></i> Delete</td>
                      <div class="modal fade" id="delete-post{{$post->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header border-0 bg-danger text-white">
                              <h5 class="modal-title"><i class="fa fa-trash"> Delete Post!</i></h5>
                              <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              Are you sure to delete this record?
                            </div>
                            <div class="modal-footer border-0">
                              <a href="{{ route('posts#delete', $post->id) }}" type="button" class="btn btn-danger">Confirm</a>
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
            <div class="card-header bg-danger text-white">{{ __('No post available') }}</div>
              <div class="card-body text-secondary">
                {{ $message }}
              </div>
            </div>
          </div>
        @endif
      @endif
      @if($postList instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <center>{!! $postList->render() !!}</center>
      @endif
    </div>
  </div>
</div>
@endsection
