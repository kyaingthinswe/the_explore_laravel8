@extends('master')
@section('title') Edit Profile @endsection
@section('content')

    <div class="container">
        <div class="row justify-content-center min-vh-100">
            <div class="col-lg-6 col-xl-5 ">
                <div class=" mb-4 text-center ">
                    <div class="position-relative d-flex justify-content-center mb-3">
                        <button class="btn btn-primary btn-sm position-absolute edit-btn " style="bottom:-10px;  " >
                            <i class="fa fa-edit fa-fw "></i>
                        </button>
                        <img src="{{asset(auth()->user()->profile)}}" class="profile-image" alt="">
                    </div>
                    <p class="mb-0">{{auth()->user()->name}}</p>
                    <small class="fw-bold text-black-50">{{auth()->user()->email}}</small>
                </div>
                <form action="{{route('update-profile')}}" method="post" enctype="multipart/form-data" class="text-center">
                    @csrf
                    <input type="file" name="profile" accept="image/jpeg,image/png" class="d-none">
                    <div class="form-floating mb-3">
                        <input type="text" name="name" value="{{old('name',auth()->user()->name)}}" class="form-control @error('name') is-invalid @enderror" id="name" >
                        <label for="name">User Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input disabled type="email" value="{{old('email',auth()->user()->email)}}" class="form-control @error('email') is-invalid @enderror" id="email" >
                        <label for="email">User Email</label>
                    </div>
                    <button class="btn btn-primary btn-lg rounded">Update Profile</button>
                </form>
            </div>
        </div>
    </div>

    @stop
@push('script')
    <script>
        let editBtn = document.querySelector('.edit-btn');
        let profile = document.querySelector('[name= "profile"]');
        let profileImage = document.querySelector('.profile-image');

        editBtn.addEventListener('click', _=> profile.click());
        profile.addEventListener('change',function () {
            let reader = new FileReader();
            let file = profile.files[0];
            // console.log(file);
            reader.onload = function () {
                profileImage.src = reader.result;
            }
            reader.readAsDataURL(file);
        })

    </script>
@endpush
