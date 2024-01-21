@extends("dashboard.layouts.app")
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
          <div class="row column1">
             <div class="col-md-6 col-lg-3">
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
             <div class="col-md-6 col-lg-3">
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
          <!-- end graph -->
          
          <div class="row column4 graph">
             <div class="col-md-6 margin_bottom_30">
                <div class="dash_blog">
                   <div class="dash_blog_inner">
                      <div class="dash_head">
                         <h3><span><i class="fa fa-calendar"></i> 6 July 2018</span><span class="plus_green_bt"><a href="#">+</a></span></h3>
                      </div>
                      <div class="list_cont">
                         <p>Today Tasks for Ronney Jack</p>
                      </div>
                      <div class="task_list_main">
                         <ul class="task_list">
                            <li><a href="#">Meeting about plan for Admin Enhancing 2023</a><br><strong>10:00 AM</strong></li>
                            <li><a href="#">Create new task for Dashboard</a><br><strong>10:00 AM</strong></li>
                            <li><a href="#">Meeting about plan for Admin Modifying Users Roles</a><br><strong>11:00 AM</strong></li>
                            <li><a href="#">Create new task for Interface</a><br><strong>10:00 AM</strong></li>
                            <li><a href="#">Meeting about plan for Admin Modifying Database Structure</a><br><strong>02:00 PM</strong></li>
                         </ul>
                      </div>
                      <div class="read_more">
                         <div class="center"><a class="main_bt read_bt" href="#">Read More</a></div>
                      </div>
                   </div>
                </div>
             </div>
             <div class="col-md-6">
                <div class="dash_blog">
                   <div class="dash_blog_inner">
                      <div class="dash_head">
                         <h3><span><i class="fa fa-comments-o"></i> Updates</span><span class="plus_green_bt"><a href="#">+</a></span></h3>
                      </div>
                      <div class="list_cont">
                         <p>Last User confirmation</p>
                      </div>
                      <div class="msg_list_main">
                         <ul class="msg_list">
                           @foreach ($users as $user)
                               <li>
                                 <span><img src="{{$user->image}}" class="img-responsive" alt="#" /></span>
                                 <span>
                                 <span class="name_user">{{$user->name}}</span>
                                 <span class="msg_user">{{$user->about_user}}</span>
                                 <span class="time_ago">{{{$user->last_login}}}</span>
                                 </span>
                              </li>
                           @endforeach
                         </ul>
                      </div>
                      <div class="read_more">
                         <div class="center"><a class="main_bt read_bt" href="/dashboard-users">Read More</a></div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>

 <!-- end dashboard inner -->
@endsection