@extends('dashboard.layouts.app')
@section('title')
    Product
@endsection
@push('custom-style')
    <style>
        textarea {
            min-height: 200px !important
        }

        tr td:last-child {
            width: 100px !important;
        }

        tr td:nth-child(2) {
            width: 100px !important;
        }

        tr td:nth-child(1) {
            width: 50px !important;
        }


        @media only screen and (min-width:900px) {

            .modal-update .modal-dialog,
            .modal-insert .modal-dialog {
                max-width: 880px;

            }

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
                            <h2 style="display: inline-block">Product</h2>
                            <button class="btn btn-primary" onclick="lanuchModalInsert()" style="margin-left:20px">Add New
                                Product</button>

                        </div>

                    </div>


                </div>

                <table id="productDataTable" class="table  table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>



            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade modal-insert" id="" tabindex="-1" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog d-flex justify-content-center">
                <div class="modal-content w-100">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Add Product</h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal"onclick="hideModal()"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form id="form" method="POST" action="/upload-image" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="square">
                                        <img class="product-pic"
                                            src="https://www.nbmchealth.com/wp-content/uploads/2018/04/default-placeholder.png">
                                        <div class="p-image">
                                            <i class="fa fa-upload upload-button"></i>
                                            <input id="prodcut-upload" class="file-upload" name="image" required
                                                type="file" accept="image/*" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-outline mb-4">
                                        <label class="form-label" id="">Product Name</label>
                                        <input type="text" id="pr_name" placeholder="Product name" name="pr_name"
                                            required class="form-control" />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" id=""> Category Name</label>
                                        <select class="form-select mb-4" name="category_id" aria-label="Default select "
                                            required>
                                            <option selected value="">Select Category</option>
                                            @foreach ($category as $c)
                                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" id="">Product Price (JD)</label>
                                        <input type="number" step="0.01"placeholder="10Jd" id="pr_price"
                                            name="pr_price" required class="form-control" />
                                    </div>
                                    <input type="hidden" name="type" value="">
                                    <input type="hidden" name="id" id="_id">

                                    <div class="form-outline mb-4">
                                        <label class="form-label" id="">Product Description</label>
                                        <textarea name="pr_description"placeholder="Product description" id="pr_description"class="form-control" required
                                            cols="4" rows="4"></textarea>
                                    </div>
                                    <div class="alert alert-success-insert alert-success ds-none"
                                        style="padding:8px 12px;font-size:14px" role="alert">
                                        Added Product Successfully
                                    </div>
                                    <div class="spinner-border spinner-border-sm d-none" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Add Product
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
                                <div class="col-md-6">
                                    <div class="square update">
                                        <img class="product-pic"
                                            src="https://www.nbmchealth.com/wp-content/uploads/2018/04/default-placeholder.png">
                                        <div class="p-image">
                                            <i class="fa fa-upload upload-button"></i>
                                            <input id="prodcut-upload-update" class="file-upload" name="image"
                                                type="file" accept="image/*" />

                                        </div>
                                        <p class="text-left">Click on image to change it.</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-outline mb-4">
                                        <label class="form-label" id=""> Name</label>
                                        <input type="text" id="update_pr_name" placeholder="Product Name"
                                            name="pr_name" required class="form-control" />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" id=""> Category Name</label>
                                        <select class="form-select mb-4" required name="category_id">
                                            <option selected value="">Select Category</option>
                                            @foreach ($category as $c)
                                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" id="">Product Price (JD)</label>
                                        <input type="number" step="0.01"placeholder="10Jd" id="update_pr_price"
                                            name="pr_price" required class="form-control" />
                                    </div>
                                    <input type="hidden" name="id" id="_id_update">
                                    <div class="form-outline mb-4">
                                        <label class="form-label" id="">Product Description</label>
                                        <textarea name="pr_description"placeholder="Product description" id="pr_description_update"class="form-control"
                                            required cols="4" rows="4"></textarea>
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




                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade " id="modal-view" tabindex="-1" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog d-flex justify-content-center">
                <div class="modal-content w-100">
                    <div class="modal-header">
                        <h5 class="modal-title" id=""> </h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal"onclick="hideModal()"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade modal-delete" id="modal-delete" tabindex="-1" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog d-flex justify-content-center">
                <div class="modal-content w-100">
                    <form id="delete-product">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="">Do You Want To Delete it</h5>
                            <button type="button" class="btn-close" onclick="hideModal()" data-mdb-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            Do You Want To delete This Product?
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
        <div id="myModal" class="modal">
            <span class="close">&times;</span>
            <img class="modal-content" id="img01">
            <div id="caption"></div>
        </div>
        <script>
            jQuery(document).ready(function($) {
                prepare()

            });

            function prepare() {
                $('#productDataTable').DataTable({
                    serverSide: true,
                    ajax: "{{ route('products.data') }}",
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
                                return '<img onclick="lanuchModalImage(' + row.id +
                                    ')" class="image_clickable" id="image_' + row.id +
                                    '" style="width:70px;height:70px;" src="' + row.image_path +
                                    '">';
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
                            data: 'category',
                            name: 'category',
                            render: function(data, type, row) {
                                return '<p id="category_' +
                                    row.id + '">' + row.category.name + '</p>';
                            }
                        },
                        {
                            data: 'price',
                            name: 'price',
                            render: function(data, type, row) {
                                return '<p id="price_' +
                                    row.id + '" data-price="' + row.price + '">' + row.price + ' Jd </p>';
                            }
                        },
                        {
                            data: 'description',
                            name: 'description',
                            render: function(data, type, row) {
                                return '<p id="description_' +
                                    row.id + '">' + row.description.substring(0, 250) + '...</p>';
                            }
                        },
                        {
                            data: null,
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                return '<i class="fa fa-eye pl-3 pointer" onclick="lanuchModalView(' + row
                                    .id +
                                    ')" aria-hidden="true"></i>' +
                                    '<i class="fa fa-pencil pl-3 pointer" onclick="lanuchModalUpdate(' + row
                                    .id +
                                    ',' + row.category
                                    .id + ')" aria-hidden="true"></i>' +
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

            function lanuchModalView(id) {
                $.ajax({
                    type: 'GET',
                    url: "/dashboard-single-product/" + id,
                    data: {

                    },
                    success: (data) => {
                        res = JSON.parse(data)
                        jQuery("#modal-view .modal-title").html(res.product.name)
                        html =
                            `<div>
                            <img class="w-100" src='` + res.product.image_path + `' />
                            <p class="mt-3"> Product Name : ` + res.product.name + `</p>
                            <p class="mt-2"> Product Price : ` + res.product.price + ` JD</p>
                            <p class="mt-2"> Product Description : ` + res.product.description + `</p>

                        </div>`;
                        jQuery("#modal-view .modal-body").html(html)
                        jQuery("#modal-view").modal("show")
                    },
                    error: function(data) {
                        //console.log(data);
                    }
                });
            }

            function lanuchModalUpdate(id, category_id) {
                $('.modal-update').modal("show");
                $(".modal-update select option").each(function() {
                    $(this).removeAttr("selected");
                })
                $(".modal-update select option[value='" + category_id + "']").attr("selected", true)
                $("#update-name").text($("#name_" + id).text())
                $("#update_pr_name").val($("#name_" + id).text())
                price = $("#price_" + id).attr("data-price");
                $("#update_pr_price").val(price.replace(/\$/g, ''))
                text = $("#description_" + id).text()
                $("#pr_description_update").val(text.trim())
                $(".update .product-pic").attr("src", $("#image_" + id).attr('src'))
                $("#_id_update").val(id)
            }


            function hideModal() {
                $(".modal").each(function() {
                    $(this).modal("hide")
                })
            }
            $("#myModal ,#myModal .close").click(function() {
                $("#myModal").hide();
            })

            function lanuchModalImage(id) {
                $("#myModal").show();
                $("#img01").attr("src", $("#image_" + id).attr('src'));
                $("#caption").text($("#name_" + id).text())
            }



            $(document).ready(function() {
                $('#delete-product').submit(function(e) {
                    e.preventDefault();
                    $("#delete-product .spinner-border").removeClass("d-none");

                    var formData = new FormData(this);

                    $.ajax({
                        type: 'POST',
                        url: "/dashboard-delete-product",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            res = JSON.parse(data);
                            $("#delete-product .spinner-border").addClass("d-none");

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
                        url: "/dashboard-add-product",
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
                        url: "/dashboard-update-product",
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

                var readURL = function(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('.product-pic').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]);
                    }
                }


                $("#prodcut-upload").on('change', function() {
                    readURL(this);
                });
                $("#prodcut-upload-update").on('change', function() {
                    $("#update-image").val("true")
                    readURL(this);
                });

                $("#form .upload-button ,#form .product-pic").on('click', function() {
                    $("#form .file-upload").click();
                });
                $("#form-update .upload-button ,#form-update .product-pic").on('click', function() {
                    $("#form-update .file-upload").click();
                });

            });

            function destory() {
                jQuery('#productDataTable').DataTable().destroy();

            }
        </script>
    @endsection
