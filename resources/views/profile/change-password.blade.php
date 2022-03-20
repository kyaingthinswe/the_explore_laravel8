@extends('master')
@section('title') Edit Profile @endsection
@section('content')

    <div class="container">
        <div class="row justify-content-center min-vh-100">
            <div class="col-lg-6 col-xl-5 ">
                <div class=" mb-4 text-center ">
                    <img src="{{asset(auth()->user()->profile)}}" class="profile-image" alt="">
                    <p class="mb-0">{{auth()->user()->name}}</p>
                    <small class="fw-bold text-black-50">{{auth()->user()->email}}</small>
                </div>
                <form action="{{route('update-password')}}" method="post" class="text-center">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="password" name="old_password" value="{{old('old_password')}}"  class="form-control @error('old_password') is-invalid @enderror" id="old_password" >
                        <label for="old_password">Current Password</label>
                        @error('old_password')
                        <small class="invalid-feedback text-danger fw-bold">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="password" value="{{old('password')}}" class="form-control @error('password') is-invalid @enderror" id="password" >
                        <label for="password">New Password</label>
                        @error('password')
                        <small class="invalid-feedback text-danger fw-bold">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="password_confirmation" value="{{old('password_confirmation')}}" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" >
                        <label for="password_confirmation">Confirm Password</label>
                        @error('password_confirmation')
                        <small class="invalid-feedback text-danger fw-bold">{{$message}}</small>
                        @enderror
                    </div>

                    <button class="btn btn-primary btn-lg rounded ">
                        Change Password
                    </button>
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
