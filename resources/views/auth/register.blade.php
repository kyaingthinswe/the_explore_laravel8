@extends('master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="text-center">
                <h2 class="text-center font-weight-normal">Create Account</h2>
                <p class="text-center text-black-50 mb-4">
                    Already have an account?
                    <a href="{{ route('login') }}">Sign in here</a>
                </p>
                <a href="#" class="btn btn-lg btn-outline-secondary btn-block">
                    <i class="feather-log-in"></i>
                    Sign in with Google
                </a>
                <hr class="mb-3">
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="mb-2">
                        <i class="fa fa-user fa-fw text-primary me-2"></i> User Name
                    </label>

                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="email" class="mb-2">
                        <i class="fa fa-envelope fa-fw text-primary me-2"></i> Email
                    </label>

                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class=" mb-3">
                    <label for="password" class="mb-2">
                        <i class="fa fa-unlock-keyhole fa-fw text-primary me-2"></i> Password
                    </label>

                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password-confirm" class="mb-2">
                        <i class="fa fa-unlock-keyhole fa-fw text-primary me-2"></i> Confirm Password
                    </label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            I accept the Term and Condition
                        </label>
                    </div>
                </div>

                <div class="mt-3 mb-5">
                    <button type="submit" class="btn btn-primary  w-100">
                        Sing Up
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
