<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Gudang</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap Icons CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <style>
       html, body {
    height: 100%;
    margin: 0;
}

body {
    display: flex;
    flex-direction: column;
}

.navbar-brand-custom {
    font-size: 25px;
    font-weight: bold;
    font-family: Arial, sans-serif;
}

.sidebar {
    background-color: #343a40;
    color: #ffffff;
    height: 100vh;
    position: fixed;
    width: 250px; /* Default width */
    z-index: 1000;
    overflow-x: hidden;
    transition: width 0.3s;
    padding: 1rem;
    box-shadow: 4px 0 6px rgba(0, 0, 0, 0.1); /* Shadow on the right side */
}

.sidebar.collapsed {
    width: 80px; /* Width when collapsed */
}

.sidebar .nav-link {
    color: #ffffff;
    display: flex;
    align-items: center;
    padding: 10px 15px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    text-align: center;
    font-size: 16px; /* Adjust font size for readability */
}

.sidebar .nav-link.active {
    background-color: #495057;
}

.sidebar .nav-link:hover {
    background-color: #495057;
}

.sidebar .nav-item {
    margin-bottom: 1px;
}

.sidebar .nav-item i {
    margin-right: 10px;
    font-size: 18px;
}

.sidebar .nav-link span {
    display: inline-block;
    white-space: nowrap;
}

.sidebar.collapsed .nav-link span {
    display: none; /* Hide text when collapsed */
}

.sidebar.collapsed .nav-link i {
    font-size: 24px; /* Adjust icon size if needed */
}

.sidebar .toggle-btn {
    position: absolute;
    top: 20px; /* Increase top margin to ensure it's not too close to the top edge */
    right: 10px; /* Adjusted for better visibility while ensuring it’s within the sidebar */
    background-color: #343a40;
    color: #ffffff;
    border: none;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Increased shadow for better visibility */
    z-index: 1050; /* Ensure it’s above other content */
    transition: right 0.3s ease; /* Smooth transition for positioning */
}

.navbar-brand img {
    max-height: 30px;
}

.content-wrapper {
    margin-left: 250px;
    flex: 1; /* Allow content to expand and push footer down */
    transition: margin-left 0.3s;
}

.content-wrapper.collapsed {
    margin-left: 80px;
}

footer {
    background-color: #343a40;
    color: #ffffff;
    text-align: center;
    padding: 1rem;
    position: relative;
    bottom: 0;
    width: 100%;
}

.search-bar {
    width: 300px;
}

.profile-menu {
    margin-left: 20px;
}

.navbar-nav {
    align-items: center;
}

.dropdown-toggle::after {
    display: none;
}


.sidebar.collapsed .navbar-brand-custom {
    display: none;
}
    </style>
</head>
<body>
    <div class="d-flex flex-fill">
        <!-- Sidebar -->
        <nav id="sidebar" class="sidebar d-flex flex-column">
            <ul class="nav flex-column">
                <a class="navbar-brand navbar-brand-custom" href="#">Gudang</a>
                @php
                    $dashboardRoute = auth()->check() ? (auth()->user()->hasRole('admin') ? route('admin.dashboard') : route('dashboard')) : '#';
                @endphp

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') || request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ $dashboardRoute }}">
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
                        <i class="bi-box-seam"></i>
                        <span>Manajemen Gudang</span>
                    </a>
                </li>
                @auth
                    @if(auth()->user()->hasRole('admin'))
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                                <i class="bi bi-person"></i>
                                <span>Manajemen Pengguna</span>
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
        </nav>

        <!-- Content -->
        <div id="content" class="content-wrapper flex-grow-1">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <button class="toggle-btn" id="sidebarToggle">
                        <i class="bi bi-list"></i>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <div class="d-flex align-items-center">
                            <!-- Search Bar -->
                            <form class="d-flex me-3" method="GET" action="{{ route('search') }}">
                                <input class="form-control search-bar text-light" type="search" placeholder="Cari Produk atau Gudang" aria-label="Search" name="query" value="{{ request('query') }}">
                                <button class="btn btn-outline-light ms-2" type="submit">Cari</button>
                            </form>
                            <!-- User Dropdown -->
                            @auth
                            <li class="nav-item dropdown profile-menu">
                                <a class="nav-link dropdown-toggle d-flex align-items-center text-light" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    @if (isset($biodata) && $biodata->foto)
                                        <img src="{{ Storage::url($biodata->foto) }}" alt="Foto Profil" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover; border: 2px solid #ddd; margin-right: 10px; margin-bottom: 20px;">
                                    @else
                                        <img src="{{ asset('default-avatar.png') }}" alt="Foto Profil" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover; border: 2px solid #ddd; margin-right: 10px;">
                                    @endif
                                    <span style="margin-bottom: 20px;">{{ Auth::user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                                    <li><a class="dropdown-item" href="{{ route('biodata.index') }}">Profil</a></li>
                                    <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </ul>
                            </li>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline-light">Login</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <div class="container mt-4">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer mt-auto py-3 bg-dark text-white mb">
        <div class="container">
            <span class="text-muted">© 2024 Manajemen Gudang. All rights reserved.</span>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            var sidebar = document.getElementById('sidebar');
            var content = document.getElementById('content');
            sidebar.classList.toggle('collapsed');
            content.classList.toggle('collapsed');
        });
    </script>
</body>
</html>
