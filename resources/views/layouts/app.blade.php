<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/materi-admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/materi-siswa.css') }}">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
        }
        /* Refined SaaS elements */
        .card {
            border: 1px solid rgba(226, 232, 240, 0.8) !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.04), 0 2px 4px -2px rgba(0, 0, 0, 0.04) !important;
            border-radius: 16px !important;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-header {
            border-bottom: 1px solid rgba(226, 232, 240, 0.8) !important;
        }
        .sidebar {
            box-shadow: 4px 0 25px rgba(27, 68, 128, 0.1) !important;
        }
        .avatar {
            border: 3px solid rgba(255, 255, 255, 0.2) !important;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important;
            transition: all 0.3s ease;
        }
        .avatar:hover {
            transform: scale(1.05);
            border-color: rgba(255, 255, 255, 0.6) !important;
        }
        .nav-link {
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }
        .nav-link:hover {
            transform: translateX(4px);
        }
        @media (max-width: 768px) {
            .nav-link:hover {
                transform: none;
            }
        }
    </style>
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
