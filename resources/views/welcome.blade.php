@extends('layouts.app')
@push('custom-style')
    <link rel="stylesheet" href="{{ asset('newtheme/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('newtheme/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('newtheme/css/style.css') }}">
@endpush
@section('content')
    <div class="overlay">

    </div>

    <!-- banner part start-->
    <section class="banner_part">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="banner_text">
                        <div class="banner_text_iner">
                            <h5>Expensive but the best</h5>
                            <div id="qrcode-container">
                                <h1 class="Expensive">Scan the QR Code</h1>
                                <div id="qrcode"></div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('custom-scripts')
        <!-- Include qrcode.min.js first -->
        <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
        <!-- Then include your custom JavaScript files -->
        <script src="{{ asset('newtheme/js/script.js') }}" defer></script>
        <!-- Add more JS files as needed -->
    @endpush
@endsection
