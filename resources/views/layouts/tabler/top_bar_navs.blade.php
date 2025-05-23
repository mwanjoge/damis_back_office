<header class="nav-sub-menu navbar-expand-md container-fluid pt-3 ">
    <div class="navbar-collapse justify-content-center align-items-center border rounded-3 container-fluid"
        style="width: 100%;">
        <div class="text-center text-md-center text-black">
            <div class="container-xl">
                <div class="row flex-column flex-md-row flex-fill align-items-center">
                    <div class="col">
                        <!-- BEGIN NAVBAR MENU -->
                        <ul class="navbar-nav">
                            <li class="nav-item px-3">
                                <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                            <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-title"> Dashboard </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link {{ Request::is('requests*') ? 'active' : '' }}"
                                    href="/requests">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon icon-1">
                                        <path d="M12 3l8 4.5v9l-8 4.5-8-4.5v-9z" />
                                        <path d="M12 12l8-4.5" />
                                        <path d="M12 12v9" />
                                        <path d="M12 12l-8-4.5" />
                                        <path d="M16 5.25l-8 4.5" />
                                    </svg>
                                    <span class="nav-link-title">Requests</span>
                                </a>
                            </li>

                            <li class="nav-item px-3">
                                <a class="nav-link menu-link {{ Request::is('settings*') ? 'active' : '' }}"
                                    href="/settings">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon icon-1">
                                        <circle cx="12" cy="12" r="3"></circle>
                                        <path
                                            d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 1 1 0-4h.09a1.65 1.65 0 0 0 1.51-1 1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33h.09a1.65 1.65 0 0 0 1-1.51V3a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51h.09a1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82v.09a1.65 1.65 0 0 0 1.51 1H21a2 2 0 1 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1 1.65 1.65 0 0 0-.33 1.82l-.06.06a2 2 0 1 1-2.83 2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0 1.51-1z">
                                        </path>
                                    </svg>
                                    <span class="nav-link-title">Settings</span>
                                </a>
                            </li>

                            <li class="nav-item px-3">
                                <a class="nav-link menu-link {{ Request::is('human_resources*') ? 'active' : '' }}"
                                    href="/human_resources">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon icon-1">
                                        <path d="M20 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M4 21v-2a4 4 0 0 1 3-3.87"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <span class="nav-link-title">Human Resource</span>
                                </a>
                            </li>

                            <li class="nav-item px-3">
                                <a class="nav-link menu-link {{ Request::is('authentication*') ? 'active' : '' }}"
                                    href="/authentication">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon icon-1">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2">
                                        </rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                    <span class="nav-link-title">Authentication</span>
                                </a>
                            </li>

                            <li class="nav-item px-3">
                                <a class="nav-link menu-link {{ Request::is('audits*') ? 'active' : '' }}"
                                    href="/audits">
                                    <i class="bx bx-file"></i>
                                    <span class="nav-link-title">Audit Trail</span>
                                </a>
                            </li>

                        </ul>
                        <!-- END NAVBAR MENU -->
                    </div>

                </div>
            </div>
        </div>
    </div>
</header>
<style>
    .nav-link {
        transition: border-bottom 0.3s, color 0.3s;
    }

    .nav-link.active {
        color: #007bff !important;
        /* Blue color for active text */
        font-weight: bold;
        border-bottom: 3px solid #007bff;
        /* Blue underline */
        padding-bottom: 4px;
        /* Optional: adds space for underline */
    }

    .nav-link.active .icon {
        stroke: #007bff !important;
        /* Optional: icon stroke color */
    }
</style>