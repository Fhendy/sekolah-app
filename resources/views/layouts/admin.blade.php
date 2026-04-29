<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel - SMK FH NUSANTARA')</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --sidebar-width: 280px;
            --sidebar-width-mobile: 260px;
            --header-height: 60px;
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: #3b82f6;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: var(--gray-100);
            overflow-x: hidden;
        }

        /* ============================================ */
        /* SIDEBAR STYLES */
        /* ============================================ */
        .admin-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: white;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            overflow-y: auto;
            overflow-x: hidden;
        }

        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(-100%);
                width: var(--sidebar-width-mobile);
            }
            .admin-sidebar.open {
                transform: translateX(0);
                box-shadow: 4px 0 20px rgba(0, 0, 0, 0.3);
            }
        }

        .admin-sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .admin-sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .admin-sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 4px;
        }

        .sidebar-brand {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .sidebar-brand a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-brand-logo {
            height: 55px;
            width: auto;
            max-width: 150px;
            object-fit: contain;
            transition: all 0.3s ease;
        }

        .sidebar-nav {
            padding: 0 1rem;
        }

        .nav-section {
            margin-bottom: 1.5rem;
        }

        .nav-section-title {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.4);
            padding: 0.5rem 1rem;
            margin-bottom: 0.5rem;
        }

        .nav-item {
            list-style: none;
        }

        .nav-dropdown {
            position: relative;
        }

        .nav-dropdown-toggle {
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
        }

        .nav-dropdown-toggle .dropdown-icon {
            transition: transform 0.2s ease;
        }

        .nav-dropdown.open .nav-dropdown-toggle .dropdown-icon {
            transform: rotate(90deg);
        }

        .nav-dropdown-menu {
            padding-left: 2rem;
            display: none;
        }

        .nav-dropdown.open .nav-dropdown-menu {
            display: block;
        }

        .nav-link-custom {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.7rem 1rem;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.2s ease;
            margin-bottom: 0.25rem;
            font-size: 0.85rem;
        }

        .nav-link-custom i {
            width: 22px;
            font-size: 1rem;
        }

        .nav-link-custom:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .nav-link-custom.active {
            background: var(--primary);
            color: white;
        }

        /* ============================================ */
        /* MAIN CONTENT */
        /* ============================================ */
        .admin-main {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        @media (max-width: 768px) {
            .admin-main {
                margin-left: 0;
            }
        }

        /* ============================================ */
        /* HEADER STYLES */
        /* ============================================ */
        .admin-header {
            position: sticky;
            top: 0;
            background: white;
            padding: 0 1.5rem;
            height: var(--header-height);
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            z-index: 99;
        }

        .menu-toggle {
            display: none;
            background: transparent;
            border: none;
            font-size: 1.3rem;
            color: var(--gray-700);
            cursor: pointer;
            padding: 8px;
            border-radius: 8px;
            transition: background 0.2s;
        }

        .menu-toggle:hover {
            background: var(--gray-100);
        }

        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }
            .admin-header {
                padding: 0 1rem;
            }
        }

        .header-title h4 {
            font-size: 1rem;
            font-weight: 600;
            margin: 0;
            color: var(--gray-800);
        }

        .header-title p {
            font-size: 0.7rem;
            color: var(--gray-500);
            margin: 0;
        }

        @media (max-width: 768px) {
            .header-title h4 {
                font-size: 0.9rem;
            }
            .header-title p {
                display: none;
            }
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            padding: 0.4rem 0.6rem;
            border-radius: 40px;
            transition: background 0.2s;
        }

        .user-dropdown:hover {
            background: var(--gray-100);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .user-info {
            text-align: right;
        }

        .user-name {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--gray-800);
        }

        .user-role {
            font-size: 0.65rem;
            color: var(--gray-500);
        }

        @media (max-width: 576px) {
            .user-info {
                display: none;
            }
        }

        .admin-content {
            padding: 1.5rem;
        }

        @media (max-width: 768px) {
            .admin-content {
                padding: 1rem;
            }
        }

        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
            transition: all 0.3s ease;
        }

        .sidebar-overlay.active {
            display: block;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 1.25rem;
            border: 1px solid var(--gray-200);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
        }

        .data-table {
            background: white;
            border-radius: 16px;
            border: 1px solid var(--gray-200);
            overflow-x: auto;
        }

        .data-table table {
            min-width: 600px;
        }

        .data-table th {
            background: var(--gray-50);
            padding: 0.9rem 1rem;
            font-weight: 600;
            font-size: 0.8rem;
            color: var(--gray-700);
        }

        .data-table td {
            padding: 0.9rem 1rem;
            font-size: 0.8rem;
            vertical-align: middle;
        }

        .btn-primary-custom {
            background: var(--primary);
            border: none;
            padding: 8px 18px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.8rem;
            transition: all 0.2s;
        }

        .btn-primary-custom:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .btn-outline-custom {
            background: transparent;
            border: 1px solid var(--gray-300);
            padding: 8px 18px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.8rem;
            transition: all 0.2s;
        }

        .btn-outline-custom:hover {
            background: var(--gray-100);
        }

        .form-control-custom {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid var(--gray-300);
            border-radius: 10px;
            font-size: 0.85rem;
            transition: all 0.2s;
        }

        .form-control-custom:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .alert-custom {
            border-radius: 12px;
            border: none;
            font-size: 0.8rem;
        }

        @media (max-width: 768px) {
            .data-table {
                border-radius: 12px;
            }
            .data-table th,
            .data-table td {
                padding: 0.7rem 0.8rem;
                font-size: 0.75rem;
            }
            .btn-primary-custom,
            .btn-outline-custom {
                padding: 6px 14px;
                font-size: 0.75rem;
            }
            .sidebar-brand-logo {
                height: 45px;
            }
        }

        @media (max-width: 480px) {
            .sidebar-brand-logo {
                height: 38px;
            }
            .sidebar-brand {
                padding: 1rem;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>

<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<div class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('images/logo-smk.png') }}" alt="Logo SMK FH NUSANTARA" class="sidebar-brand-logo"
                 onerror="this.src='https://placehold.co/50x50/2563eb/white?text=SMK'; this.onerror=null;">
        </a>
    </div>
    
    <div class="sidebar-nav">
        <div class="nav-section">
            <div class="nav-section-title">Main</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link-custom {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Content</div>
            <ul class="nav flex-column">
                <!-- Hero Slider -->
                <li class="nav-item">
                    <a class="nav-link-custom {{ request()->routeIs('admin.hero-slider.*') ? 'active' : '' }}" href="{{ route('admin.hero-slider.index') }}">
                        <i class="fas fa-images"></i>
                        <span>Hero Slider</span>
                    </a>
                </li>
                
                <!-- Jurusan -->
                <li class="nav-item">
                    <a class="nav-link-custom {{ request()->routeIs('admin.jurusan.*') ? 'active' : '' }}" href="{{ route('admin.jurusan.index') }}">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Jurusan</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link-custom {{ request()->routeIs('admin.pendaftaran.*') ? 'active' : '' }}" href="{{ route('admin.pendaftaran.index') }}">
                        <i class="fas fa-file-alt"></i>
                        <span>Pendaftaran PPDB</span>
                    </a>
                </li>
                
                <!-- Dropdown Kegiatan (Berita, Galeri, Agenda, Ekstrakurikuler) -->
                <li class="nav-item nav-dropdown" id="kegiatanDropdown">
                    <div class="nav-link-custom nav-dropdown-toggle" onclick="toggleDropdown('kegiatanDropdown')">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Kegiatan</span>
                        </div>
                        <i class="fas fa-chevron-right dropdown-icon"></i>
                    </div>
                    <div class="nav-dropdown-menu">
                        <a class="nav-link-custom {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}" href="{{ route('admin.berita.index') }}">
                            <i class="fas fa-newspaper"></i>
                            <span>Berita</span>
                        </a>
                        <a class="nav-link-custom {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}" href="{{ route('admin.galeri.index') }}">
                            <i class="fas fa-images"></i>
                            <span>Galeri</span>
                        </a>
                        <a class="nav-link-custom {{ request()->routeIs('admin.agenda.*') ? 'active' : '' }}" href="{{ route('admin.agenda.index') }}">
                            <i class="fas fa-calendar-check"></i>
                            <span>Agenda</span>
                        </a>
                        <a class="nav-link-custom {{ request()->routeIs('admin.eskul.*') ? 'active' : '' }}" href="{{ route('admin.eskul.index') }}">
                            <i class="fas fa-futbol"></i>
                            <span>Ekstrakurikuler</span>
                        </a>
                    </div>
                </li>
                
                <!-- Dropdown Profil (Guru & Prestasi) -->
                <li class="nav-item nav-dropdown" id="profilDropdown">
                    <div class="nav-link-custom nav-dropdown-toggle" onclick="toggleDropdown('profilDropdown')">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <i class="fas fa-id-card"></i>
                            <span>Profil</span>
                        </div>
                        <i class="fas fa-chevron-right dropdown-icon"></i>
                    </div>
                    <div class="nav-dropdown-menu">
                        <a class="nav-link-custom {{ request()->routeIs('admin.guru.*') ? 'active' : '' }}" href="{{ route('admin.guru.index') }}">
                            <i class="fas fa-chalkboard-user"></i>
                            <span>Guru & Karyawan</span>
                        </a>
                        <a class="nav-link-custom {{ request()->routeIs('admin.prestasi.*') ? 'active' : '' }}" href="{{ route('admin.prestasi.index') }}">
                            <i class="fas fa-trophy"></i>
                            <span>Prestasi</span>
                        </a>
                    </div>
                </li>
                
                <!-- Statistik -->
                <li class="nav-item">
                    <a class="nav-link-custom {{ request()->routeIs('admin.statistik.*') ? 'active' : '' }}" href="{{ route('admin.statistik.edit') }}">
                        <i class="fas fa-chart-line"></i>
                        <span>Statistik</span>
                    </a>
                </li>
            </ul>
        </div>

        @if(Auth::user()->role == 'superadmin')
        <div class="nav-section">
            <div class="nav-section-title">User Management</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link-custom {{ request()->routeIs('superadmin.users.*') ? 'active' : '' }}" href="{{ route('superadmin.users.index') }}">
                        <i class="fas fa-users"></i>
                        <span>Kelola User</span>
                    </a>
                </li>
            </ul>
        </div>
        @endif

        <div class="nav-section">
            <div class="nav-section-title">System</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link-custom" href="{{ route('home') }}" target="_blank">
                        <i class="fas fa-external-link-alt"></i>
                        <span>Lihat Website</span>
                    </a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" id="logout-form">
                        @csrf
                        <button type="submit" class="nav-link-custom" style="width: 100%; text-align: left; background: none; border: none; cursor: pointer;">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="admin-main">
    <div class="admin-header">
        <div class="d-flex align-items-center gap-2">
            <button class="menu-toggle" id="menuToggle" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <div class="header-title">
                <h4>@yield('header_title', 'Dashboard')</h4>
                <p>@yield('header_subtitle', 'Panel Administrasi SMK FH NUSANTARA')</p>
            </div>
        </div>
        <div class="header-actions">
            <div class="user-dropdown" data-bs-toggle="dropdown">
                <div class="user-info">
                    <div class="user-name">{{ Auth::user()->name }}</div>
                    <div class="user-role">{{ ucfirst(Auth::user()->role) }}</div>
                </div>
                <div class="user-avatar">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user-edit me-2"></i> Profil Saya</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <div class="admin-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show alert-custom mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show alert-custom mb-4" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true,
        disable: window.innerWidth < 768
    });

    function toggleSidebar() {
        const sidebar = document.getElementById('adminSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        
        sidebar.classList.toggle('open');
        overlay.classList.toggle('active');
        
        if (sidebar.classList.contains('open')) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = '';
        }
    }

    function closeSidebar() {
        const sidebar = document.getElementById('adminSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        
        sidebar.classList.remove('open');
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    function toggleDropdown(id) {
        const element = document.getElementById(id);
        if (element) {
            element.classList.toggle('open');
            
            const openDropdowns = JSON.parse(localStorage.getItem('adminOpenDropdowns') || '[]');
            if (element.classList.contains('open')) {
                if (!openDropdowns.includes(id)) {
                    openDropdowns.push(id);
                }
            } else {
                const index = openDropdowns.indexOf(id);
                if (index > -1) {
                    openDropdowns.splice(index, 1);
                }
            }
            localStorage.setItem('adminOpenDropdowns', JSON.stringify(openDropdowns));
        }
    }

    function restoreDropdownState() {
        const openDropdowns = JSON.parse(localStorage.getItem('adminOpenDropdowns') || '[]');
        openDropdowns.forEach(id => {
            const element = document.getElementById(id);
            if (element) {
                element.classList.add('open');
            }
        });
    }

    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) {
            closeSidebar();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeSidebar();
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        restoreDropdownState();
    });
</script>

@stack('scripts')
</body>
</html>