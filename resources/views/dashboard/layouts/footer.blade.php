 <!-- footer -->
 <div class="container-fluid">
     {{-- <div class="footer">
      <p>Copyright © 2018 Designed by html.design. All rights reserved.<br><br>
         Distributed By: <a href="https://themewagon.com/">ThemeWagon</a>
      </p>
   </div> --}}
 </div>
 </div>
 </div>
 </div>
 </div>
 <div id="overlayNoti"></div>

 <style>
     .bold {
         font-weight: 600
     }

     .date_noti {
         position: absolute;
         right: 5px;
     }

     #overlayNoti {
         position: fixed;
         display: none;
         width: 100%;
         height: 100%;
         top: 0;
         left: 0;
         right: 0;
         bottom: 0;
         background-color: rgba(0, 0, 0, 0.5);
         /* Black background with opacity */
         z-index: 1;
         /* Specify a stack order in case you're using a different order for other elements */
         cursor: pointer;
         /* Add a pointer on hover */
     }

     .sec {
         position: relative;
         min-height: 80px;
     }
 </style>
 @push('custom-script')
     <script>
         var notificationArea = document.querySelector("#area-notifications");
         $(document).ready(function() {
             $.ajax({
                 method: "get",
                 url: "/dashboard-get-unread-contact",

             }).done(function(data) {
                 data1 = JSON.parse(data);
                 $(".messageCount").text(data1.messageCount)
             });

             $.ajax({
                 method: "get",
                 url: "/dashboard-notifications",

             }).done(function(dataJson) {
                 data = JSON.parse(dataJson);
                 //console.log(data[0].notifiable_type)
                 //console.log(data[1].notifiable_type)

                 //console.log("hello");

                 for (var i in data) {
                     if (data[i].notifiable_type == 'App\\Models\\User') {
                         var isRead = data[i].is_read;
                         var dataInSide = data[i].data;
                         var dataInSide = JSON.parse(data[i].data);
                         // //console.log(data[i].data);
                         //  notificationArea.innerHTML = "";
                         var date = new Date(data[i].created_at);
                         myArray = String(date).split(" ");
                         if (data[i].read_at == null) {
                             notificationArea.innerHTML +=
                                 '<div class="sec new" ><a href="/dashboard-users"><div class="profCont"><p class="date_noti bold">' +
                                 myArray[0] + " " + myArray[4] + '</p><img id=' +
                                 dataInSide.id +
                                 'imgNoti class="profile" src="https:\/\/cambodiaict.net\/wp-content\/uploads\/2019\/12\/computer-icons-user-profile-google-account-photos-icon-account.jpg"></div><div class="txt"><h6 class="titleNoti bold">' +
                                 dataInSide.title +
                                 '</h6><p class="bold text-noti">There is new Member have email ' +
                                 dataInSide.email + '</p></div></a></div';
                         } else {
                             notificationArea.innerHTML +=
                                 '<div class="sec new" ><a href="/dashboard-users"><div class="profCont"><p class="date_noti">' +
                                 myArray[0] + " " + myArray[4] + '</p><img id=' +
                                 dataInSide.id +
                                 'imgNoti class="profile" src="https:\/\/cambodiaict.net\/wp-content\/uploads\/2019\/12\/computer-icons-user-profile-google-account-photos-icon-account.jpg"></div><div class="txt"><h6 class="titleNoti ">' +
                                 dataInSide.title +
                                 '</h6><p class=" text-noti">There is new Member have email ' +
                                 dataInSide.email + '</p></div></a></div';
                         }
                         getImage(dataInSide.id);
                     } else if (data[i].notifiable_type == 'App\\Models\\Admin') {
                         var isRead = data[i].is_read;
                         var dataInSide = data[i].data;
                         var dataInSide = JSON.parse(data[i].data);
                         // //console.log(data[i].data);
                         //  notificationArea.innerHTML = "";
                         var date = new Date(data[i].created_at);
                         //console.log(dataInSide)
                         myArray = String(date).split(" ");
                         if (data[i].read_at == null) {
                             notificationArea.innerHTML +=
                                 '<div class="sec new" ><a href="/dashboard-admins"><div class="profCont"><p class="date_noti bold">' +
                                    myArray[0] + " " + myArray[4] + '</p><img id=' +
                                 dataInSide.admin_id +
                                 'imgNoti class="profile" src="https:\/\/cambodiaict.net\/wp-content\/uploads\/2019\/12\/computer-icons-user-profile-google-account-photos-icon-account.jpg"></div><div class="txt"><h6 class="titleNoti bold">' +
                                 dataInSide.title +
                                 '</h6></div></a></div';
                         } else {
                             notificationArea.innerHTML +=
                                 '<div class="sec new" ><a href="/dashboard-users"><div class="profCont"><p class="date_noti">' +
                                    myArray[0] + " " + myArray[4] + '</p><img id=' +
                                 dataInSide.admin_id +
                                 'imgNoti class="profile" src="https:\/\/cambodiaict.net\/wp-content\/uploads\/2019\/12\/computer-icons-user-profile-google-account-photos-icon-account.jpg"></div><div class="txt"><h6 class="titleNoti ">' +
                                 dataInSide.title +
                                 '</h6></div></a></div';
                         }
                         getImage(dataInSide.admin_id);
                         //console.log(dataInSide.admin_id)
                     }
                 }
             });
             $("#overlayNoti").click(function() {
                 $('.box').toggle();
                 $('#overlayNoti').toggle();
             })
             $(".fa-bell-o").click(function() {
                 $('.box').toggle();
                 $('#overlayNoti').toggle();
                 $.ajax({
                     method: "get",
                     url: "/dashboard-read-notifications",

                 }).done(function(dataJson) {
                     if (dataJson !== '') {
                         data = JSON.parse(dataJson);
                         $('.messageNotification').text(data.count)

                     }
                 })
             })


         })
         $.ajax({
             method: "get",
             url: "/dashboard-count-notifications",

         }).done(function(dataJson) {
             data = JSON.parse(dataJson);
             $('.messageNotification').text(data.count)
         })

         function getImage(id) {
             $.ajax({
                 method: "get",
                 url: "/dashboard-notifications-image/" + id,

             }).done(function(dataJson) {
                //console.log(data,id)

                 $("#" + id + "imgNoti").attr("src", dataJson[0].image_path);
             })

         }
     </script>
 @endpush
