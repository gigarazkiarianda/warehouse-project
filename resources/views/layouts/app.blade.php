<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Gudang</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome (untuk ikon) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap Icons (untuk ikon sidebar) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <style>
        /* Custom CSS for sidebar */
        .sidebar {
            background-color: #343a40; /* Dark background color */
            color: #ffffff; /* White text color */
            transition: all 0.3s ease; /* Smooth transition for sidebar toggle */
            overflow-x: hidden; /* Prevent horizontal overflow */
            height: 100vh; /* Full height */
            position: fixed; /* Fixed position */
            width: 250px; /* Default width of expanded sidebar */
            z-index: 1000; /* Ensure sidebar is on top */
        }
        .sidebar.collapsed {
            width: 60px; /* Width of collapsed sidebar */
        }
        .sidebar .nav-link {
            color: #ffffff; /* White text color for links */
            display: flex;
            align-items: center;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            text-align: center; /* Center text when collapsed */
        }
        .sidebar .nav-link.active {
            background-color: #495057; /* Slightly lighter background for active link */
        }
        .sidebar .nav-link:hover {
            background-color: #495057; /* Hover effect */
        }
        .sidebar .nav-item {
            margin-bottom: 1px; /* Space between items */
        }
        .sidebar .nav-item i {
            margin-right: 10px; /* Spacing between icon and text */
            font-size: 18px; /* Icon size */
        }
        .sidebar .nav-link span {
            display: inline-block;
            transition: opacity 0.3s ease, margin-left 0.3s ease;
            white-space: nowrap; /* Prevent text wrapping */
        }
        .sidebar.collapsed .nav-link span {
            opacity: 0; /* Hide text in collapsed state */
            margin-left: -20px; /* Hide text outside view */
        }
        .sidebar.collapsed .nav-link {
            justify-content: center; /* Center the icon in collapsed state */
        }
        .sidebar .nav-link i {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .navbar-brand img {
            max-height: 30px; /* Adjust profile picture size */
        }
        .toggle-btn {
            cursor: pointer;
            color: #ffffff;
        }
        body {
            margin: 0;
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }
        .content-wrapper {
            margin-left: 250px; /* Space for sidebar */
            transition: margin-left 0.3s ease; /* Smooth transition for content shift */
        }
        .sidebar.collapsed ~ .content-wrapper {
            margin-left: 60px; /* Space for collapsed sidebar */
        }
        footer {
            margin-top: auto; /* Push footer to the bottom */
        }
    </style>
</head>
<body>
    <div class="d-flex flex-fill">
        <!-- Sidebar -->
        <nav class="sidebar d-flex flex-column p-3" id="sidebar">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="bi bi-house-door"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                        <i class="bi bi-box"></i>
                        <span>Produk</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('gudangs.*') ? 'active' : '' }}" href="{{ route('gudangs.index') }}">
                        <i class="bi bi-warehouse"></i>
                        <span>Manajemen Gudang</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                        <i class="bi bi-person"></i>
                        <span>Manajemen Pengguna</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('stocks.*') ? 'active' : '' }}" href="{{ route('stocks.index') }}">
                        <i class="bi bi-bar-chart"></i>
                        <span>Laporan Stok</span>
                    </a>
                </li>
                @auth
                    @if(auth()->user()->hasRole('admin'))
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }}" href="{{ route('admin.index') }}">
                                <i class="bi bi-shield-shaded"></i>
                                <span>Admin</span>
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
        </nav>

        <!-- Content -->
        <div class="content-wrapper flex-grow-1">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <button class="btn btn-dark toggle-btn ms-3" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="#">Gudang</a>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <ul class="navbar-nav">
                            @auth
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="https://via.placeholder.com/30" alt="Profile Picture" class="rounded-circle me-2">
                                        <span>{{ Auth::user()->name }}</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                                        <li><a class="dropdown-item" href="{{ route('biodata.index') }}">Profil</a></li>
                                        <li><a class="dropdown-item" href="#">Pengaturan</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="dropdown-item">Keluar</button>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="p-4">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        &copy; 2024 Sistem Manajemen Gudang
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <!-- Custom JS for sidebar toggle
