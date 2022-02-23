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
    <div class="bg-primary p-4"></div>

@stop
