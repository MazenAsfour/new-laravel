<!-- resources/views/enter-password.blade.php -->

@extends('layouts.app')

@push('custom-style')
    <link rel="stylesheet" href="{{ asset('newtheme/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('newtheme/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('newtheme/css/style.css') }}">

    <style>
        #app {
            height: 100vh;
        }

        form {
            background-color: #fff;
            /* Set your desired background color */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 50%;
        }

        label {
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ced4da;
            /* Set your desired border color */
            border-radius: 4px;
        }

        button {
            background-color: #007bff;
            /* Set your desired button color */
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
            /* Set your desired button hover color */
        }
    </style>
@endpush

@section('content')
    <form id="passwordForm" action="{{ route('addPoints', ['userid' => $userId]) }}" method="post">
        @csrf
        <label for="password">Enter Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Submit</button>
    </form>

    @push('custom-script')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('passwordForm').addEventListener('submit', function(event) {
                    event.preventDefault();

                    // Use FormData to send the form data including the CSRF token
                    const formData = new FormData(this);

                    fetch(this.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                jQuery("#password").val('');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Point added successfully!',
                                    showConfirmButton: false,
                                    timer: 1500
                                });

                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Failed to add point. Please try again.',
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                });
            });
        </script>
    @endpush
@endsection
