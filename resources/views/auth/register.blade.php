@extends('layouts.app')
@section('title')
    Register
@endsection
@push('custom-style')
    <link href="https://fonts.googleapis.com/css2?family=Exo:wght@800&family=Montserrat&display=swap" rel="stylesheet">

    <style>
        .background-image {
            background-image: url("/images/erik-mclean-wZhvCWJuTcQ-unsplash.jpg");
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

        .btn-link {
            top: -4px;
            position: relative;

        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 border-left-green">
            <div class="box container" style="position: unset">

                <h4 class="header">{{ __('Register') }}</h4>
                <p style="padding-top: 10px;line-height:inherit">Already have an account? <a href="/login"
                        class="btn btn-link p-0">Log In</a></p>

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

                        <button type="submit" class="btn btn-primary mt-3 w-100">
                            {{ __('Register') }}
                        </button>

                    </div>
                    <div class="mrg-top-8 mrg-bottom-8">
                    </div>
                </form>
                <p class="c-legalNotice a container">
                    ©2001–2024 All Rights Reserved. Restaurant is a registered trademark of The Rocket Science Group, LLC.
                    Cookie
                    Preferences, Privacy, and Terms.
                </p>
            </div>
        </div>
        <div class="col-lg-8 col-md-7 hidden-xs hidden-sm relative">
            <div class="background-image"></div>

        </div>
    </div>

    @push('custom-script')
    @endpush
@endsection
