@extends('dashboard.layouts.app')
@section('title')
    Users
@endsection
@push('custom-style')
    <style>

    </style>
@endpush
@section('content')
    <div id="content">

        <!-- dashboard inner -->
        <div class="midde_cont">
            <div class="container-fluid">
                <div class="row column_title">
                    <div class="col-md-12">
                        <div class="page_title" style="">
                            <h2 style="display: inline;">Users</h2>
                            <button class="btn btn-primary" onclick="lanuchModalInsert()" style="margin-left:20px">Add New
                                User</button>
                        </div>
                    </div>
                </div>
                <div class="container">

                    <div class="well">
                        <table class="table" id="userDataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User Profile</th>
                                    <th>User Name</th>
                                    <th>User Email</th>
                                    <th>Created At</th>
                                    <th style="width: 100px"></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade " id="modal-create" tabindex="-1" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog d-flex justify-content-center">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Create User</h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal"onclick="hideModal()"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form id="form" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="small-12 medium-2 large-2 columns">
                                    <div class="circle">
                                        <img class="profile-pic"
                                            src="/images/computer-icons-user-profile-google-account-photos-icon-account.jpg">
                                        <div class="p-image">
                                            <i class="fa fa-camera upload-button"></i>
                                            <input class="file-upload" name="image" type="file" accept="image/*" />
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" id="">Username</label>
                                <input type="text" name="name" required class="form-control" />
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="">Email</label>
                                <input type="email" name="email" required value='' class="form-control" />
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="">Card Number (optional)</label>
                                <input type="number" name="visa" class="visa-number form-control" required>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="">Password</label>
                                <input type="password" name="password" class="password form-control" required>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="">Confirm Password</label>
                                <input type="password" name="confirm-password" class="confirm-password form-control"
                                    required>
                            </div>

                            <div class="spinner-border spinner-border-sm d-none" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <div class="alert alert-danager ds-none" style="padding:8px 12px;font-size:14px" role="alert">

                            </div>
                            <div class="alert alert-success ds-none" style="padding:8px 12px;font-size:14px" role="alert">
                                Created User Profile Seccuessfully
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-update" id="" tabindex="-1" aria-labelledby="exampleModalLabel1"
            aria-hidden="true">
            <div class="modal-dialog d-flex justify-content-center">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">User Inforamtion</h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal"onclick="hideModal()"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form id="form" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="small-12 medium-2 large-2 columns">
                                    <div class="circle">
                                        <img class="profile-pic" src="">
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

                            <div class="form-outline mb-4">
                                <label class="form-label" name="email" for="password1">Email</label>
                                <input type="email" name="email" id="Email"required value=''
                                    class="form-control" />
                            </div>
                            <input type="hidden" id="idSelected" name="id" value='' name="">
                            <div class="spinner-border spinner-border-sm d-none" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <div class="alert alert-success ds-none" style="padding:8px 12px;font-size:14px"
                                role="alert">
                                Updated User Profile Seccuessfully
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-delete" id="" tabindex="-1" aria-labelledby="exampleModalLabel1"
            aria-hidden="true">
            <div class="modal-dialog d-flex justify-content-center">
                <div class="modal-content ">
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



        <script>
            jQuery(document).ready(function($) {
                prepare()

            });

            function prepare() {
                $(document).ready(function() {
                    $('#userDataTable').DataTable({
                        serverSide: true,
                        ajax: "{{ route('users.data') }}",
                        columns: [{
                                data: 'id',
                                name: 'id',
                                render: function(data, type, row) {
                                    return '#' + row.id;
                                }
                            },
                            {
                                data: 'image_path',
                                name: 'image_path',
                                render: function(data, type, row) {
                                    return '<img id="' + row.id + 'img" src="' + row.image_path +
                                        '" style="width:30px;height:30px;border-radius:100%;object-fit: cover;" class="img-responsive" alt="#" />';
                                }
                            },
                            {
                                data: 'name',
                                name: 'name',
                                render: function(data, type, row) {
                                    return '<p id="name_' + row.id + '">' + row.name + '</p>';
                                }
                            },
                            {
                                data: 'email',
                                name: 'email',
                                render: function(data, type, row) {
                                    return '<p id="email_' + row.id + '">' + row.email +
                                        '</p>';
                                }
                            },

                            {
                                data: 'created_at',
                                name: 'created_at',
                                render: function(data, type, row) {
                                    return '<p id="create_at_' + row.created_at + '">' +
                                        formatReadableDate(row.created_at) +
                                        '</p>';
                                }
                            },
                            {
                                data: null,
                                orderable: false,
                                searchable: false,
                                render: function(data, type, row) {
                                    return ' <td><i class="fa fa-pencil pointer" onclick="lanuchModalUpdate(' +
                                        row.id +
                                        ')" aria-hidden="true"></i> <i class=" pl-3 fa fa-times pointer" onclick="lanuchModalDelete(' +
                                        row.id + ')" aria-hidden="true"></i></td>';
                                }
                            }
                        ],
                    });
                });
            }

            function formatReadableDate(dateString) {
                var date = new Date(dateString);

                var optionsDate = {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric'
                };
                var optionsTime = {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                    timeZoneName: 'short'
                };

                var formattedDate = date.toLocaleDateString('en-US', optionsDate);
                var formattedTime = date.toLocaleTimeString('en-US', optionsTime);

                return formattedDate + ' ' + formattedTime;
            }

            function lanuchModalUpdate(id) {
                $('.modal-update').modal("show");
                $("#Username").val($("#name_" + id).text())
                $("#Email").val($("#email_" + id).text())
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

            function lanuchModalInsert() {
                $('#modal-create').modal("show");
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


                $('#form-update').submit(function(e) {
                    e.preventDefault();
                    $("#form-update .spinner-border").removeClass("d-none")
                    var formData = new FormData(this);

                    $.ajax({
                        type: 'POST',
                        url: "/dashboard-update-user",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            res = JSON.parse(data)
                            $("#form-update .spinner-border").addClass("d-none")
                            if (res.success) {
                                $(".alert-success-update").show();
                                destory();
                                prepare();
                            } else {
                                alert(res.error)
                            }
                            setTimeout(() => {
                                $(".modal-update").modal("hide")
                                $(".alert-success-update").hide();
                            }, 3000);
                        },
                        error: function(data) {
                            console.log(data)
                        }
                    });



                });
                $('#form-create').submit(function(e) {
                    e.preventDefault();
                    if (jQuery("#form-create .password").val() !== jQuery("#form-create .confirm-password")
                        .val()) {
                        jQuery("#modal-create .alert-danager").removeClass("ds-none");
                        jQuery("#modal-create .alert-danager").text("Passwords not match!");
                    } else {
                        jQuery("#modal-create .alert-danager").addClass("ds-none");
                    }
                    ("#modal-create .spinner-border").addClass("d-none")
                        .removeClass("d-none")
                    var formData = new FormData(this);

                    $.ajax({
                        type: 'POST',
                        url: "/dashboard-create-user",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            res = JSON.parse(data)
                                ("#modal-create .spinner-border").addClass("d-none")
                            if (res.success) {
                                $("#modal-create .alert-success").show();
                                destory();
                                prepare();
                            } else {
                                alert(res.error)
                            }
                            setTimeout(() => {
                                $(".modal-update").modal("hide")
                                $("#modal-create .alert-success").hide();
                            }, 3000);
                        },
                        error: function(data) {
                            console.log(data)
                        }
                    });



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

            function destory() {
                jQuery('#productDataTable').DataTable().destroy();

            }
        </script>
    @endsection
