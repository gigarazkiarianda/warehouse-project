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
.navbar-brand-custom {
        font-size: 25px;
        font-weight: bold;
        font-family: Arial, sans-serif; /* Optional: specify a font if desired */
    }
        .sidebar {
            background-color: #343a40;
            color: #ffffff;
            height: 100vh;
            position: fixed;
            width: 250px;
            z-index: 1000;
            overflow-x: hidden;
            padding: 1rem;
        }
        .sidebar .nav-link {
            color: #ffffff;
            display: flex;
            align-items: center;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            text-align: center;
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
        .navbar-brand img {
            max-height: 30px;
        }
        body {
            margin: 0;
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }
        .content-wrapper {
            margin-left: 250px;
        }
        footer {
            margin-top: auto;
        }
    </style>
</head>
<body>
    <div class="d-flex flex-fill">
        <!-- Sidebar -->
        <nav class="sidebar d-flex flex-column">
            <ul class="nav flex-column">
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
                        <i class="bi bi-warehouse"></i>
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
                    <a class=" navbar-brand navbar-brand-custom" href="#">Gudang</a>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <ul class="navbar-nav">
                            @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    @if (isset($biodata) && $biodata->foto)
                                        <img src="{{ Storage::url($biodata->foto) }}" alt="Foto Profil" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover; border: 2px solid #ddd; margin-right: 10px;">
                                    @else
                                        <img src="{{ asset('default-avatar.png') }}" alt="Foto Profil" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover; border: 2px solid #ddd; margin-right: 10px;">
                                    @endif
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
