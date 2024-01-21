@extends('dashboard.layouts.app')
@section('title')
    Users
@endsection
@push('custom-style')
    <style>

    </style>
@endpush
@section('content')
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js" defer="defer"></script>
    <script src="assets/resource/tiny_mce.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js"></script>
    <!-- right content -->
    <div id="content">

        <!-- dashboard inner -->
        <div class="midde_cont">
            <div class="container-fluid">
                <div class="row column_title">
                    <div class="col-md-12">
                        <div class="page_title" style="">
                            <h2 style="display: inline;">Users</h2>
                            <span style="display: inline-block;float:right">
                                {{-- <input class="form-control" id="myInput" type="text"
                                placeholder="Search.."> --}}
                            </span>

                        </div>
                    </div>
                </div>
                <div class="container">

                    <div class="well">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User Profile</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Account Activate</th>
                                    <th>Created At</th>
                                    <th style="width: 15px;"></th>
                                    <th style="width: 15px;"></th>
                                    <th style="width: 15px;"></th>
                                    <th style="width: 15px;"></th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr id="{{ $user->id }}">
                                        <td>{{ $user->id }}</td>
                                        <td><img id="{{ $user->id }}img" src="{{ $user->image }}"
                                                style="width:30px;height:30px;border-radius:100%;object-fit: cover;"class="img-responsive"
                                                alt="#" /></td>
                                        <td id="{{ $user->id }}name">{{ $user->name }}</td>
                                        <td id="{{ $user->id }}email">{{ $user->email }}</td>
                                        @if ($user->email_verified_at == '')
                                            <td>Not activiate yet</td>
                                        @else
                                            <td>{{ $user->email_verified_at }}</td>
                                        @endif
                                        <td>{{ $user->created_at }}</td>
                                        <td><i class="fa fa-user-plus pointer ds-none"
                                                onclick="lanuchModalVerfication('{{ $user->email }}')"
                                                aria-hidden="true"></i></td>
                                        @if ($user->email_verified_at == '')
                                            <td><i class="fa fa-envelope-o pointer"
                                                    onclick="LanuchSendResetPasswordModal('{{ $user->email }}')"
                                                    aria-hidden="true"></i></td>
                                        @else
                                            <td><i class="fa fa-check green pointer" aria-hidden="true"></i></td>
                                        @endif
                                        <td><i class="fa fa-pencil pointer"
                                                onclick="lanuchModalUpdate({{ $user->id }})" aria-hidden="true"></i>
                                        </td>
                                        <td><i class="fa fa-times pointer" onclick="lanuchModalDelete({{ $user->id }})"
                                                aria-hidden="true"></i></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade modal-update" id="staticBackdrop1" tabindex="-1" aria-labelledby="exampleModalLabel1"
            aria-hidden="true">
            <div class="modal-dialog d-flex justify-content-center">
                <div class="modal-content w-75">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">User Inforamtion</h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal"onclick="hideModal()"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form id="form" method="POST" action="/upload-image" enctype="multipart/form-data">
                            <!-- Email input -->
                            @csrf
                            <div class="row">
                                <div class="small-12 medium-2 large-2 columns">
                                    <div class="circle">
                                        <img class="profile-pic" src="{{ $admin[0]->image }}">
                                        <div class="p-image">
                                            <i class="fa fa-camera upload-button"></i>
                                            <input class="file-upload" name="image" type="file" accept="image/*" />
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" id="">Username</label>
                                <input type="text" id="Username" name="name" value='' required
                                    class="form-control" />
                            </div>

                            <!-- password input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" name="email" for="password1">Email</label>
                                <input type="email" name="email" id="Email"required value=''
                                    class="form-control" />
                            </div>
                            <input type="hidden" id="idSelected" name="id" value='' name="">

                            <div class="alert alert-success ds-none" style="padding:8px 12px;font-size:14px" role="alert">
                                Updated User Profile Seccuessfully
                            </div>
                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-delete" id="staticBackdrop1" tabindex="-1" aria-labelledby="exampleModalLabel1"
            aria-hidden="true">
            <div class="modal-dialog d-flex justify-content-center">
                <div class="modal-content w-75">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Account Want To Delete it</h5>
                        <button type="button" class="btn-close" onclick="hideModal()" data-mdb-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        Do You Want To delete This User?
                    </div>
                    <div class="alert alert-success ds-none" style="padding:8px 12px;font-size:14px;margin:0 10px 10px "
                        role="alert">
                        Deleted User Seccuessfully
                    </div>
                    <div class="modal-footer text-right">
                        <button class="btn btn-light" onclick="hideModal()">Cancel</button>
                        <button class="btn btn-primary" onclick="deleteUser()">Confirm And Delete</button>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade modal-verification" id="staticBackdrop1" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog d-flex justify-content-center">
                <div class="modal-content w-75">
                    <div class="modal-header">
                        <h5 class="modal-title">Verification Code</h5>
                        <button type="button" class="btn-close" onclick="hideModal()" data-mdb-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form id="verfication-code" action="/dashboard-verfication-code" method="POST">

                        <div class="modal-body p-4">
                            <div>
                                We Appreciate Your Permission! but we need Email Verification code to Make This User As
                                Admin
                                becuase we have sensitive data. Thanks!
                            </div>
                            @csrf
                            <input type="hidden" name="email" id="EmailVerficationCode">
                            <div class="d-flex mb-3">
                                <input type="tel" name="one" maxlength="1" pattern="[0-9]" required
                                    class="form-control">
                                <input type="tel" name="two" maxlength="1" pattern="[0-9]" required
                                    class="form-control">
                                <input type="tel" name="three" maxlength="1" pattern="[0-9]" required
                                    class="form-control">
                                <input type="tel" name="four" maxlength="1" pattern="[0-9]" required
                                    class="form-control">
                            </div>
                        </div>
                        <div class="alert alert-success ds-none"
                            style="padding:8px 12px;font-size:14px;margin:0 10px 10px " role="alert">
                            Deleted User Seccuessfully
                        </div>
                        <div class="modal-footer text-right">
                            <button class="btn btn-light" onclick="hideModal()">Cancel</button>
                            <button class="btn btn-primary" type="submit">Verify And Set User as Admin</button>

                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="modal fade modal-reset-password" id="staticBackdrop1" tabindex="-1"
            aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog d-flex justify-content-center">
                <div class="modal-content w-75">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Send Reset Password</h5>
                        <button type="button" class="btn-close" onclick="hideModal()" data-mdb-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        Do You Want To Send Reset Password Email To <span id="EmailSelected"></span> ?
                    </div>
                    <div class="alert alert-success alert-success-send-reset-email ds-none"
                        style="padding:8px 12px;font-size:14px;margin:0 10px 10px " role="alert">
                        Email Sent Successfully
                    </div>
                    <div class="modal-footer text-right">
                        <button class="btn btn-light" onclick="hideModal()">Cancel</button>
                        <button class="btn btn-primary" onclick="SendResetPassword()">Confirm And Send</button>

                    </div>
                </div>
            </div>
        </div>

        <script>
            function lanuchModalUpdate(id) {
                $('.modal-update').modal("show");
                console.log($("#" + id + "name").text())
                $("#Username").val($("#" + id + "name").text())
                $("#Email").val($("#" + id + "email").text())
                $(".profile-pic").attr("src", $("#" + id + "img").attr('src'))
                $("#idSelected").val(id)

            }

            function lanuchModalDelete(id) {
                $('.modal-delete').modal("show");
                $("#idSelected").val(id)
            }

            function LanuchSendResetPasswordModal(email) {
                $('.modal-reset-password').modal("show");
                $("#EmailSelected").text(email)
            }

            function lanuchModalVerfication(email) {
                $('.modal-verification').modal("show");
                $("#EmailVerficationCode").val(email)
            }


            function hideModal() {
                $(".modal").each(function() {
                    $(this).modal("hide")
                })
            }

            function SendResetPassword() {
                $.ajax({
                    method: "post",
                    url: "/dasboard-sendResetPasswordEmail",
                    data: {
                        'email': $("#EmailSelected").text(),
                        '_token': $('#token').attr('content')
                    }
                }).done(function(data) {
                    $(".alert-success-send-reset-email").show();
                    setTimeout(() => {
                        hideModal();
                    }, 3000);

                });
            }

            function deleteUser() {

                var id = $("#idSelected").val();
                $.ajax({
                    method: "get",
                    url: "/dashboard-delete-user",
                    data: {
                        'id': id,
                    }
                }).done(function(data) {
                    $(".alert-success").show();
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                });

            }
            $(document).ready(function() {

                $('#myTable').DataTable();
                $("#myTable_filter input").addClass("form-control");
                $("#myTable_length select").addClass("form-control");
                $("#myTable_filter input").attr("placeholder", "Search..");



                $('#form').submit(function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                        type: 'POST',
                        url: "/upload-image",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            //this.reset();
                            updateUser();
                        },
                        error: function(data) {
                            //console.log(data);
                        }
                    });


                    $("#verfication-code").submit(function(e) {

                        e.preventDefault(); // avoid to execute the actual submit of the form.

                        var form = $(this);
                        var actionUrl = form.attr('action');

                        $.ajax({
                            type: "POST",
                            url: actionUrl,
                            data: form.serialize(), // serializes the form's elements.
                            success: function(data) {
                                console.log(data)
                                //$(".alert-success-insert").show();
                                setTimeout(() => {
                                    ///location.reload();
                                }, 3000);
                            }
                        });

                    });
                });

                function updateUser() {
                    $.ajax({
                        type: 'POST',
                        url: "/dashboard-update-user",
                        data: {
                            'name': $("#Username").val(),
                            'email': $("#Email").val(),
                            'id': $("#idSelected").val(),
                            '_token': $('#token').attr('content')
                        },
                        success: (data) => {
                            console.log(data);
                            $(".alert-success").show();
                            setTimeout(() => {
                                location.reload();
                            }, 3000);
                        },

                    });
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('#token').attr('content')
                    }
                });

                var readURL = function(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('.profile-pic').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]);
                    }
                }


                $(".file-upload").on('change', function() {
                    readURL(this);
                });

                $(".upload-button , .profile-pic").on('click', function() {
                    $(".file-upload").click();
                });

            })
            const form = document.querySelector(' .modal-verification form')
            const inputs = form.querySelectorAll(' .modal-verification  input')
            const KEYBOARDS = {
                backspace: 8,
                arrowLeft: 37,
                arrowRight: 39,
            }

            function handleInput(e) {
                const input = e.target
                const nextInput = input.nextElementSibling
                if (nextInput && input.value) {
                    nextInput.focus()
                    if (nextInput.value) {
                        nextInput.select()
                    }
                }
            }

            function handlePaste(e) {
                e.preventDefault()
                const paste = e.clipboardData.getData('text')
                inputs.forEach((input, i) => {
                    input.value = paste[i] || ''
                })
            }

            function handleBackspace(e) {
                const input = e.target
                if (input.value) {
                    input.value = ''
                    return
                }

                input.previousElementSibling.focus()
            }

            function handleArrowLeft(e) {
                const previousInput = e.target.previousElementSibling
                if (!previousInput) return
                previousInput.focus()
            }

            function handleArrowRight(e) {
                const nextInput = e.target.nextElementSibling
                if (!nextInput) return
                nextInput.focus()
            }

            form.addEventListener('input', handleInput)
            inputs[0].addEventListener('paste', handlePaste)

            inputs.forEach(input => {
                input.addEventListener('focus', e => {
                    setTimeout(() => {
                        e.target.select()
                    }, 0)
                })

                input.addEventListener('keydown', e => {
                    switch (e.keyCode) {
                        case KEYBOARDS.backspace:
                            handleBackspace(e)
                            break
                        case KEYBOARDS.arrowLeft:
                            handleArrowLeft(e)
                            break
                        case KEYBOARDS.arrowRight:
                            handleArrowRight(e)
                            break
                        default:
                    }
                })
            })
        </script>
    @endsection
