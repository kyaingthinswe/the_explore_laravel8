@extends('master')
@section('title') Login @endsection
@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class=" col-10 col-md-6 col-lg-4">
            <div class="text-center">
                <h2 class="text-center ">Sign In</h2>
                <p class="text-center text-black-50 mb-2">
                    Don't have an account yet?
                    <a href="{{ route('register') }}">Sign up here</a>
                </p>
                <a href="#" class="btn btn-lg btn-outline-primary btn-block">
                    <i class="feather-log-in"></i>
                    Sign in with Google
                </a>
                <hr class="mb-2">
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group ">
                    <label for="email" class="mb-2">
                        <i class="fa fa-envelope fa-fw me-2 text-primary"></i>User Email
                    </label>
                    <input type="email" name="email"  value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="email" required autocomplete="email" autofocus >
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group my-3">
                    <label for="password" class="mb-2">
                        <i class="fa fa-unlock-keyhole fa-fw me-2 text-primary"></i> Password
                    </label>

                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
                <div class=" mt-3">
                    <button type="submit" class="btn btn-primary px-3 w-100">
                        Sign In
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
