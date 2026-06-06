<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/materi-admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/materi-siswa.css') }}">
</head>
<body class="dashboard-body">

    <div class="dashboard-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-content">
                <!-- Profile Section -->
                <div class="profile-section">
                    <div class="avatar-wrapper">
                        @php
                            $bgColor = auth()->user()->role === 'admin' ? 'DC1591' : '4f46e5';
                        @endphp
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'User') }}&background={{ $bgColor }}&color=fff&bold=true"
                            alt="Profile" class="avatar">
                    </div>
                    <h5 class="profile-name">{{ auth()->user()->name ?? 'User' }}</h5>
                    <p class="profile-email">{{ auth()->user()->email ?? 'email@example.com' }}</p>
                </div>

                <!-- Navigation -->
                <nav class="sidebar-nav">
                    <ul class="nav-list">
                        @if(auth()->user()->role === 'admin')
                            <!-- Admin Menu -->
                            <li>
                                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                    <i class="bi bi-house-door"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('materi.admin.index') }}" class="nav-link {{ request()->routeIs('materi.admin.index') ? 'active' : '' }}">
                                    <i class="bi bi-book-half"></i>
                                    <span>Kelola Materi</span>
                                </a>
                            </li>
                        @else
                            <!-- Student Menu -->
                            <li>
                                <a href="{{ route('siswa.dashboard') }}" class="nav-link {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">
                                    <i class="bi bi-house-door"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('materi.index') }}" class="nav-link {{ request()->routeIs('materi.index') ? 'active' : '' }}">
                                    <i class="bi bi-book"></i>
                                    <span>Materi</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </nav>

                <!-- Logout Button -->
                <div class="logout-section">
                    <form method="POST" action="{{ route('logout') }}" class="logout-form">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
