@extends('Template.Auth.main')
@section('authContent')
<div class="container-login100" style="background-image: url('/loginstyle/images/bg-01.jpg');">
    <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
        <form class="login100-form validate-form" method="post" action="/register">
            <span class="login100-form-title p-b-49">
                Sign Up
            </span>
            @csrf
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
            <div class="wrap-input100 validate-input m-b-23" data-validate = "Nis is reauired">
                <span class="label-input100">Nis
                    @error('nis')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </span>
                <input class="input100 @error('nis') is-invalid @enderror" type="number" name="nis" placeholder="Type your NIS" value="{{ old('nis') }}">
                <span class="focus-input100" data-symbol="&#xf170;"></span>
            </div>

            <div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
                <span class="label-input100">Username
                    @error('username')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </span>
                <input class="input100 @error('username') is-invalid @enderror" type="text" name="username" placeholder="Type your username" 
                   value=" {{ old('username') }}"> 
                <span class="focus-input100" data-symbol="&#xf206;"></span>
            </div>


            <div class="validate-input m-b-23">
                <span class="label-input100">Class
                </span>
                    <div class="dropdown container-login100-form-btn" style="margin-left: 50px">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                                <select name="kelas" id="" class="btn login100-form-btn dropdown-toggle text-white" type="button">
                                    @foreach ($kelas as $item)
                                        <option value="{{ $item->id_kelas }}" style="background-color: #d59bf6">{{ $item->kelas }}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                <span class="focus-input100" data-symbol="&#xf112;"></span>
            </div>

            <div class="validate-input m-b-23">
                <span class="label-input100">Genders
                </span>
                    <div class="dropdown container-login100-form-btn" style="margin-left: 50px">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                                <select name="gender" id="" class="btn login100-form-btn dropdown-toggle text-white" type="button">
                                    @foreach ($gender as $gen)
                                        <option value="{{ $gen->id_gender }}" style="background-color: #d59bf6">{{ $gen->gender }}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                <span class="focus-input100" data-symbol="&#xf211;"></span>
            </div>

            <div class="wrap-input100 validate-input m-b-23" data-validate ="Email is required">
                <span class="label-input100">Email
                    @error('email')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </span>
                <input class="input100 @error('email') is-invalid @enderror" type="email" name="email" placeholder="Type your email" value="{{ old('email') }}">
                <span class="focus-input100" data-symbol="&#x2709;"></span>
            </div>



            <div class="wrap-input100 validate-input m-b-23" data-validate="Password is required">
                
                <span class="label-input100">Password
                    @error('password')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </span>
                <input class="input100 @error('password') is-invalid @enderror" type="password" name="password" placeholder="Type your password">
                <span class="focus-input100" data-symbol="&#xf190;"></span>
            </div>

            <div class="wrap-input100 validate-input" data-validate="Retype Password is required">
                <span class="label-input100">Retype Password</span>
                <input class="input100" type="password" name="password2" placeholder="Retype your password">
                <span class="focus-input100" data-symbol="&#xf190;"></span>
            </div>
            
            <div class="text-right p-t-8 p-b-31">
                <a href="/">
                    Have account?
                </a>
            </div>
            
            <div class="container-login100-form-btn">
                <div class="wrap-login100-form-btn">
                    <div class="login100-form-bgbtn"></div>
                    <button class="login100-form-btn">
                        Sign Up
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection