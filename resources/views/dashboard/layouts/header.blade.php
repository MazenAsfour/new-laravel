@php
    use App\Models\UserData;
    use App\Models\ConfigOption;
    use App\Models\NotificationRequests;
    $countUnreadRequests = NotificationRequests::where('is_admin_read', 0)->count();
    $UserData = UserData::where('user_id', Auth::user()->id)->first();
    $logo = ConfigOption::where('option_name', 'logo')->first();
    $name = ConfigOption::where('option_name', 'restaurant_name')->first();
@endphp
<style>
    .headercount {
        font-size: 13px;
        line-height: 16px;
        padding: 5px 9px;
        background: #ff6426;
        border-radius: 100%;
        color: #fff;
        font-weight: 600;
    }

    .active {
        background-color: unset !important
    }

    .profile_img img {
        height: 178px
    }

    .nav-pills .active,
    .nav-pills .show {
        background: #ff6426 !important;
        border-radius: 6px;
    }

    .user_img img {
        height: 75px
    }
</style>
<div class="dashboard dashboard_1">
    <div class="full_container" style="top: 0;
    position: absolute;">
        <div class="inner_container">
            <!-- Sidebar  -->
            <nav id="sidebar">
                <div class="sidebar_blog_1">
                    <div class="sidebar-header">
                        <i class="fa fa-times"></i>
                        <div class="logo_section">
                            <a href="/dashboard"><img class="logo_icon img-responsive rounded-circle"
                                    src="{{ $logo->option_value }}" style="object-fit: cover;width:62px"
                                    alt="#" /></a>
                        </div>
                    </div>
                    <div class="sidebar_user_info">
                        <div class="icon_setting"></div>
                        <div class="user_profle_side">
                            <div class="user_img"><img class="img-responsive" src="{{ $UserData->image_path }}"
                                    alt="#" /></div>
                            <div class="user_info">
                                <a href="/dashboard-admin-profile">
                                    <h6>{{ Auth::user()->name }}</h6>
                                    <p><span class="online_animation"></span> Online</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sidebar_blog_2">
                    <h4>General</h4>
                    <ul class="list-unstyled components">
                        <li class="active">
                            <a href="/dashboard"><i class="fa fa-dashboard orange_color2"></i>
                                <span>Dashboard</span></a>

                        </li>
                        <li><a href="/dashboard-admins"><i class="fa fa-user-plus orange_color2" aria-hidden="true"></i>
                                <span>Admins</span></a></li>

                        <li><a href="/dashboard-users"><i class="fa fa-users orange_color2" aria-hidden="true"></i>
                                <span>Users</span></a></li>

                        <li><a href="/dashboard-users-plus"><i class="fa fa-user-secret orange_color2"
                                    aria-hidden="true"></i>
                                <span>Users have more 7 points</span></a></li>

                        <li><a href="/dashboard-categories"><i class="fa fa-cutlery  orange_color2"
                                    aria-hidden="true"></i>
                                </i> <span>Categories</span></a>
                        </li>
                        <li><a href="/dashboard-products"><i class="fa fa-product-hunt  orange_color2"
                                    aria-hidden="true"></i>
                                </i> <span>Prdoucts</span></a></li>

                        <li><a href="/dashboard-points"><i class="fa fa-user-plus  orange_color2"
                                    aria-hidden="true"></i>
                                </i> <span>User Points</span><span class="notfiy_"
                                    id="unread_requests">{{ $countUnreadRequests }}</span></a></li>


                    </ul>
                </div>
            </nav>
            <!-- end sidebar -->
            <!-- topbar -->
            <div class="topbar">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="full">
                        <button type="button" style="min-height: 60px;" id="sidebarCollapse" class="sidebar_toggle"><i
                                class="fa fa-bars"></i></button>
                        <div class="logo_section">
                            <a href="/dashboard" style="text-transform: capitalize">{{ $name->option_value }}</a>
                        </div>
                        <div class="right_topbar">
                            <div class="icon_info">

                                <ul class="user_profile_dd">
                                    <li>
                                        <a class="dropdown-toggle" data-toggle="dropdown"><img
                                                class="img-responsive rounded-circle" src="{{ $UserData->image_path }}"
                                                alt="#" /><span
                                                class="name_user">{{ Auth::user()->name }}</span></a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="/dashboard-admin-profile">My
                                                Profile</a>
                                            <a class="dropdown-item" href="/logout"><span>Log Out</span> <i
                                                    class="fa fa-sign-out"></i></a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <input type="hidden" name="" id="TopBar">
            <!-- end topbar -->
            <script>
                $("#sidebarCollapse").click(function() {

                    var x = window.matchMedia("(min-width: 900px)")
                    if (x.matches) {
                        if ($("#TopBar").val() == 1) {
                            $("#TopBar").val(0)
                            $(".topbar").css("padding-left", "280px")
                            $("#content").css("padding-left", "305px")
                        } else {
                            $("#TopBar").val(1)
                            $(".topbar").css("padding-left", "86px")
                            $("#content").css("padding-left", "116px")
                        }
                    }


                })
                jQuery(".right_topbar .dropdown-toggle").click(function() {
                    jQuery(".right_topbar .dropdown-menu").toggle()
                })
                $("#sidebar .fa-times").click(function() {
                    jQuery("#sidebarCollapse").click()
                })
            </script>
