@extends('master')
@section('title') Create Post @endsection
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4>Create New Post</h4>
                    <p class="mb-0">
                        <i class="fas fa-calender"></i>
                        {{date('D/M/Y')}}
                    </p>
                </div>
                <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-floating mb-4">
                        <input type="text" name="title" value="{{old('title')}}" id="title" class="form-control @error('title') is-invalid @enderror" >
                        <label for="title">Post Title</label>
                        @error('title')
                        <p class="text-danger fw-bold small">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <input type="file" name="cover" value="{{old('cover')}}" class="d-none" id="cover">
                        <img src="{{asset('sample-cover.jpg')}}"  class=" cover-img w-100 rounded @error('cover')border border-danger is-invalid @enderror" id="cover-preview" alt="">
                        @error('cover')
                        <p class="text-danger fw-bold small">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-4">
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description"  id="description" style="height: 400px">{{old('description')}}</textarea>
                        <label for="description">Share Your Review</label>
                        @error('description')
                        <p class="text-danger fw-bold small">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="text-center mb-4">
                        <button class="btn btn-lg btn-primary ">
                            <i class="fas fa-upload fa-fw"></i>
                            Create Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @stop

@push('script')
    <script>
        let coverPreview = document.querySelector("#cover-preview");
        let cover = document.querySelector('#cover');
        coverPreview.addEventListener('click',function () {
            cover.click();
        })
        cover.addEventListener('change',function () {
            let reader = new FileReader();
            let file = cover.files[0];
            reader.onload = function () {
                coverPreview.src = reader.result;
            }
            reader.readAsDataURL(file);

        })
    </script>

@endpush
