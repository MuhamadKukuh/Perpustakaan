@extends('Template.Auth.main')
@section('authContent')
<div class="container-login100" style="background-image: url('/loginstyle/images/bg-01.jpg');">
    <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
        <form class="login100-form validate-form" action="login" method="post">
            @csrf
            <span class="login100-form-title p-b-49">
                Login
            </span>

            
            <div class="container-login100-form-btn">
                <div class="wrap-login100-form-btn">
                    <div class="login100-form-bgbtn"></div>
                    @if (session()->has('error'))
                    <div class="login100-form-btn alert alert-dismissible fade show" role="alert">
                        <strong><i class="fa-solid fa-triangle-exclamation"></i></strong> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                </div>
            </div>
            

            
            <div class="container-login100-form-btn">
                <div class="wrap-login100-form-btn">
                    <div class="login100-form-bgbtn"></div>
                    @if (session()->has('succes'))
                    <div class="login100-form-btn alert alert-dismissible fade show" role="alert">
                        <strong><i class="fa-solid fa-circle-check"></i> {{ session('succes') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                </div>
            </div>
            
            

            <div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
                <span class="label-input100">Email
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </span>
                <input class="input100" type="email" name="email" value="{{ old('email') }}" placeholder="Type your username" >
                <span class="focus-input100" data-symbol="&#x2709;"></span>
            </div>

            <div class="wrap-input100 validate-input" data-validate="Password is required">
                <span class="label-input100">Password</span>
                <input class="input100" type="password" name="password" placeholder="Type your password">
                <span class="focus-input100" data-symbol="&#xf190;"></span>
            </div>
            
            <div class="text-right p-t-8 p-b-31">
                <a href="#">
                    Forgot password?
                </a>
            </div>
            
            <div class="container-login100-form-btn">
                <div class="wrap-login100-form-btn">
                    <div class="login100-form-bgbtn"></div>
                    <button class="login100-form-btn">
                        Login
                    </button>
                </div>
            </div>

            <div class="flex-col-c p-t-155">
                <span class="txt1 p-b-17">
                    Or Sign Up Using
                </span>

                <a href="/register" class="txt2">
                    Sign Up
                </a>
            </div>
        </form>
    </div>
</div>
@endsection