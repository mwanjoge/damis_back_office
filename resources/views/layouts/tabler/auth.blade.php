<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>DAMIS</title>
    @include('layouts.tabler.css_files_links')
    <style>
        @import url("https://rsms.me/inter/inter.css");
    </style>
    <!-- END CUSTOM FONT -->
    @livewireStyles


    <link href="{{ asset('styles/custom_style.css') }}" rel="stylesheet">

</head>

<body>
    <script src="{{ asset('vendors/tabler/js/tabler-theme.min.js') }}"></script>
    <!-- END GLOBAL THEME SCRIPT -->
    <div class="page" style="min-height: 1vh;">
        <!-- BEGIN NAVBAR  -->
        <header class="navbar navbar-expand-md navbar-light bg-white shadow-sm "
            style=" background-image: url('{{ URL::asset('images/flag.png') }}'); background-size: cover; background-position: center; position: relative;">
            <div
                style="position: absolute; top: 0; left: 0; height: 100%; width: 100%; background-color: rgba(0, 0, 0, 0.6); z-index: 0;">
            </div>
            <div class="container-xl d-flex justify-content-between align-items-center"
                style="position: relative; z-index: 2;">

                <!-- BEGIN NAVBAR LOGO -->
                <div class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal">
                    <a href="index">
                        <div>
                            <img src="{{ URL::asset('images/emblem.png') }}" alt="" width="8%;">
                        </div>
                    </a>
                </div>

                <!-- END NAVBAR LOGO -->
                <div class="navbar-nav flex-row order-md-last">
                    <div class="nav-item dropdown">
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">

                            <a class="dropdown-item" href="{{ route('user-profile') }}"><i
                                    class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                                    class="align-middle">Profile</span></a>

                            <a class="dropdown-item" href="pages-profile-settings"><i
                                    class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i> <span
                                    class="align-middle">Settings</span></a>
                            <a class="dropdown-item " href="javascript:void();"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                    class="bx bx-power-off font-size-16 align-middle me-1"></i> <span
                                    key="t-logout">@lang('translation.logout')</span></a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Centered Title Block -->
            <div class="position-absolute top-50 start-50 translate-middle text-center">
                <h1 class="mb-0 text-white"
                    style="font-size: 1.5rem; font-weight: 600; letter-spacing: 3px; color: white;">D A M I S</h1>
                <h4 class="mb-0  text-white" style="font-size: 0.9rem; font-weight: 400;">
                    Ministry of Foreign Affairs and East African Cooperation
                </h4>
            </div>

        </header>
    </div>
    <!-- END NAVBAR  -->
    
    @yield('content')
   
    <!-- END PAGE WRAPPER -->
    @include('layouts.tabler.js_files_links')
    @yield('script')
</body>
</html>