<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link menu-link active" href="/" >
                        <i class="las la-tachometer-alt"></i> <span>Dashboard</span>
                    </a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/requests" >
                        <i class="las la-list-alt"></i> <span>Requests</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#" >
                        <i class="las la-columns"></i> <span>Reports</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="/settings">
                        <i class="las la-flask"></i> <span>Settings</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="/authentication">
                        <i class="las la-lock"></i> <span>Authentication</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
