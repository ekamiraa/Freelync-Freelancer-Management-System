<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

        <a href="index.html" class="logo d-flex align-items-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <h1 class="sitename">UpConstruction</h1> <span>.</span>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="index.html" class="active">Home</a></li>
                <li class="dropdown">
                    <a href="#"><span>Project</span>
                        <i class="bi bi-chevron-down toggle-dropdown"></i>
                    </a>
                    <ul>
                        <li><a href="#">Search Project</a></li>
                        <li><a href="#">My Project</a></li>
                    </ul>
                </li>
                <li><a href="about.html">Task</a></li>
                <li><a href="services.html">Review</a></li>

                <!-- Notification Icon -->
                <li class="dropdown">
                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell-fill toggle-dropdown"></i>
                        <span class="badge bg-primary badge-number">4</span>
                    </a>
                    <ul>
                        <li><a href="#">You have 4 new notifications</a></li>
                        <!-- Notification Message -->
                        <li><a href="#">Quae dolorem earum veritatis oditseno</a></li>
                        <li><a href="#">Quae dolorem earum veritatis oditseno</a></li>
                        <li><a href="#">Quae dolorem earum veritatis oditseno</a></li>
                        <li>
                            <a href="#">Show all notification</a>
                            <i class="bi bi-arrow-right"></i>
                        </li>
                    </ul>
                </li>

                <!-- Profile -->
                <li class="dropdown">
                    <a href="#">
                        <img src="../assets/img/testimonials/testimonials-2.jpg" class="header-img" alt="">
                    </a>
                    <ul>
                        <li><a href="{{ route('profile', auth()->user()->id) }}">My profile</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="d-flex align-items-center">
                                @csrf
                                <a href="{{ route('logout') }}" class="dropdown-item d-flex align-items-center"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Sign Out
                                </a>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

    </div>
</header>