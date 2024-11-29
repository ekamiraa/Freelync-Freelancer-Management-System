<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

        <a href="index.html" class="logo d-flex align-items-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <img src="{{ asset('assets/img/logo.png') }}" alt="logo.png">
            <h1 class="sitename">Freelync</h1> <span>.</span>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                @if (Route::has('login'))
                                @auth
                                    <li><a href="{{ url('/dashboard') }}" class="">Login</a>
                                    </li>

                                @else
                                    <li><a href="{{ route('login') }}" class="">Login</a>
                                    </li>

                                    @if (Route::has('register'))
                                        <li><a href="{{ route('register') }}" class="">Register</a>
                                    @endif

                                @endauth
                    </div>
                @endif
    </ul>
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

    </div>
</header>