@extends('layouts.app')
@section("title")
Register
@endsection
@push('custom-style')
    <style>
        .background-image {
            background-image: url("/images/franck-morisset-UFhM8kMuQbo-unsplash.jpg");
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

        .invalid-feedback {
            text-align: left
        }

        nav,
        footer {
            display: none !important
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
            margin: 100px 5px !important;
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
            border-left: 16px solid #aa9e6d !important;
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

                <h4 class="header">{{ __('Register') }}</h4>
                <p style="padding-top: 10px;line-height:inherit">Already have an account? <a href="/login">Log In</a></p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mrg-bottom-8 ">
                        <label for="name">{{ __('Name') }}</label>

                        <div class="">
                            <input id="name" placeholder="Full Name" type="text"
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mrg-bottom-8  mrg-top-8">
                        <label for="email">{{ __('Email Address') }}</label>

                        <div class="col-md-12">
                            <input id="email" placeholder="Email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mrg-bottom-8  mrg-top-8">
                        <label for="password">{{ __('Password') }}</label>

                        <div class="col-md-12">
                            <input id="password" placeholder="Password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mrg-bottom-8  mrg-top-8">
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>

                        <div class="col-md-12">
                            <input id="password-confirm" placeholder="Confirm Password" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="mrg-bottom-8" style="margin-top: 20px">

                        <button type="submit" class="btn btn-primary w-100">
                            {{ __('Register') }}
                        </button>

                    </div>
                    <div class="mrg-top-8 mrg-bottom-8">
                        <hr>
                    </div>
                </form>

                <div class="mrg-top-8 mrg-bottom-8">
                    <a href="/login/google" class="google-button" style="width:100%">
                        <div class="google-icon-wrapper ">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="18px" height="18px"
                                viewBox="0 0 48 48">
                                <g>
                                    <path fill="#EA4335"
                                        d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z">
                                    </path>
                                    <path fill="#4285F4"
                                        d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z">
                                    </path>
                                    <path fill="#FBBC05"
                                        d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z">
                                    </path>
                                    <path fill="#34A853"
                                        d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z">
                                    </path>
                                    <path fill="none" d="M0 0h48v48H0z"></path>
                                </g>
                            </svg>
                        </div>
                        <p class="google-button-text">Sign in with Google</p>
                    </a>
                </div>
                </form>

            </div>
            <p class="c-legalNotice a container">
                ©2001–2023 All Rights Reserved. WhatsApp is a registered trademark of The Rocket Science Group, LLC. Cookie
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
