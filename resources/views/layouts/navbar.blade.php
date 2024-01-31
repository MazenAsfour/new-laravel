<header class="main_menu home_menu  @if(request()->is('menu')) noAbsolute @endif">
    <div class="container @if(request()->is('menu')) max-width @endif">
        <div class="row align-items-center @if(request()->is('menu')) menu-active @endif">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="index.html"> <img class="logo"
                            src="{{ asset('newtheme/img/1600w-9Gfim1S8fHg-removebg-previewas.png') }}" alt="logo">
                    </a>
                    @auth
                    <button type="button" class="icon-button displayAnotherModel" data-bs-toggle="modal"
                        data-bs-target="#notificationModal">
                        <span class="material-icons">notifications</span>
                        <span class="icon-button__badge">0</span>
                    </button>
                    @endauth

                    @if(request()->is('menu'))
                    <a href="/profile" class="  btn_2_reverse d-sm-block">profile</a>
                    @endif

                    <div class="menu_btn d-flex gap-2">
                        <a href="tel:0797894561" class="btn_2  d-sm-block"> Phone : 079 7894
                            561</a>
                        @auth
                        <a href="/logout" class="  btn_2_reverse d-sm-block">Logout</a>
                        @endauth
                        @guest
                        <a href="/login" class="  btn_2_reverse d-sm-block">Login / Register</a>

                        @endguest


                        <div class="modal fade" id="notificationModal" tabindex="-1"
                            aria-labelledby="notificationModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="notificationModalLabel">Notification Modal</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        You Don't have any notifaction
                                    </div>
                                    <div class="modal-footer">
                                        @auth
                                        <?php
    $user = auth()->user();

    if ($user && $userData = $user->userData) {
        $points = $userData->points;
    } else {
        $points = null;
    }
    ?>
                                        <div class="user-points">
                                            @if($points !== null)
                                            <p class="points-label">Total Points: <span
                                                    class="points-display">{{ $points }}</span></p>
                                            @else
                                            <p class="error-message">User not authenticated or user data not found</p>
                                            @endif
                                        </div>
                                        @endauth


                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>