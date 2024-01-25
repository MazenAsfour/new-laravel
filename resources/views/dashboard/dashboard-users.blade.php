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
                                    <th>Card Number</th>
                                    <th>Points</th>
                                    <th>Free Gifts</th>
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
                        <form id="form-create" method="POST" enctype="multipart/form-data">
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
                            <div class="form-outline mb-2">
                                <label class="form-label" id="">Username</label>
                                <input type="text" name="name" required class="form-control" />
                            </div>

                            <div class="form-outline mb-2">
                                <label class="form-label" for="">Email</label>
                                <input type="email" name="email" required value='' class="form-control" />
                            </div>
                            <div class="form-outline mb-2">
                                <label class="form-label" for="">Card Number (optional)</label>
                                <input type="text" name="card_number" maxlength="19" class="visa-number form-control">
                            </div>
                            <div class="form-outline mb-2">
                                <label class="form-label" for="">Points</label>
                                <input type="number" name="points" class="points form-control">
                            </div>
                            <div class="form-outline mb-2">
                                <label class="form-label" for="">Password</label>
                                <input type="password" name="password" class="password form-control" required>
                            </div>
                            <div class="form-outline mb-2">
                                <label class="form-label" for="">Confirm Password</label>
                                <input type="password" name="confirm-password" class="confirm-password form-control"
                                    required>
                            </div>

                            <div class="spinner-border spinner-border-sm d-none" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <div class="alert alert-danger ds-none" style="padding:8px 12px;font-size:14px" role="alert">

                            </div>
                            <div class="alert alert-success ds-none" style="padding:8px 12px;font-size:14px" role="alert">
                                Created User Profile Seccuessfully
                            </div>
                            <button type="submit" class="btn btn-primary btn-block mt-2">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-update" id="modal-update" tabindex="-1" aria-labelledby="exampleModalLabel1"
            aria-hidden="true">
            <div class="modal-dialog d-flex justify-content-center">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">User Inforamtion</h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal"onclick="hideModal()"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form id="form-update" method="POST" enctype="multipart/form-data">
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
                            <div class="form-outline mb-2">
                                <label class="form-label" id="">Username</label>
                                <input type="text" id="Username" name="name" value='' required
                                    class="form-control" />
                            </div>

                            <div class="form-outline mb-2">
                                <label class="form-label" name="email" for="password1">Email</label>
                                <input type="email" name="email" id="Email"required value=''
                                    class="form-control" />
                            </div>
                            <input type="hidden" id="idSelected" name="id" value='' name="">

                            <div class="form-outline mb-2">
                                <label class="form-label" for="">Card Number (optional)</label>
                                <input type="text" name="card_number" maxlength="19"
                                    class="visa-number form-control">
                            </div>
                            <div class="form-outline mb-2">
                                <label class="form-label" for="">Points</label>
                                <input type="number" name="points" class="points form-control">
                            </div>
                            <div class="spinner-border spinner-border-sm d-none" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <div class="alert alert-danger ds-none" style="padding:8px 12px;font-size:14px"
                                role="alert">

                            </div>
                            <div class="alert alert-success ds-none" style="padding:8px 12px;font-size:14px"
                                role="alert">
                                Updated User Profile Seccuessfully
                            </div>
                            <button type="submit" class="btn btn-primary btn-block mt-2">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-delete" id="modal-delete" tabindex="-1" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog d-flex justify-content-center">
                <div class="modal-content w-100">
                    <form id="delete-user">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="">Do You Want To Delete it</h5>
                            <button type="button" class="btn-close" onclick="hideModal()" data-mdb-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            Make sure that user will can't access this restaurant again!
                        </div>
                        <input type="hidden" name="id" id="idSelected">
                        <div class="alert alert-success ds-none"
                            style="padding:8px 12px;font-size:14px;margin:0 10px 10px " role="alert">
                            Deleted Seccuessfully
                        </div>
                        <div class="modal-footer text-right">
                            <button class="btn btn-light" onclick="hideModal()">Cancel</button>
                            <button class="btn btn-primary" type="submit">Confirm And Delete</button>
                            <div class="spinner-border spinner-border-sm d-none" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <script>
            jQuery(document).ready(function($) {
                prepare()
                $('.visa-number').on('input', function() {
                    var inputValue = $(this).val().replace(/\s/g, '');
                    var formattedValue = inputValue.replace(/(\d{4})(\d{4})(\d{4})(\d{0,4})/, function(match,
                        p1, p2, p3, p4) {
                        return p1 + '-' + p2 + '-' + p3 + '-' + p4;
                    });

                    $(this).val(formattedValue);
                });
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
                                data: 'card_number',
                                name: 'card_number',
                                render: function(data, type, row) {
                                    return '<p id="card_number_' + row.id + '">' + row.card_number +
                                        '</p>';
                                }
                            },
                            {
                                data: 'points',
                                name: 'points',
                                render: function(data, type, row) {
                                    return '<p id="points_' + row.id + '">' + row.points +
                                        '</p>';
                                }
                            },
                            {
                                data: 'free_gift',
                                name: 'free_gift',
                                render: function(data, type, row) {
                                    return '<p id="card_number_' + row.id + '">' + Math.floor(Number(row
                                        .free_gift) / 2); +
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
                                    console.log(row);
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
                    // timeZoneName: 'short'
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
                $('#modal-delete').modal("show");
                $("#modal-delete #idSelected").val(id)
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

            $('#delete-user').submit(function(e) {
                e.preventDefault();
                $("#delete-user .spinner-border").removeClass("d-none");

                var formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: "/dashboard-delete-user",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        res = JSON.parse(data);
                        $("#delete-user .spinner-border").addClass("d-none");

                        if (res.success) {
                            $(".modal-delete .alert-success").show();
                            destory();
                            prepare();
                        } else {
                            alert(res.error);
                        }

                        setTimeout(() => {
                            $(".modal-delete").modal("hide");
                            $(".modal-delete .alert-success").hide();
                        }, 3000);
                    },
                    error: function(data) {
                        // Handle error
                    }
                });
            });
            $(document).ready(function() {

                $('#myTable').DataTable();
                $("#myTable_filter input").addClass("form-control");
                $("#myTable_length select").addClass("form-control");
                $("#myTable_filter input").attr("placeholder", "Search..");



                $('#form-create').submit(function(e) {
                    e.preventDefault();
                    if (jQuery("#form-create .password").val() !== jQuery("#form-create .confirm-password")
                        .val()) {
                        jQuery("#modal-create .alert-danger").removeClass("ds-none");
                        jQuery("#modal-create .alert-danger").text("Passwords not match!");
                        return false;
                    } else {
                        jQuery("#modal-create .alert-danger").addClass("ds-none");
                    }
                    jQuery("#modal-create .spinner-border").removeClass("d-none")
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
                            $("#modal-create .spinner-border").addClass("d-none")
                            if (res.success) {
                                $("#modal-create .alert-success").show();
                                destory();
                                prepare();
                            } else {
                                jQuery("#modal-create .alert-danger").removeClass("ds-none");
                                jQuery("#modal-create .alert-danger").text(res.error);
                            }
                            setTimeout(() => {
                                $("#modal-create").modal("hide")
                                jQuery("#modal-create .alert-danger").addClass();
                                $("#modal-create .alert-success").hide();
                            }, 3000);
                        },
                        error: function(data) {
                            console.log(data)
                        }
                    });
                });

                $('#form-update').submit(function(e) {
                    e.preventDefault();

                    jQuery("#modal-update .spinner-border").removeClass("d-none")
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
                            $("#modal-update .spinner-border").addClass("d-none")
                            if (res.success) {
                                $("#modal-update .alert-success").show();
                                destory();
                                prepare();
                            } else {
                                jQuery("#modal-update .alert-danger").removeClass("ds-none");
                                jQuery("#modal-update .alert-danger").text(res.error);
                            }
                            setTimeout(() => {
                                $(".modal-update").modal("hide")
                                jQuery("#modal-update .alert-danger").addClass();
                                $("#modal-update .alert-success").hide();
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
                jQuery('#userDataTable').DataTable().destroy();

            }
        </script>
    @endsection
