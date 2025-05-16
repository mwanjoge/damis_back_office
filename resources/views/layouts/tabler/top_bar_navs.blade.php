<header class="navbar-expand-md">
            <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="navbar">
                <div class="container-xl">
                <div class="row flex-column flex-md-row flex-fill align-items-center">
                    <div class="col">
                    <!-- BEGIN NAVBAR MENU -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                        <a class="nav-link" href="/">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"
                            ><!-- Download SVG icon from http://tabler.io/icons/icon/home -->
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-1"
                            >
                                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg
                            ></span>
                            <span class="nav-link-title"> Dashboard </span>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a
                            class="nav-link"
                            href="/requests"
                            role="button"
                            aria-expanded="false"
                        >
                            <span class="nav-link-icon d-md-none d-lg-inline-block"
                            ><!-- Download SVG icon from http://tabler.io/icons/icon/package -->
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-1"
                            >
                                <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                                <path d="M12 12l8 -4.5" />
                                <path d="M12 12l0 9" />
                                <path d="M12 12l-8 -4.5" />
                                <path d="M16 5.25l-8 4.5" /></svg
                            ></span>
                            <span class="nav-link-title"> Requests </span>
                        </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ Request::is('settings*')?'active':'' }}" href="/settings">
                                <i class="las la-flask"></i> <span>Settings</span>
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('human_resources*')?'active':'' }}">
                            <a class="nav-link menu-link {{ Request::is('human_resources*')?'active':'' }}" href="/human_resources">
                                <i class="las la-flask"></i> <span>HR</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="/authentication">
                                <i class="las la-lock"></i> <span>Authentication</span>
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