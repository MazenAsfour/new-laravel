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
    <div id="content">

        <div class="midde_cont">
            <div class="container-fluid">
                <div class="row column_title">
                    <div class="col-md-12">
                        <div class="page_title">
                            <h2 style="display: inline-block">Admins</h2>
                            <button class="btn btn-primary" onclick="lanuchModalInsertAdmin()" style="margin-left:20px">Add New
                                Admin</button>
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
                                    @if (Auth::user()->id == intval($rootAdmin->id))
                                        <th style="width: 15px;"></th>
                                    @endif

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
                                        @if (Auth::user()->id == intval($rootAdmin->id))
                                            <td><i class="fa fa-times pointer"
                                                    onclick="lanuchModalDelete({{ $user->id }})" aria-hidden="true"></i>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>

        <div class="modal fade modal-add-admin" id="staticBackdrop1" tabindex="-1" aria-labelledby="exampleModalLabel1"
            aria-hidden="true">
            <div class="modal-dialog d-flex justify-content-center">
                <div class="modal-content">
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
                                <input type="email" name="email" placeholder="Email" required class="form-control" />
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label"> Password</label>
                                <input type="password" id="password" minlength="8" size="8" placeholder="Passwoed"
                                    name="password" required class="form-control" />
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label"> Confirm Password</label>
                                <input type="password" minlength="8" size="8" id="confirm-password"
                                    placeholder="Confrim Password" name="confirm-password" required class="form-control" />
                            </div>
                            <div class="alert alert-danger ds-none"id="errPassword" style="padding:8px 12px;font-size:14px"
                                role="alert">
                                Oops! something went wrong please try again
                            </div>
                            <div class="alert alert-success-insert alert-success ds-none"
                                style="padding:8px 12px;font-size:14px" role="alert">
                                Added New Admin Successfully
                            </div>
                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block">Add New Admin
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if (Auth::user()->id == intval($rootAdmin->id))
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
        @endif


        <script>
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
                $(".modal-delete #idSelected").val(id)
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
            $('#delete-user').submit(function(e) {
                e.preventDefault();
                $("#delete-user .spinner-border").removeClass("d-none");

                var formData = new FormData(this);
                formData.append("admin", true)
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
