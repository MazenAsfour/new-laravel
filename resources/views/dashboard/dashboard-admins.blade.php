@extends('dashboard.layouts.app')

@push('custom-style')
    <style>
        .pointer {
            cursor: pointer;
        }

        .fa-times {
            color: rgb(214, 0, 0)
        }

        .ds-none {
            display: none
        }
    </style>
@endpush
@section('content')
    <!-- right content -->
    <div id="content">

        <!-- dashboard inner -->
        <div class="midde_cont">
            <div class="container-fluid">
                <div class="row column_title">
                    <div class="col-md-12">
                        <div class="page_title">
                            <h2 style="display: inline-block">Admins</h2>
                            <button class="btn btn-primary" onclick="lanuchModalInsertAdmin()" style="margin-left:20px">Add New Admin</button>
                        </div>
                    </div>
                </div>
                <div class="container">

                    <div class="well">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Admin Profile</th>
                                    <th>Admin Name</th>
                                    <th>Admin Email</th>
                                    <th>Admin Role</th>
                                    <th>Created At</th>
                                    <th style="width: 15px;"></th>
                                    <th style="width: 15px;"></th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr id="{{ $user->id }}">
                                        <td>{{ $user->id }}</td>
                                        <td><img id="{{ $user->id }}img" src="{{ $user->image }}"
                                                style="width:30px;height:30px;border-radius:100%"class="img-responsive"
                                                alt="#" /></td>
                                        <td id="{{ $user->id }}name">{{ $user->name }}</td>
                                        <td id="{{ $user->id }}email">{{ $user->email }}</td>
                                        <td>Administrator</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td><i class="fa fa-wrench pointer" onclick="lanuchModalUpdate({{ $user->id }})"
                                                aria-hidden="true"></i></td>
                                        {{-- <td><i class="fa fa-pencil pointer"
                                                onclick="lanuchModalUpdateAdmin({{ $user->id }})"></i></td> --}}
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
                        <h5 class="modal-title" id="exampleModalLabel1">Admin Inforamtion</h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal"onclick="hideModal()"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form id="form">
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" id="">Username</label>
                                <input type="text" id="Username" required class="form-control" />
                            </div>

                            <!-- password input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="password1">Email</label>
                                <input type="email" id="Email"required class="form-control" />
                            </div>
                            <input type="hidden" id="idSelected" name="">
                            <div class="form-outline mb-4">
                                <label class="form-label" id="">Image Link</label>
                                <input type="text" id="link"required class="form-control" />
                            </div>
                            <div class="alert alert-success ds-none" style="padding:8px 12px;font-size:14px" role="alert">
                                Updated Admin Seccuessfully
                            </div>
                            <!-- Submit button -->
                            <button type="submit" onclick="editUser(event)"
                                class="btn btn-primary btn-block">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade modal-add-admin" id="staticBackdrop1" tabindex="-1" aria-labelledby="exampleModalLabel1"
            aria-hidden="true">
            <div class="modal-dialog d-flex justify-content-center">
                <div class="modal-content w-75">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Add New Admin</h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal"onclick="hideModal()"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form id="form-add-admin" action="/dashboard-add-admin" method="POST">
                            @csrf
                            <div class="form-outline mb-4">
                                <label class="form-label" id=""> Name</label>
                                <input type="text" name="name" placeholder="Name" required class="form-control" />
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" id=""> Email</label>
                                <input type="email" name="email" placeholder="Email" required
                                    class="form-control" />
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label"> Password</label>
                                <input type="password" id="password" minlength="8" size="8"
                                    placeholder="Passwoed" name="password" required class="form-control" />
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label"> Confirm Password</label>
                                <input type="password" minlength="8" size="8" id="confirm-password"
                                    placeholder="Confrim Password" name="confirm-password" required
                                    class="form-control" />
                            </div>
                            <div class="alert alert-danger ds-none"id="errPassword"
                                style="padding:8px 12px;font-size:14px" role="alert">
                                Oops! something went wrong please try again
                            </div>
                            <div class="alert alert-success-insert alert-success ds-none"
                                style="padding:8px 12px;font-size:14px" role="alert">
                                Add New Admin Successfully
                            </div>
                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block">Add New Admin
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade modal-update-admin" id="staticBackdrop1" tabindex="-1"
            aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog d-flex justify-content-center">
                <div class="modal-content w-75">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Modifiy Admin Role</h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal"onclick="hideModal()"
                            aria-label="Close"></button>
                    </div>
                    <form id="form-admin" action="dashborad-modify-admin">
                        <div class="modal-body p-4">
                            <!-- Email input -->
                            Do You Want To Update Admin Role as User?
                            @csrf
                            <input type="hidden" name="" id="idAdmin">
                            <div class="alert alert-success ds-none" style="padding:8px 12px;font-size:14px"
                                role="alert">
                                Updated Admin Seccuessfully
                            </div>
                            <!-- Submit button -->
                        </div>
                        <div class="modal-footer text-right">
                            <button class="btn btn-light" onclick="hideModal()">Cancel</button>
                            <button type="submit" class="btn btn-primary">Confirm And
                                Modify</button>
                        </div>
                    </form>
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
                        Do You Want To delete This Admin?
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
            function lanuchModalUpdate(id) {
                $('.modal-update-admin').modal("show");
                $("#idAdmin").val(id)
            }

            function lanuchModalUpdateAdmin(id) {
                $('.modal-update').modal("show");

                $("#Username").val($("#" + id + "name").text())
                $("#Email").val($("#" + id + "email").text())
                $("#link").val($("#" + id + "img").attr('src'))
                $("#idSelected").val(id)

            }

            function lanuchModalInsertAdmin(id) {
                $('.modal-add-admin').modal("show");
            }

            function lanuchModalDelete(id) {
                $('.modal-delete').modal("show");
                $("#idSelected").val(id)
            }

            function hideModal() {
                $(".modal").each(function() {
                    $(this).modal("hide")
                })
            }

            function editUser(event) {
                console.log(document.getElementById('form').checkValidity());
                if (document.getElementById('form').checkValidity() == true) {
                    event.preventDefault();

                    var id = $("#idSelected").val();
                    var email = $("#Email").val();
                    var username = $("#Username").val();
                    var link = $("#link").val();
                    $.ajax({
                        method: "get",
                        url: "/dashboard-update-user",
                        data: {
                            'name': username,
                            'email': email,
                            'id': id,
                            'link': link,
                        }
                    }).done(function(data) {
                        $(".alert-success").show();
                        setTimeout(() => {
                            location.reload();
                        }, 3000);
                    });

                }
            }

            function deleteUser() {

                var id = $("#idSelected").val();
                $.ajax({
                    method: "get",
                    url: "/dashboard-delete-user",
                    data: {
                        'id': id,
                        'admin':true
                    }
                }).done(function(data) {
                    $(".alert-success").show();
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                });

            }
            $(document).ready(function() {
                $("#form-admin").submit(function(e) {

                    e.preventDefault(); // avoid to execute the actual submit of the form.

                    var form = $(this);
                    var actionUrl = form.attr('action');
                    $.ajax({
                        type: "POST",
                        url: actionUrl,
                        data: form.serialize(), // serializes the form's elements.
                        success: function(data) {
                            console.log(data)
                            $(".alert-success-update").show();
                            setTimeout(() => {
                                location.reload();
                            }, 3000);
                        }
                    });

                });
                $("#form-add-admin").submit(function(e) {

                    e.preventDefault(); // avoid to execute the actual submit of the form.
                    var form = $(this);
                    var actionUrl = form.attr('action');
                    if ($("#password").val() !== $("#confirm-password").val()) {
                        $("#errPassword").show()
                    } else {
                        $("#errPassword").hide()
                    }
                    $.ajax({
                        type: "POST",
                        url: actionUrl,
                        data: form.serialize(), // serializes the form's elements.
                        success: function(data) {
                            console.log(data)
                            data1 = JSON.parse(data);
                            if (data1.error) {
                                $("#errPassword").text(data1.error_message);
                                $("#errPassword").show()
                            } else {
                                $(".alert-success-insert").show();
                                setTimeout(() => {
                                    location.reload();
                                }, 3000);
                            }

                        }
                    });

                });
            })
            function hideModal() {
                $(".modal").each(function() {
                    $(this).modal("hide")
                })
            }
        </script>
        <!-- Modal -->
        <!-- end dashboard inner -->
    @endsection
