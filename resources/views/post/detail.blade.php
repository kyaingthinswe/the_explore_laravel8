@extends('master')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-8 ">
            <h4 class="fw-bold mb-4">{{$post->title}}</h4>
            <img src="{{asset('storage/cover/'.$post->cover)}}" class="cover-img rounded w-100 mb-4" alt="">
            <p class="mb-4 post-detail">
                {{$post->description}}
            </p>

           @if($post->galleries->count())
                <div class="row border rounded  p-3 mb-4">
                    <h4 class="text-center fw-bold mb-4">Gallery</h4>
                    @foreach($post->galleries as $gallery)
                        <div class="col-6 col-lg-4 col-xl-3 justify-content-center px-2 mb-3">
                            <a class="venobox" data-gall="myGallery" href="{{asset('storage/gallery/'.$gallery->photo)}}">
                                <img src="{{asset('storage/gallery/'.$gallery->photo)}}" class="rounded gallery " alt="">
                            </a>
                        </div>
                        @endforeach
                </div>
               @endif

            <div class="row justify-content-center mb-3">
                <div class="col-lg-8 ">
                    <h4 class="text-center fw-bold">User Comments</h4>
                    <div>
                        @forelse($post->comments as $comment)
                        <div class="d-flex justify-content-center align-items-center mb-3">
                            <img src="{{asset($comment->user->profile)}}" class="user-img rounded-circle" alt="">
                            <div class="ms-1 message-box d-flex justify-content-between">
                                <p class="ms-2 mb-0 small " >
                                    <i class="fas fa-user text-black-50"></i>
                                    {{$comment->user->name}}
                                    <br>
                                    {{$comment->message}}

                                    <br>
                                    <span class="mt-2">{{$comment->created_at->diffforhumans()}}</span>
                                </p>
                                @can('delete',$comment)
                                    <div class="dropdown">
                                        <button class="btn btn-light p-0 " type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-ellipsis-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                            <li>

                                                <form id="delComment" action="{{route('comment.destroy',$comment->id)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button  class="dropdown-item" >
                                                        Delete
                                                    </button>
                                                </form>
                                            </li>
                                            <li><a href="#" class="dropdown-item" type="button">Edit</a></li>
                                        </ul>
                                    </div>
                                @endcan
                            </div>
                        </div>

                        @empty
                            <p class="fw-bold text-black-50 text-center">
                                There is no comment yet!
                                @auth
                                    Start comment now.
                                @endauth
                                @guest
                                    <a href="{{route('login')}}">Login</a> to comment
                                @endguest
                            </p>

                        @endforelse
                    </div>
                    @auth

                    <form action="{{route('comment.store')}}" method="post" id="comment-create">
                        @csrf
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        <div class="form-floating ">
                            <textarea class="form-control" style="height: 70px;" name="message" id="comment"></textarea>
                            <label for="comment">Comments</label>
                        </div>
                        <div class="text-center mt-3">
                            <button class="btn btn-primary px-3">Create</button>
                        </div>
                    </form>
                </div>
            </div>
            @endauth
            <div class="d-flex justify-content-between align-items-center mb-4 border rounded p-4">
                <div class="d-flex">
                    <img src="{{asset($post->user->profile)}}" class="user-img rounded-circle" alt="">
                    <p class="ms-2 mb-0 small">
                        <i class="fas fa-user"></i>
                        {{$post->user->name}}
                        <br>
                        {{$post->created_at->format('D-M-Y')}}
                    </p>
                </div>
                <div>
                    <a href="{{route('index')}}" class="btn btn-outline-primary px-4 ">See All</a>
                   @auth
                        @can('update',$post)
                            <a href="{{route('post.edit',$post->id)}}" class="btn btn-outline-secondary  px-4 ">
                                <i class="fas fa-edit fa-fw"></i>
                            </a>
                        @endcan

                        @can('delete',$post)
                            <form action="{{route('post.destroy',$post->id)}}" method="post" class="d-inline-block ">
                                @csrf
                                @method('delete')
                                <button class="btn btn-outline-danger px-4 ">
                                    <i class="fas fa-trash-alt fa-fw"></i>
                                </button>
                            </form>
                        @endcan
                    @endauth
                </div>


            </div>


        </div>
    </div>
</div>
@stop


