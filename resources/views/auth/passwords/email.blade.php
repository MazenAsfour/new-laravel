@extends('layouts.app')
@section("title")
Reset Password
@endsection
@push('custom-style')
    <style>
        .background-image {
            background-image: url("/images/shawn-lee-0sSJMTfLXUI-unsplash.jpg");
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

        .logo {
            width: 41px;
            margin-left: 10px;
            margin-top: 5px;
        }

        .relative {
            position: relative;
        }

        .box {
            margin: 200px 5px !important;
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

                <h4 class="header">{{ __('Reset Password') }}</h4>
                <p style="padding-top:6px;padding-left:3px">{{ __('Below the form attached to send reset password link.') }}
                </p>

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <label for="email">{{ __('Email Address') }}</label>

                    <input id="email" placeholder="Email" type="email"
                        class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                        required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    @if (session('status'))
                        <div class="alert alert-success" style="margin: 10px 0" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <button type="submit" class="btn btn-primary w-100 mt-20" style="font-size: 16px !important">
                        {{ __('Send Password Reset Link') }}
                    </button>
                    <a href="/" type="button" class="btn btn-link">Return To Login</a>

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
    @endpush
@endsection
