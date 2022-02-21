@extends('master')
@section('content')

<div class="container">
    <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8 ">
                @auth
                <div class="d-flex justify-content-between align-items-center border rounded-3 p-4 mb-4">
                    <h4 class="text-black-50 fw-bolder">
                        Welcome
                        <br>
                        <span class="text-dark" >{{auth()->user()->name}}</span>
                    </h4>
                    <a href="{{route('post.create')}}" class="btn btn-lg btn-primary  ">Create Post</a>
                </div>

             @endauth

                <div class="posts ">
                    @forelse($posts as $post)
                <div class="post mb-4">
                    <div class="row">
                        <div class="col-lg-4 ">
                            <img src="{{asset('storage/cover/'.$post->cover)}}" class="cover-img rounded w-100" alt="">
                        </div>
                        <div class="col-lg-8 py-4 h-350 d-flex flex-column justify-content-between">
                            <div class="">
                                <h4>{{$post->title}}</h4>
                                <p>
                                    {{$post->excerpt}}
                                </p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex">
                                    <img src="{{asset($post->user->profile)}}" class="user-img rounded-circle" alt="">
                                    <p class="ms-2 mb-0 small">
                                        <i class="fas fa-user"></i>
                                        {{$post->user->name}}
                                        <br>
                                        {{$post->created_at->format('D-M-Y')}}
                                    </p>
                                </div>
                                <a href="#" class="btn btn-outline-primary">See More</a>
                            </div>
                        </div>
                    </div>

                </div>
                    @empty
                    <h4>There is no post</h4>
                    @endforelse
            </div>
            </div>
    </div>
</div>

    @stop
