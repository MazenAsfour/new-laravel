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
                                        <img src="{{ $logo->option_value }}" width="100px;height:100px;object-fit:cover"
                                            alt="">
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
                                        <button type="submit" class="btn btn-primary btn-block">Update
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="full counter_section margin_bottom_30">
                            <div class="couter_icon">
                                <div>
                                    <i class="fa fa-user yellow_color"></i>
                                </div>
                            </div>
                            <div class="counter_no">
                                <div>
                                    <p class="total_no">250</p>
                                    <p class="head_couter">Welcome</p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="full counter_section margin_bottom_30">
                            <div class="couter_icon">
                                <div>
                                    <i class="fa fa-clock-o blue1_color"></i>
                                </div>
                            </div>
                            <div class="counter_no">
                                <div>
                                    <p class="total_no">123.50</p>
                                    <p class="head_couter">Average Time</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row column1">


                    <div class="col-md-6 col-lg-3">
                        <div class="full counter_section margin_bottom_30">
                            <div class="couter_icon">
                                <div>
                                    <i class="fa fa-cloud-download green_color"></i>
                                </div>
                            </div>
                            <div class="counter_no">
                                <div>
                                    <p class="total_no">1,805</p>
                                    <p class="head_couter">Collections</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="full counter_section margin_bottom_30">
                            <div class="couter_icon">
                                <div>
                                    <i class="fa fa-comments-o red_color"></i>
                                </div>
                            </div>
                            <div class="counter_no">
                                <div>
                                    <p class="total_no">54</p>
                                    <p class="head_couter">Comments</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row column1 social_media_section">
                    <div class="col-md-6 col-lg-3">
                        <div class="full socile_icons fb margin_bottom_30">
                            <div class="social_icon">
                                <i class="fa fa-facebook"></i>
                            </div>
                            <div class="social_cont">
                                <ul>
                                    <li>
                                        <span><strong>35k</strong></span>
                                        <span>Friends</span>
                                    </li>
                                    <li>
                                        <span><strong>128</strong></span>
                                        <span>Feeds</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="full socile_icons tw margin_bottom_30">
                            <div class="social_icon">
                                <i class="fa fa-twitter"></i>
                            </div>
                            <div class="social_cont">
                                <ul>
                                    <li>
                                        <span><strong>584k</strong></span>
                                        <span>Followers</span>
                                    </li>
                                    <li>
                                        <span><strong>978</strong></span>
                                        <span>Tweets</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="full socile_icons linked margin_bottom_30">
                            <div class="social_icon">
                                <i class="fa fa-linkedin"></i>
                            </div>
                            <div class="social_cont">
                                <ul>
                                    <li>
                                        <span><strong>758+</strong></span>
                                        <span>Contacts</span>
                                    </li>
                                    <li>
                                        <span><strong>365</strong></span>
                                        <span>Feeds</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="full socile_icons google_p margin_bottom_30">
                            <div class="social_icon">
                                <i class="fa fa-google-plus"></i>
                            </div>
                            <div class="social_cont">
                                <ul>
                                    <li>
                                        <span><strong>450</strong></span>
                                        <span>Followers</span>
                                    </li>
                                    <li>
                                        <span><strong>57</strong></span>
                                        <span>Circles</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- graph -->
                <div class="row column2 graph margin_bottom_30">
                    <div class="col-md-l2 col-lg-12">
                        <div class="white_shd full">
                            <div class="full graph_head">
                                <div class="heading1 margin_0">
                                    <h2>Extra Area Chart</h2>
                                </div>
                            </div>
                            <div class="full graph_revenue">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="content">
                                            <div class="area_chart">
                                                <canvas height="120" id="canvas"></canvas>
                                            </div>
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
