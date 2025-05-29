@extends('admin/layouts.master-without-nav')
@section('title') Login  @endsection
@section('body') <body class="account-pages"> @endsection
@section('content')
    <!-- Begin page -->
    <div class="accountbg" style="background: url('{{asset('assets/images/login.jpg')}}'); background-size: cover;background-position: center;"></div>

    <div class="wrapper-page account-page-full">

        <div class="card shadow-none">
            <div class="card-block">

                <div class="account-box">

                    <div class="card-box shadow-none p-4">
                        <div class="p-2">
                            <div class="text-center mt-4">
                                <a href="index" class="logo logo-dark">
                                    <span class="logo-lg">
                                        
                                    </span>
                                </a>

                                <a href="index" class="logo logo-light">
                                    <span class="logo-lg">
                                       
                                    </span>
                                </a>
                            </div>
                            <h4 class="font-size-18 mt-5 text-center">Dashboard Content Scheduler </h4>
                            <h4 class="font-size-18 mt-5 text-center">Welcome Back !</h4>
                          

                            <form method="POST" action="{{ route('login') }}" class="mt-4">
                            @csrf
                            <div class="mb-3">
                                        <label class="form-label" for="email">{{ __('Email Address') }} <span class="text-danger">*</span></label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="test@example.com" required autocomplete="email" value="admin@themesbrand.com" autofocus placeholder="Enter Email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="userpassword">{{ __('Password') }} <span class="text-danger">*</span></label>
                                        <input id="password" type="password" value="12345678" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                <div class="mb-3 row">
                                    <div class="col-sm-6">
                                    <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                    </div>
                                    <div class="col-sm-6 text-end">
                                        <button type="submit" class="btn btn-primary w-md waves-effect waves-light">
                                                {{ __('Login') }}
                                        </button>
                                    </div>
                                </div>

                                <div class="mb-3 mt-2 mb-0 row">
                                    <div class="col-12 mt-3">
                                    @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}"><i class="mdi mdi-lock"></i>
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                     @endif
                                    </div>
                                </div>

                            </form>

                             

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    @endsection
    @section('scripts')
    <script src="{{URL::asset('assets/js/app.js')}}"></script>
    @endsection
