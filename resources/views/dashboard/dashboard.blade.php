@extends('dashboard.layouts.app')
@section('title')
    Dashboard
@endsection
@push('custom-style')
    <style>
        .msg_list_main ul li>span img {
            height: 68px !important;
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
                            <h2>Dashboard</h2>
                        </div>
                    </div>
                </div>
                <div class="row column4 graph">
                    <div class="col-md-6 ">
                        <div class="dash_blog" style="
                           min-height: 462px;
                       ">
                            <div class="dash_blog_inner">
                                <div class="dash_head">
                                    <h3><span><i class="fa fa-cog"></i> Site Name</span></h3>
                                </div>

                                <div class="task_list_main p-4">
                                    <form id="form-options" class="mt-2" action="/dashboard-set-options"
                                        enctype="multipart/form-data" method="POST">
                                        @csrf
                                        <img style="border-radius: 50%; width: 100px; height: 100px; object-fit: cover;"
                                            src="{{ $logo->option_value }}" alt="">

                                        <div class="form-outline mb-4 mt-4">
                                            <label class="form-label" id="">Change Logo</label>
                                            <input type="file" name="image" class="form-control" />
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" id=""> Site Name</label>
                                            <input type="text" name="restaurant_name" value="{{ $name->option_value }}"
                                                placeholder="Site Name" required class="form-control" />
                                        </div>
                                        <div class="spinner-border spinner-border-sm d-none" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <div class="alert alert-success ds-none" style="padding:8px 12px;font-size:14px"
                                            role="alert">
                                            Updated Seccuessfully
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 row">

                        <div class="col-md-6">
                            <div class="full counter_section margin_bottom_30">
                                <div class="couter_icon">
                                    <div>
                                        <i class="fa fa-user yellow_color"></i>
                                    </div>
                                </div>
                                <div class="counter_no">
                                    <div>
                                        <p class="total_no">{{ $all_users }}</p>
                                        <p class="head_couter">Total Users</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="full counter_section margin_bottom_30">
                                <div class="couter_icon">
                                    <div>
                                        <i class="fa fa-product-hunt blue1_color"></i>
                                    </div>
                                </div>
                                <div class="counter_no">
                                    <div>
                                        <p class="total_no">{{ $totalProducts }}</p>
                                        <p class="head_couter">Total Porducts</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="full counter_section margin_bottom_30">
                                <div class="couter_icon">
                                    <div>
                                        <i class="fa fa-spinner green_color"></i>
                                    </div>
                                </div>
                                <div class="counter_no">
                                    <div>
                                        <p class="total_no">{{ $all_requests }}</p>
                                        <p class="head_couter">All Requests</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="full counter_section margin_bottom_30">
                                <div class="couter_icon">
                                    <div>
                                        <i class="fa fa-bell red_color"></i>
                                    </div>
                                </div>
                                <div class="counter_no">
                                    <div>
                                        <p class="total_no">{{ $adminRequestsNonReadable }}</p>
                                        <p class="head_couter">Requests non readbale</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $('#form-options').submit(function(e) {
                    e.preventDefault();
                    $("#form-options .spinner-border").removeClass("d-none");

                    var formData = new FormData(this);

                    $.ajax({
                        type: 'POST',
                        url: "/dashboard-set-options",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            res = JSON.parse(data);
                            $("#form-options .spinner-border").addClass("d-none");
                            if (res.success) {
                                $("#form-options .alert-success").removeClass("ds-none");

                            } else {
                                alert(res.error);
                            }
                            setTimeout(() => {
                                location.reload();
                            }, 3000);
                        },
                        error: function(data) {}
                    });
                });
            </script>
        @endsection
