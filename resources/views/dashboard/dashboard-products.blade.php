@extends('dashboard.layouts.app')
@section('title')
    Product
@endsection
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

        .p-20 {
            padding: 0 0 20px
        }

        #myImg {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        #myImg:hover {
            opacity: 0.7;
        }

        /* The Modal (background) */
        #myModal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.9);
            /* Black w/ opacity */
            z-index: 28;

        }

        /* Modal Content (image) */
        #myModal .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        /* Caption of Modal Image */
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        .tab-pane {
            display: none
        }

        .active {
            display: block !important
        }

        /* Add Animation */
        #myModal .modal-content,
        #myModal #caption {
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
            from {
                -webkit-transform: scale(0)
            }

            to {
                -webkit-transform: scale(1)
            }
        }

        @keyframes zoom {
            from {
                transform: scale(0)
            }

            to {
                transform: scale(1)
            }
        }

        #myModal .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #ffffff !important;
            font-size: 45px;
            z-index: 9999999;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px) {
            .modal-content {
                width: 100%;
            }
        }

        th,
        td {
            vertical-align: middle !important
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
                            <h2 style="display: inline-block">Product</h2>
                            <button class="btn btn-primary" onclick="lanuchModalInsert()" style="margin-left:20px">Add New
                                Product</button>
                            <span style="display: inline-block;float:right">
                                <input class="form-control" id="myInput" type="text" placeholder="Search..">
                            </span>
                        </div>

                    </div>


                </div>
                {{-- <div id="exTab1">
                    <ul class="nav nav-pills">
                        <li class="active">
                            <a href="#1a" data-toggle="tab">ِProducts</a>
                        </li>
                        <li>
                            <a href="#2a" data-toggle="tab">Camping</a>
                        </li>
                    </ul>
                </div> --}}

                <div id="1a" class="tab-pane active">
                    <div class="container">

                        <div class="well">
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>Product Price</th>
                                        <th>Product Description</th>
                                        <th style="width:150px!important">Product Created At</th>
                                        <th style="width: 15px;"></th>
                                        <th style="width: 15px;"></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr id="{{ $product->id }}">
                                            <td>{{ $product->id }}</td>
                                            <td><img id="{{ $product->id }}img"
                                                    onclick="lanuchModalImage({{ $product->id }})"
                                                    src="{{ $product->_image_path }}"
                                                    style="width:60px;height:60px;border-radius:100%"class="img-responsive pointer"
                                                    alt="#" /></td>
                                            <td id="{{ $product->id }}name">{{ $product->_name }}</td>
                                            <td id="{{ $product->id }}price">${{ $product->_price }}</td>
                                            <td id="{{ $product->id }}desc"style="width:520px">
                                                {{ $product->_description }}</td>
                                            <td>{{ $product->created_at }}</td>
                                            <td><i class="fa fa-pencil pointer"
                                                    onclick="lanuchModalUpdate({{ $product->id }})"
                                                    aria-hidden="true"></i>
                                            </td>
                                            <td><i class="fa fa-times pointer"
                                                    onclick="lanuchModalDelete({{ $product->id }})"
                                                    aria-hidden="true"></i></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>


            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade modal-insert" id="staticBackdrop1" tabindex="-1" aria-labelledby="exampleModalLabel1"
            aria-hidden="true">
            <div class="modal-dialog d-flex justify-content-center">
                <div class="modal-content w-100">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Add Product</h5>
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
                                        <img class="profile-pic"
                                            src="https://www.nbmchealth.com/wp-content/uploads/2018/04/default-placeholder.png">
                                        <div class="p-image">
                                            <i class="fa fa-camera upload-button"></i>
                                            <input id="prodcut-upload" class="file-upload" name="image" required
                                                type="file" accept="image/*" />
                                        </div>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" id="">Product Name</label>
                                        <input type="text" id="pr_name" name="pr_name" required class="form-control" />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" id="">Product Price(Per Day)</label>
                                        <input type="number" id="pr_price" name="pr_price" required
                                            class="form-control" />
                                    </div>
                                    <input type="hidden" name="type" value="">
                                    <input type="hidden" name="id" id="_id">
                                    {{-- <div class="form-outline mb-4">
                                        <label class="form-label" id=""> Catogory</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="catgory"  value="0" checked>
                                            <label class="form-check-label">
                                                Product
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input"  name="catgory" value="1" type="radio">
                                            <label class="form-check-label" >
                                                Camping
                                            </label>
                                        </div>
                                    </div> --}}
                                    <div class="form-outline mb-4">
                                        <label class="form-label" id="">Product Description</label>
                                        <textarea name="pr_description" id="pr_description"class="form-control" required cols="4" rows="4"></textarea>
                                    </div>
                                    <div class="alert alert-success-insert alert-success ds-none"
                                        style="padding:8px 12px;font-size:14px" role="alert">
                                        Added Product Successfully
                                    </div>
                                    <!-- Submit button -->
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
        <div class="modal fade modal-update" id="staticBackdrop1" tabindex="-1" aria-labelledby="exampleModalLabel1"
            aria-hidden="true">
            <div class="modal-dialog d-flex justify-content-center">
                <div class="modal-content w-100">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1"> Update </h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal"onclick="hideModal()"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form id="form-update" action="/upload-image" method="POST">
                            @csrf
                            <div class="row">
                                <div class="small-12 medium-2 large-2 columns">
                                    <div class="circle update">
                                        <img class="profile-pic"
                                            src="https://www.nbmchealth.com/wp-content/uploads/2018/04/default-placeholder.png">
                                        <div class="p-image">
                                            <i class="fa fa-camera upload-button"></i>
                                            <input id="prodcut-upload-update" class="file-upload" name="image"
                                                type="file" accept="image/*" />
                                        </div>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" id=""> Name</label>
                                        <input type="text" id="update_pr_name" name="pr_name" required
                                            class="form-control" />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" id=""> Price(Per Day)</label>
                                        <input type="number" id="update_pr_price" name="pr_price" required
                                            class="form-control" />
                                    </div>
                                    <input type="hidden" name="type" value="">
                                    <input type="hidden" name="id" id="_id_update">
                                    <input type="hidden" name="update-image" id="update-image" value="false">

                                    <div class="form-outline mb-4">
                                        <label class="form-label" id="">Product Description</label>
                                        <textarea name="pr_description" id="pr_description_update"class="form-control" required cols="4"
                                            rows="4"></textarea>
                                    </div>
                                    <div class="alert alert-success-update alert-success ds-none"
                                        style="padding:8px 12px;font-size:14px" role="alert">
                                        Updated Successfully
                                    </div>
                                    <!-- Submit button -->
                                    <button type="submit" class="btn btn-primary btn-block">Update
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade modal-delete" id="modal-delete" tabindex="-1" aria-labelledby="exampleModalLabel1"
            aria-hidden="true">
            <div class="modal-dialog d-flex justify-content-center">
                <div class="modal-content w-100">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1"> Want To Delete it</h5>
                        <button type="button" class="btn-close" onclick="hideModal()" data-mdb-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        Do You Want To delete This ?
                    </div>
                    <input type="hidden" id="idSelected">
                    <div class="alert alert-success ds-none" style="padding:8px 12px;font-size:14px;margin:0 10px 10px "
                        role="alert">
                        Deleted Seccuessfully
                    </div>
                    <div class="modal-footer text-right">
                        <button class="btn btn-light" onclick="hideModal()">Cancel</button>
                        <button class="btn btn-primary" onclick="delete()">Confirm And Delete</button>

                    </div>
                </div>
            </div>
        </div>
        <div id="myModal" class="modal">
            <span class="close">&times;</span>
            <img class="modal-content" id="img01">
            <div id="caption"></div>
        </div>
        <script>
            function lanuchModalDelete(id) {
                $('#modal-delete').modal("show");
                $("#idSelected").val(id)
            }

            function lanuchModalInsert() {
                $('.modal-insert').modal("show");

            }

            function lanuchModalUpdate(id) {
                $('.modal-update').modal("show");

                $("#update_pr_name").val($("#" + id + "name").text())
                price = $("#" + id + "price").text();
                $("#update_pr_price").val(price.replace(/\$/g, ''))
                text = $("#" + id + "desc").text()
                $("#pr_description_update").val(text.trim())
                $(".update .profile-pic").attr("src", $("#" + id + "img").attr('src'))
                $("#_id_update").val(id)

            }

            function update() {
                $.ajax({
                    type: "POST",
                    url: "/dashboard-update-s",
                    data: {
                        "pr_name": $("#update_pr_name").val(),
                        "pr_Price": $("#update_pr_price").val(),
                        "pr_description": $("#pr_description_update").val(),
                        "_token": $('#token').attr('content'),
                        "id": $("#_id_update").val(),

                    }, // serializes the form's elements.
                    success: function(data) {
                        console.log(data)
                        $(".alert-success-update").show();
                        setTimeout(() => {
                            location.reload();
                        }, 3000);

                    }
                });

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
                $(".update .profile-pic").attr("src", $("#" + id + "img").attr('src'))
                $("#myModal").show();
                $("#img01").attr("src", $("#" + id + "img").attr('src'));
                $("#caption").text($("#" + id + "name").text())
            }

            function delete() {

                var id = $("#idSelected").val();
                $.ajax({
                    method: "post",
                    url: "/dashboard-delete-s",
                    data: {
                        'id': id,
                        "_token": $('#token').attr('content'),
                    }
                }).done(function(data) {
                    res = JSON.parse(data);
                    if (res.success) {
                        $(".alert-success").show();
                        setTimeout(() => {
                            location.reload();
                        }, 3000);

                    }

                });

            }

            $(document).ready(function() {
                $('#form').submit(function(e) {
                    e.preventDefault();
                    id = add();
                    var formData = new FormData(this);

                    formData.append("pr_name", $("#pr_name").val());
                    formData.append("pr_Price", $("#pr_price").val());
                    formData.append("pr_description", $("#pr_description").val());
                    formData.append("_token", $('#token').attr('content'));
                    $.ajax({
                        type: 'POST',
                        url: "/upload-image",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            $(".alert-success-insert").show();
                            setTimeout(() => {
                                location.reload();
                            }, 3000);

                        },
                        error: function(data) {
                            //console.log(data);
                        }
                    });

                });
                $('#form-update').submit(function(e) {
                    e.preventDefault();
                    if ($("#update-image").val() == "true") {
                        setTimeout(() => {
                            var formData = new FormData(this);
                            $.ajax({
                                type: 'POST',
                                url: "/upload-image",
                                data: formData,
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: (data) => {
                                    update();
                                },
                                error: function(data) {
                                    //console.log(data);
                                }
                            });
                        }, 1000);
                    } else {
                        update();
                    }


                });
                $(".nav-pills li").each(function() {
                    $(this).click(function() {
                        $(this).removeClass("active")
                    })
                })
                $(".nav-pills li a").each(function() {
                    $(this).click(function() {
                        $(".nav-pills li").each(function() {
                            $(this).removeClass("active");
                        })

                    })

                })
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('#token').attr('content')
                    }
                });

                var readURL = function(input) {
                    if (input.files && input.files[0]) {
                        // console.log()
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('.profile-pic').attr('src', e.target.result);
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

                $("#form .upload-button ,#form .profile-pic").on('click', function() {
                    $("#form .file-upload").click();
                });
                $("#form-update .upload-button ,#form-update .profile-pic").on('click', function() {
                    $("#form-update .file-upload").click();
                });
                $("#myInput").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#myTable tr").not(':first').filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        </script>
    @endsection
