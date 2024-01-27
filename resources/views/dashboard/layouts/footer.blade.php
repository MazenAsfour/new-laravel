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
     <script></script>
 @endpush
