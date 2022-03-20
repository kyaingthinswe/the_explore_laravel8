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
                <form action="{{route('post.update',$post->id)}}" id="post-create" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-floating mb-4">
                        <input type="text" name="title" value="{{$post->title}}" id="title" class="form-control @error('title') is-invalid @enderror" >
                        <label for="title">Post Title</label>
                        @error('title')
                        <p class="text-danger fw-bold small">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <input type="file" name="cover"  class="d-none" id="cover">
                        <img src="{{asset('storage/cover/'.$post->cover)}}" class=" cover-img w-100 rounded" id="cover-preview" alt="">
                        @error('cover')
                        <p class="text-danger fw-bold small">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-4">
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description"  id="description" style="height: 400px">{{$post->description}}</textarea>
                        <label for="description">Share Your Review</label>
                        @error('description')
                        <p class="text-danger fw-bold small">{{$message}}</p>
                        @enderror
                    </div>
                </form>

                <div class="border rounded p-3 mb-4 " id="gallery">
                    <div class="d-flex ">
                        <div id="upload-ui" class="border rounded d-flex justify-content-center align-items-center px-5" style="height: 150px; width: 100px" >
                            <i class="fa fa-upload"></i>
                        </div>
                        <div class="d-flex overflow-scroll ms-2" >
                            @foreach($post->galleries as $gallery)
                                <div class="d-inline-block position-relative me-3">
                                    <form action="{{route('gallery.destroy',$gallery->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm position-absolute  rounded-2" style="right:5px; bottom: 5px;">
                                            <i class="fa fa-trash-alt fa-fw"></i>
                                        </button>
                                        <img src="{{asset('storage/gallery/'.$gallery->photo)}}" class="rounded" style="width: 150px; height: 150px; object-fit: cover;"  >

                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <form action="{{route('gallery.store')}}" id="gallery-upload" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        <div>
                            <input type="file" id="gallery-input" accept="image/jpeg" name="galleries[]" class="d-none @error('galleries') is-invalid  @enderror @error('galleries.*') is-invalid  @enderror" multiple >
                            @error('galleries')
                            <div class="invalid-feedback ps-2">{{$message}}</div>
                            @enderror
                            @error('galleries.*')
                            <div class="invalid-feedback ps-2">{{$message}}</div>
                            @enderror
                        </div>
                    </form>

                </div>

                <div class="text-center mb-4" >
                    <button class="btn btn-lg btn-primary " form="post-create">
                        <i class="fas fa-upload fa-fw"></i>
                        Update Post
                    </button>
                </div>
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

        let uploadUi = document.getElementById('upload-ui');
        let galleryInput = document.getElementById('gallery-input');
        let galleryUpload = document.getElementById('gallery-upload');
        uploadUi.addEventListener('click', _=> galleryInput.click());
        galleryInput.addEventListener('change', _=> galleryUpload.submit());

    </script>
@endpush
