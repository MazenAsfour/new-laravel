@extends('layouts.app')
@section("title")
Verify Account
@endsection
@push('custom-style')
    <style>
        body {
            width: 100%;
            height: 100%;
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
            background-image: url("/images/christian-lambert-lOXhHLWP1NE-unsplash.jpg");

        }

        nav,
        footer {
            display: none !important
        }
    </style>
@endpush
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="padding: 10px 20px;margin-top:30px;min-height:200px">
                    <div class="card-header" style="background: unset">{{ __('Verify Your Email Address') }}</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},
                        <form class="d-inline" method="POST" style="margin-top: 100px !important"
                            action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit"
                                class="btn btn-link p-0 m-0 align-baseline">{{ __('Click here to request another') }}</button>
                        </form>
                        <a href="/logout" style="margin-left: 10px">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
