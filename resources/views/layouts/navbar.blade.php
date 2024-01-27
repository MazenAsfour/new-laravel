<header class="main_menu home_menu">
    <div class="container">
        <div class="row align-items-center @if(request()->is('menu')) menu-active @endif">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="index.html"> <img class="logo"
                            src="{{ asset('newtheme/img/1600w-9Gfim1S8fHg-removebg-previewas.png') }}" alt="logo">
                    </a>

                    <div class="menu_btn d-flex gap-2">
                        <a href="tel:0797894561" class="btn_2  d-sm-block"> Phone : 079 7894
                            561</a>
                        @auth
                        <a href="/logout" class="  btn_2_reverse d-sm-block">Logout</a>
                        @endauth
                        @guest
                        <a href="/login" class="  btn_2_reverse d-sm-block">Login / Register</a>

                        @endguest

                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>