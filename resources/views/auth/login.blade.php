@extends('layouts.app')
@section('title')
    Login
@endsection
@push('custom-style')
    <style>
        .background-image {
            background-image: url("/images/kaizen-nguy-n-jcLcWL8D7AQ-unsplash.jpg");
            height: 600%;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            position: absolute;
            height: 100%;
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        nav,
        footer {
            display: none !important
        }

        .invalid-feedback {
            text-align: left
        }

        .logo {
            width: 41px;
            margin-left: 10px;
            margin-top: 5px;
        }

        .relative {
            position: relative;
        }

        .box {
            margin: 140px 5px !important;
            position: relative
        }

        .header {
            font-family: "Means Web", Georgia, Times, "Times New Roman", serif;
            font-size: 3rem;
            margin-bottom: 6px;
            text-transform: capitalize;
            line-height: 1.1;
        }

        .border-left-green {
            border-left: 16px solid #dc5119 !important;
            background-color: #f9f9f9;
            min-height: 760px;
            position: relative;
            padding: 10px 19px 10px 10px !important
        }

        body {
            overflow-x: hidden;
            overflow: hidden
        }

        .a {
            position: absolute !important;
            bottom: 0;
            left: 3px;
        }

        form {
            margin-top: 30px
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 border-left-green">
            {{-- <img src="images/WhatsApp.PNG" class="logo" alt=""> --}}
            <div class="box container" style="position: unset">

                <h4 class="header">{{ __('Login') }}</h4>
                <p>
                    Welcome back! We're delighted to see you return to our platform.
                </p>
                </p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf


                    <label for="email" class="mrg-bottom-8">{{ __('Email Address') }}</label>
                    <div class="text-center ">
                        <input id="email" placeholder="Email" type="email"
                            class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <label for="password" class="mrg-bottom-8  mrg-top-8">{{ __('Password') }}</label>

                    <div class="text-center ">
                        <input id="password"placeholder="Password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row mb-12 ">
                        <div class="col-md-12 offset-md-12 mrg-top-8 mrg-bottom-8">
                            <div class="form-check  mrg-top-8">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label " for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-12 offset-md-12 mrg-top-8 ">
                            @isset($filed)
                                <div class="alert alert-danger mb-10" role="alert">
                                    {{ $filed }}
                                </div>
                            @endisset
                            <button type="submit" class="btn btn-primary w-100 mt-3">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link mt-2" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>


                    @isset($filed)
                        <div class="alert alert-danger" role="alert">
                            {{ $filed }}
                        </div>
                    @endisset

                </form>

            </div>
            <p class="c-legalNotice a container">
                ©2001–2024 All Rights Reserved. Restaurant is a registered trademark of The Rocket Science Group, LLC.
                Cookie
                Preferences, Privacy, and Terms.
            </p>
        </div>
        <div class="col-lg-8 col-md-7 hidden-xs hidden-sm relative">
            <div class="background-image"></div>

        </div>
    </div>
    <link href="https://fonts.googleapis.com/css2?family=Exo:wght@800&family=Montserrat&display=swap" rel="stylesheet">





    @push('custom-script')
        {{-- <script>
        $(document).ready(function(){
            
            $.ajax({
            method: "get",
            url: "/Cookies/checkAcceptCookie",
            data:{
            }
            }).done(function(data) {
            //var data1=JSON.parse(data);
            if(data == 1){
              $('.cookie-popup').fadeIn(500);
            }  
            });
        })
        $('.cookie-popup-accepted').click(function(){
            $.ajax({
            method: "get",
            url: "/Cookies/AcceptUserCookie",
            data:{
            }
            }).done(function(data) {
            //var data1=JSON.parse(data);
           
              $('.cookie-popup').hide();
           
            });
        })
        $('.cookie-popup-not-accepted').click(function(){
              $('.cookie-popup').hide();
            });
   
    </script> --}}
    @endpush
@endsection
