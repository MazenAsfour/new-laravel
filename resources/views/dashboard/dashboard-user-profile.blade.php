@extends('dashboard.layouts.app')
@section('title')
    Admin Profile
@endsection
@push('custom-style')
    <style>

    </style>
@endpush
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- right content -->
    <div id="content">
        <!-- dashboard inner -->
        <div class="midde_cont">
            <div class="container-fluid">
                <div class="row column_title">
                    <div class="col-md-12">
                        <div class="page_title">
                            <h2>Profile</h2>
                        </div>
                    </div>
                </div>
                <!-- row -->
                <div class="row column1">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="white_shd full margin_bottom_30">
                            <div class="full graph_head">
                                <div class="heading1 margin_0">
                                    <h2>User profile</h2>
                                </div>
                            </div>
                            <div class="full price_table padding_infor_info">
                                <div class="row">
                                    <!-- user profile section -->
                                    <!-- profile image -->
                                    <div class="col-lg-12">
                                        <div class="full dis_flex center_text">
                                            <div class="profile_img"><img width="180" class="rounded-circle"
                                                    src={{ $admin[0]->image }} alt="#" /></div>
                                            <div class="profile_contant">
                                                <div class="contact_inner">
                                                    <h3>{{ $admin[0]->name }}</h3>
                                                    <p><strong>About: </strong>Administrator</p>
                                                    <ul class="list-unstyled tooltips mb-2" style="margin-bottom: 20px">
                                                        <li><i class="fa fa-envelope-o" data-toggle="tooltip"
                                                                data-placement="top" title="Email"></i> :
                                                            {{ $admin[0]->email }}</li>
                                                        <li><i class="fa fa-calendar" aria-hidden="true"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Created At"></i> : {{ $admin[0]->created_at }}</li>
                                                        <li><i class="fa fa-clock-o" aria-hidden="true"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Last Login"></i> : {{ $admin[0]->last_login }}</li>

                                                    </ul>
                                                    <div class="mt-2">
                                                        <button class="btn btn-light mt-2" onclick="lanuchModalUpdate()"
                                                            style="margin-top: 20px !important">Change
                                                            Profile</button>
                                                        <button class="btn btn-primary mt-2" onclick="lanuchModalPassword()"
                                                            style="margin-top: 20px !important">Change
                                                            Password</button>
                                                    </div>


                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <!-- end row -->
                </div>
                <!-- Modal -->
                <div class="modal fade modal-update" id="staticBackdrop1" tabindex="-1"
                    aria-labelledby="exampleModalLabel1" aria-hidden="true">
                    <div class="modal-dialog d-flex justify-content-center">
                        <div class="modal-content w-75">
                            <div class="modal-header">
                                <h5 class="modal-title" id="">Admin Inforamtion</h5>
                                <button type="button" class="btn-close" data-mdb-dismiss="modal"onclick="hideModal()"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4">
                                <form id="form" method="POST" action="/dashboard-update-user"
                                    enctype="multipart/form-data">
                                    <!-- Email input -->
                                    @csrf
                                    <div class="row">
                                        <div class="small-12 medium-2 large-2 columns">
                                            <div class="circle">
                                                <img class="profile-pic" src="{{ $admin[0]->image }}">
                                                <div class="p-image">
                                                    <i class="fa fa-camera upload-button"></i>
                                                    <input class="file-upload" name="image" type="file"
                                                        accept="image/*" />
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" id="">Username</label>
                                        <input type="text" id="Username" name="name" value={{ $admin[0]->name }}
                                            required class="form-control" />
                                    </div>

                                    <!-- password input -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" name="email" for="password1">Email</label>
                                        <input type="email" name="email" id="Email"required
                                            value={{ $admin[0]->email }} class="form-control" />
                                    </div>
                                    <input type="hidden" id="idSelected" name="id" value={{ $admin[0]->id }}
                                        name="">

                                    <div class="alert alert-success ds-none" style="padding:8px 12px;font-size:14px"
                                        role="alert">
                                        Updated Admin Profile Seccuessfully
                                    </div>
                                    <!-- Submit button -->
                                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade modal-password" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog d-flex justify-content-center">
                        <div class="modal-content w-75">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Change Password</h5>
                                <button type="button" class="btn-close" data-mdb-dismiss="modal"onclick="hideModal()"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4">
                                <form id="form1">
                                    <!-- current Password input -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" id="">Current Password</label>
                                        <input type="password" id="cuurentPassword" placeholder="*********" required
                                            class="form-control" />
                                    </div>

                                    <!-- new password input -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="password1">New Password</label>
                                        <input type="password" id="newPassword" required placeholder="*********"
                                            class="form-control" />
                                    </div>

                                    <!-- Confirm password input -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="password1">Confirm Password</label>
                                        <input type="password" id="confirmPassword"required placeholder="*********"
                                            class="form-control" />
                                    </div>
                                    <div class="alert alert-success ds-none" style="padding:8px 12px;font-size:14px"
                                        role="alert">
                                        Updated User Seccuessfully
                                    </div>
                                    <div class="alert alert-danger ds-none" style="padding:8px 12px;font-size:14px"
                                        role="alert">
                                        Oops! something went wrong please try again
                                    </div>
                                    <!-- Submit button -->
                                    <button type="submit" onclick="updatePassword(event)"
                                        class="btn btn-primary btn-block">Update Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>



                <script>
                    function lanuchModalUpdate() {
                        $('.modal-update').modal("show");
                    }

                    function lanuchModalPassword() {
                        $('.modal-password').modal("show");
                    }

                    function hideModal() {
                        $(".modal").each(function() {
                            $(this).modal("hide")
                        })
                    }

                    function updatePassword() {
                        if (document.getElementById('form1').checkValidity() == true) {
                            event.preventDefault();
                            var currentPassword = $("#cuurentPassword").val();
                            var newPassword = $("#newPassword").val();
                            var confirmPassword = $("#confirmPassword").val();
                            var id = $("#idSelected").val();
                            if (newPassword !== confirmPassword) {
                                $(".alert-danger").show();
                            } else {
                                $.ajax({
                                    method: "get",
                                    url: "/dashboard-check-password",
                                    data: {
                                        'id': id,
                                        'newPassword': newPassword,
                                        'currentPassword': currentPassword,
                                    }
                                }).done(function(data) {
                                    data1 = JSON.parse(data)
                                    if (data1.error) {
                                        $(".alert-danger").show();
                                    } else {
                                        $(".alert-success").show();
                                        $(".alert-danger").hide();
                                    }
                                    setTimeout(() => {
                                        $('.modal-password').modal("hide");
                                    }, 3000);
                                });
                            }
                        }

                    }
                    $(document).ready(function() {
                        $(".tooltips i").hover(function() {
                            $(this).tooltip('show')

                        })
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('#token').attr('content')
                            }
                        });

                        var readURL = function(input) {
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();

                                reader.onload = function(e) {
                                    // $('.profile-pic').attr('src', e.target.result);
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
                    });
                </script>

                <!-- end dashboard inner -->
            @endsection
