<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

        <a href="index.html" class="logo d-flex align-items-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <img src="{{ asset('assets/img/logo.png') }}" alt="logo.png">
            <h1 class="sitename">Freelync</h1> <span>.</span>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ route('dashboard.freelancer') }}"
                        class="{{ Route::is('dashboard.freelancer') ? 'active' : '' }}">Home</a>
                </li>
                <li><a href="{{ route('freelancer.search-project') }}"
                        class="{{ Route::is('freelancer.search-project') ? 'active' : '' }}">Search
                        Project</a></li>
                <li><a href="{{ route('freelancer.project') }}"
                        class="{{ Route::is('freelancer.project') || Route::is('task') ? 'active' : '' }}">My
                        Project</a></li>
                <li><a href="{{ route('review') }}" class="{{ Route::is('review') ? 'active' : '' }}">Review</a></li>

                @php
                    $notifications = auth()->user()->unreadNotifications()->get();
                @endphp
                <!-- Notification Icon -->
                <li class="dropdown">
                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell-fill toggle-dropdown"></i>
                        <span class="badge bg-primary badge-number">{{ $notifications->count()}}</span>
                    </a>
                    <ul>
                        <li><a href="#">You have {{ $notifications->count()}} new notifications</a></li>
                        <!-- Notification Message -->

                        @foreach ($notifications->take(4) as $notification)
                            <li><a href="#">{{ Str::limit($notification->data['message'], 50) }}</a></li>
                        @endforeach

                        <li>
                            <a href="{{ route('notifications') }}">Show all notification</a>
                            <i class="bi bi-arrow-right"></i>
                        </li>
                    </ul>
                </li>

                <!-- Profile -->
                <li class="dropdown">
                    <a href="#">
                        <img src="{{ asset('storage/pictures/' . auth()->user()->picture) }}" alt="Profile Picture"
                            class="header-img">
                    </a>
                    <ul>
                        <li><a href="{{ route('profile', auth()->user()->id) }}">My profile</a></li>
                        <li><a href="{{ route('update-profile', auth()->user()->id) }}">Edit profile</a></li>
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