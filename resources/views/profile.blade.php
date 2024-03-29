@extends('layouts.app')
@push('custom-style')
<link rel="stylesheet" href="{{ asset('newtheme/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('newtheme/css/all.css') }}">
<link rel="stylesheet" href="{{ asset('newtheme/css/style.css') }}">
<style>
h5 {
    font-size: 34px !important;
    font-weight: 600 !important;
    line-height: 36px;
    margin-bottom: 15px !important;
}

p {
    font-family: "Lora", serif !important;

    margin-bottom: 20px !important;

}

#qrcode-container {
    margin-top: 30px
}

.modal {
    z-index: 9999999999999999;
}

.modal-title {
    font-size: 20px !important;

}

@media only screen and (max-width: 600px) {
    .order-cstm-2 {
        margin-bottom: 20px;
        order: 2 !important;
    }

    .banner_part .banner_text {
        height: auto;
        max-height: 100vh;
        position: relative;
        z-index: 99;
    }

    .order-sm-1 {
        margin-top: 120px !important;
        order: 1
    }

    .overlay {
        position: fixed;
    }

}

#request_point {

    padding: 14px 25px 14px 25px !important;
    cursor: pointer;
}

.notice-request {
    display: none;
}

@media(max-width:600px) {
    .banner_part {
        min-height: 100vh;
        padding-top: 116px;
    }
}
</style>
<link rel="stylesheet" href="{{ asset('newtheme/css/card.css') }}">
@endpush
@section('content')
<div class="overlay">

</div>
<section class="banner_part">
    <div class="container">
        <input type="hidden" name="user_id" id="user_id_profile" value="{{ Auth::user()->id }}">
        <div class="row align-items-center">
            <div class="col-lg-6 order-cstm-2">
                <div class="banner_text">
                    <div class="banner_text_iner">
                        <h5>Welcome, {{ Auth::user()->name }}, to Restaurant – Where Every Meal Tells a Story</h5>
                        <p class="Expensive text-small">Scan our QR code at your table for instant access to our digital
                            menu and exclusive offers.
                            Enjoy a seamless and hygienic dining experience with this innovative, contactless solution.
                        </p>

                        <div id="qrcode-container">
                            <div id="qrcode"></div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <div class="modal fade modal-update" id="" tabindex="-1" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog d-flex justify-content-center">
                <div class="modal-content w-100">
                    <div class="modal-header">
                        <h5 class="modal-title mb-0" id=""> Update Card </h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" onclick="hideModal()"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3">
                        <form id="form-update" action="/update-card" method="POST">
                            @csrf

                            <div class="form-outline ">
                                <label class="form-label" id=""> Card Number</label>
                                <input type="text" id="card" placeholder="0000 0000 0000 0000" name="card" required
                                    class="form-control visa-number" maxlength="19" />
                            </div>
                            <div class="alert m-2 alert-success d-none" style="padding:8px 12px;font-size:14px"
                                role="alert">
                                Updated Successfully
                            </div>
                    </div>
                    <div class="modal-footer p-1">

                        <div class="spinner-border spinner-border-sm d-none" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <button type="submit" class="btn btn-primary ">Update
                        </button>
                    </div>


                    </form>
                </div>
            </div>
        </div>
    </div>


    @push('custom-scripts')
    <script>
    function hideModal() {
        $('.modal-update').modal("hide");

    }

    function lanuchModalUpdate() {
        $('.modal-update').modal("show");

    }


    document.addEventListener('DOMContentLoaded', function() {
        // Get the user ID from the hidden input
        var userId = document.getElementById('user_id_profile').value;

        // Create a QR code with the target URL
        var qr = new QRCode(document.getElementById("qrcode"), {
            text: "{{ url('/addPoints/') }}/" + userId, // Construct the URL with the user ID
            width: 128,
            height: 128
        });

        // Show SweetAlert notification when the "Request Point Now" button is clicked


        // Optionally, you can disable the button or update UI to prevent multiple requests

    });
    </script>

    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <script src="{{ asset('newtheme/js/script.js') }}" defer></script>
    @endpush
    @endsection