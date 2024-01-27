@extends('dashboard.layouts.app')
@section('title')
    Menu list
@endsection
@push('custom-style')
    <style>
        textarea {
            min-height: 200px !important
        }

        tr td:last-child {
            width: 100px !important;
        }

        tr td:nth-child(1) {
            width: 50px !important;
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
                            <h2 style="display: inline-block">Menu Items</h2>
                            <button class="btn btn-primary" onclick="lanuchModalInsert()" style="margin-left:20px">Add New
                                Menu Item</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">

                    <table id="categoryDataTable" class="table  table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>


            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade modal-insert" id="" tabindex="-1" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog d-flex justify-content-center">
                <div class="modal-content w-100">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Add Menu Item</h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal"onclick="hideModal()"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form id="form" method="POST" action="/upload-image" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="small-12 medium-2 large-2 columns">

                                    <div class="form-outline mb-4">
                                        <label class="form-label" id="">Category Name</label>
                                        <input type="text" id="pr_name" placeholder="Name" name="name" required
                                            class="form-control" />
                                    </div>

                                    <input type="hidden" name="type" value="">
                                    <input type="hidden" name="id" id="_id">

                                    <div class="form-outline mb-4">
                                        <label class="form-label" id="">Description</label>
                                        <textarea name="description" placeholder="Description" class="form-control" cols="4" rows="4"></textarea>
                                    </div>
                                    <div class="alert alert-success-insert alert-success ds-none"
                                        style="padding:8px 12px;font-size:14px" role="alert">
                                        Added Item Successfully
                                    </div>
                                    <div class="spinner-border spinner-border-sm d-none" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Add Item
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade modal-update" id="" tabindex="-1" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog d-flex justify-content-center">
                <div class="modal-content w-100">
                    <div class="modal-header">
                        <h5 class="modal-title" id=""> Update <span id="update-name"></span> </h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal"onclick="hideModal()"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form id="form-update" action="/upload-image" method="POST">
                            @csrf
                            <div class="row">

                                <div class="form-outline mb-4">
                                    <label class="form-label" id=""> Name</label>
                                    <input type="text" id="update_pr_name" name="name" required
                                        class="form-control" />
                                </div>

                                <input type="hidden" name="id" id="_id_update">
                                <div class="form-outline mb-4">
                                    <label class="form-label" id=""> Description</label>
                                    <textarea name="description" id="pr_catgory_update"class="form-control" cols="4" rows="4"></textarea>
                                </div>
                                <div class="alert alert-success-update alert-success ds-none"
                                    style="padding:8px 12px;font-size:14px" role="alert">
                                    Updated Successfully
                                </div>
                                <div class="spinner-border spinner-border-sm d-none" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Update
                                </button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-delete" id="modal-delete" tabindex="-1" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog d-flex justify-content-center">
                <div class="modal-content w-100">
                    <form id="delete-category">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="">Do you Want To delete this item?</h5>
                            <button type="button" class="btn-close" onclick="hideModal()" data-mdb-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            Make sure that all products will effect this category
                        </div>
                        <input type="hidden" name="id" id="idSelected">
                        <div class="alert alert-success ds-none"
                            style="padding:8px 12px;font-size:14px;margin:0 10px 10px " role="alert">
                            Deleted Seccussfully
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

            });

            function prepare() {
                $('#categoryDataTable').DataTable({
                    serverSide: true,
                    ajax: "{{ route('category.data') }}",
                    columns: [{
                            data: 'id',
                            name: 'id',
                            render: function(data, type, row) {
                                return '#' + row.id;
                            }
                        },
                        {
                            data: 'name',
                            name: 'name',
                            render: function(data, type, row) {
                                return '<p id="name_' +
                                    row.id + '">' + row.name + '</p>';
                            }
                        },
                        {
                            data: 'description',
                            name: 'description',
                            render: function(data, type, row) {
                                return '<p  id="description_' +
                                    row.id + '">' + row.description + '</p>';
                            }
                        },
                        {
                            data: null,
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                return '<i class="fa fa-pencil pl-3 pointer" onclick="lanuchModalUpdate(' + row
                                    .id +
                                    ')" aria-hidden="true"></i>' +
                                    '<i class="fa fa-times pl-3 pointer" onclick="lanuchModalDelete(' + row.id +
                                    ')" aria-hidden="true"></i>';
                            }
                        }
                    ],
                });
            }

            function lanuchModalDelete(id) {
                $('#modal-delete').modal("show");
                $("#idSelected").val(id)
            }

            function lanuchModalInsert() {
                $('.modal-insert').modal("show");

            }

            function lanuchModalUpdate(id) {
                $('.modal-update').modal("show");
                $("#update-name").text($("#name_" + id).text())
                $("#update_pr_name").val($("#name_" + id).text())
                text = $("#description_" + id).text()
                $("#pr_catgory_update").val(text.trim())
                $("#_id_update").val(id)
            }


            function hideModal() {
                $(".modal").each(function() {
                    $(this).modal("hide")
                })
            }

            $(document).ready(function() {
                $('#delete-category').submit(function(e) {
                    e.preventDefault();
                    $("#delete-category .spinner-border").removeClass("d-none");

                    var formData = new FormData(this);

                    $.ajax({
                        type: 'POST',
                        url: "/dashboard-delete-category",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            res = JSON.parse(data);
                            $("#delete-category .spinner-border").addClass("d-none");

                            if (res.success) {
                                $(".modal-delete .alert-success").show();
                                destory();
                                prepare();
                            } else {
                                alert("Something went wrong!");
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

                $('#form').submit(function(e) {

                    e.preventDefault();
                    $("#form .spinner-border").removeClass("d-none")
                    var formData = new FormData(this);
                    $.ajax({
                        type: 'POST',
                        url: "/dashboard-add-category",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            res = JSON.parse(data)
                            $("#form .spinner-border").addClass("d-none")
                            if (res.success) {
                                $(".alert-success-insert").show();
                                destory();
                                prepare();
                            } else {
                                alert(res.error)
                            }
                            setTimeout(() => {
                                $(".modal-insert").modal("hide")
                                $(".alert-success-insert").hide();
                            }, 3000);

                        },
                        error: function(data) {
                            //console.log(data);
                        }
                    });

                });
                $('#form-update').submit(function(e) {
                    e.preventDefault();
                    $("#form-update .spinner-border").removeClass("d-none")
                    var formData = new FormData(this);

                    $.ajax({
                        type: 'POST',
                        url: "/dashboard-update-category",
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
                                $(".modal-update .alert-success").hide();

                            }, 3000);
                        },
                        error: function(data) {
                            console.log(data)
                        }
                    });
                });
            });

            function destory() {
                jQuery('#categoryDataTable').DataTable().destroy();

            }
        </script>
    @endsection
