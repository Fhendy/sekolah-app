<nav class="navbar navbar-expand-lg fixed-top" id="mainNavbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('images/logo-white.png') }}" alt="SMK FH NUSANTARA" class="navbar-logo"
                 onerror="this.src='{{ asset('images/logo-smk.png') }}'; this.onerror=null;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Beranda -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        Beranda
                    </a>
                </li>

                <!-- Profil (Dropdown) -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('profil.*') ? 'active' : '' }}" href="#" role="button">
                        Profil
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('profil.identitas') }}">Identitas Sekolah</a></li>
                        <li><a class="dropdown-item" href="{{ route('profil.visi-misi') }}">Visi dan Misi</a></li>
                        <li><a class="dropdown-item" href="{{ route('profil.sejarah') }}">Sejarah Sekolah</a></li>
                        <li><a class="dropdown-item" href="{{ route('profil.struktur') }}">Struktur Organisasi Sekolah</a></li>
                        <li><a class="dropdown-item" href="{{ route('profil.guru') }}">Guru & Karyawan</a></li>
                        <li><a class="dropdown-item" href="{{ route('profil.fasilitas') }}">Fasilitas</a></li>
                        <li><a class="dropdown-item" href="{{ route('profil.prestasi') }}">Prestasi</a></li>
                        <li><a class="dropdown-item" href="{{ route('profil.mars') }}">Mars Sekolah</a></li>
                        <li><a class="dropdown-item" href="{{ route('profil.eskul') }}">Ekstrakurikuler</a></li>
                    </ul>
                </li>

                <!-- Program Keahlian (Dropdown) -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('jurusan.*') ? 'active' : '' }}" href="#" role="button">
                        Program Keahlian
                    </a>
                    <ul class="dropdown-menu">
                        @php
                            use App\Models\Jurusan;
                            $allJurusan = Jurusan::all();
                        @endphp
                        @forelse($allJurusan as $jurusan)
                            <li><a class="dropdown-item" href="{{ route('jurusan.show', $jurusan) }}">{{ $jurusan->nama }}</a></li>
                        @empty
                            <li><a class="dropdown-item disabled" href="#">Belum ada jurusan</a></li>
                        @endforelse
                    </ul>
                </li>

                <!-- Kegiatan (Dropdown) -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('berita.*') || request()->routeIs('galeri.*') || request()->routeIs('agenda.*') || request()->routeIs('eskul.*') ? 'active' : '' }}" href="#" role="button">
                        Kegiatan
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('berita.index') }}">Berita</a></li>
                        <li><a class="dropdown-item" href="{{ route('galeri.index') }}">Galeri</a></li>
                        <li><a class="dropdown-item" href="{{ route('agenda.index') }}">Agenda</a></li>
                        <li><a class="dropdown-item" href="{{ route('eskul.index') }}">Ekstrakurikuler</a></li>
                    </ul>
                </li>

                <!-- Kontak -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('kontak') ? 'active' : '' }}" href="{{ route('kontak') }}">
                        Kontak
                    </a>
                </li>
                
                <!-- Authentication -->
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            @if(Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                        <i class="fas fa-tachometer-alt me-2"></i> Dashboard Admin
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                            @endif
                            @if(Auth::user()->role == 'superadmin')
                                <li>
                                    <a class="dropdown-item" href="{{ route('superadmin.users.index') }}">
                                        <i class="fas fa-users-cog me-2"></i> Kelola User
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                            @endif
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-user-edit me-2"></i> Profil Saya
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="btn-login" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-1"></i> Login
                        </a>
                    </li>
                @endauth
                
                <li class="nav-item ms-2">
                    <a class="btn-daftar-nav" href="{{ route('daftar') }}">
                        <i class="fas fa-user-plus me-1"></i> Daftar Sekarang
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    :root {
        --primary: #2563eb;
        --primary-dark: #1d4ed8;
        --primary-light: #3b82f6;
    }

    .navbar {
        transition: all 0.3s ease-in-out;
        padding: 1.2rem 0;
        /* EFEK BLUR / GLASSMORPHISM SEBELUM SCROLL */
        background: rgba(0, 63, 135, 0.7) !important;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    /* Setelah scroll - menjadi putih solid */
    .navbar.scrolled {
        background: white !important;
        backdrop-filter: none;
        -webkit-backdrop-filter: none;
        padding: 0.8rem 0;
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
        border-bottom: none;
    }
    
    .navbar-logo {
        height: 45px;
        width: auto;
        transition: all 0.3s ease;
        filter: brightness(0) invert(1); /* Membuat logo putih */
    }
    
    /* Setelah scroll, logo kembali normal (warna asli) */
    .navbar.scrolled .navbar-logo {
        height: 40px;
        filter: none;
    }
    
    .navbar-brand {
        padding: 0;
        margin: 0;
    }
    
    /* Navbar Links - Desktop */
    .nav-link {
        font-weight: 500;
        font-size: 0.95rem;
        color: white !important;
        margin: 0 0.25rem;
        padding: 0.5rem 1rem;
        transition: all 0.2s ease;
        position: relative;
        background: transparent !important;
    }
    
    .navbar.scrolled .nav-link {
        color: #1e293b !important;
        background: transparent !important;
    }
    
    .nav-link:hover {
        color: rgba(255, 255, 255, 0.9) !important;
        background: transparent !important;
    }
    
    .navbar.scrolled .nav-link:hover {
        color: var(--primary) !important;
        background: transparent !important;
    }
    
    .nav-link.active {
        font-weight: 600;
        color: white !important;
        background: transparent !important;
    }
    
    .navbar.scrolled .nav-link.active {
        color: var(--primary) !important;
        background: transparent !important;
    }
    
    .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 30px;
        height: 2px;
        background: white;
        border-radius: 2px;
    }
    
    .navbar.scrolled .nav-link.active::after {
        background: var(--primary);
    }
    
    /* Dropdown Toggle */
    .dropdown-toggle {
        background: transparent !important;
    }
    
    .dropdown-toggle:hover,
    .dropdown-toggle:focus,
    .dropdown-toggle:active,
    .dropdown-toggle:focus-visible {
        background: transparent !important;
        outline: none !important;
        box-shadow: none !important;
    }
    
    /* Dropdown menu */
    .dropdown-menu {
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08);
        padding: 0.5rem 0;
        margin-top: 0.5rem;
        min-width: 220px;
        background: white;
    }
    
    .dropdown-item {
        padding: 0.6rem 1.5rem;
        font-size: 0.9rem;
        font-weight: 500;
        color: #1e293b !important;
        transition: all 0.2s;
    }
    
    .dropdown-item:hover {
        background: #f8fafc;
        color: var(--primary) !important;
    }
    
    .dropdown-divider {
        margin: 0.3rem 0;
    }
    
    /* Tombol Login */
    .btn-login {
        background: transparent;
        border: 1px solid white;
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-block;
    }
    
    .btn-login:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
    }
    
    .navbar.scrolled .btn-login {
        border: 1px solid #cbd5e1;
        color: #1e293b;
    }
    
    .navbar.scrolled .btn-login:hover {
        background: #f1f5f9;
        border-color: #94a3b8;
        color: #1e293b;
    }
    
    /* Tombol Daftar */
    .btn-daftar-nav {
        background: white;
        border: none;
        color: #003f87;
        padding: 0.5rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-block;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    
    .btn-daftar-nav:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        color: #003f87;
    }
    
    .navbar.scrolled .btn-daftar-nav {
        background: var(--primary);
        color: white;
        box-shadow: none;
    }
    
    .navbar.scrolled .btn-daftar-nav:hover {
        background: var(--primary-dark);
        color: white;
        transform: translateY(-2px);
    }
    
    /* Navbar Toggler (Mobile) */
    .navbar-toggler {
        border: none;
        background: rgba(255, 255, 255, 0.2);
        padding: 0.5rem 0.75rem;
    }
    
    .navbar.scrolled .navbar-toggler {
        background: #f1f5f9;
    }
    
    .navbar-toggler:focus {
        box-shadow: none;
        outline: none;
    }
    
    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='white' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }
    
    .navbar.scrolled .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='%231e293b' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }
    
    /* ============================================ */
    /* RESPONSIVE MOBILE */
    /* ============================================ */
    @media (max-width: 991px) {
        .navbar-collapse {
            background: white;
            padding: 1rem;
            border-radius: 12px;
            margin-top: 1rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        .navbar.scrolled .navbar-collapse {
            background: white;
        }
        
        /* Link di mobile - warna gelap */
        .nav-link {
            color: #1e293b !important;
            padding: 0.6rem 1rem;
        }
        
        .nav-link:hover {
            color: var(--primary) !important;
        }
        
        .nav-link.active {
            color: var(--primary) !important;
            background: #eff6ff !important;
            border-radius: 8px;
        }
        
        .nav-link.active::after {
            display: none;
        }
        
        /* Dropdown Toggle di mobile */
        .dropdown-toggle {
            color: #1e293b !important;
            background: transparent !important;
        }
        
        .dropdown-toggle:hover,
        .dropdown-toggle:focus,
        .dropdown-toggle:active {
            color: var(--primary) !important;
            background: transparent !important;
        }
        
        /* Dropdown menu di mobile */
        .dropdown-menu {
            border: none;
            box-shadow: none;
            padding-left: 1rem;
            position: static !important;
            transform: none !important;
            width: 100%;
            margin-top: 0;
            background: transparent;
        }
        
        /* Dropdown item di mobile */
        .dropdown-item {
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
            color: #1e293b !important;
            background: transparent !important;
        }
        
        .dropdown-item:hover {
            color: var(--primary) !important;
            background: #f8fafc !important;
        }
        
        .dropdown-toggle::after {
            float: right;
            margin-top: 8px;
        }
        
        .btn-login {
            border-color: #cbd5e1;
            color: #1e293b;
            display: inline-block;
            width: 100%;
            text-align: center;
            margin-bottom: 0.5rem;
        }
        
        .btn-daftar-nav {
            width: 100%;
            text-align: center;
            background: var(--primary);
            color: white;
        }
        
        .btn-daftar-nav:hover {
            background: var(--primary-dark);
            color: white;
        }
        
        /* Mobile - navbar tetap blur sebelum scroll */
        .navbar {
            background: rgba(0, 63, 135, 0.8) !important;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        
        .navbar.scrolled {
            background: white !important;
            backdrop-filter: none;
            -webkit-backdrop-filter: none;
        }
        
        .navbar-logo {
            filter: brightness(0) invert(1);
        }
        
        .navbar.scrolled .navbar-logo {
            filter: none;
        }
    }
    
    @media (max-width: 768px) {
        .navbar-logo {
            height: 38px;
        }
        .navbar {
            padding: 0.8rem 0;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.getElementById('mainNavbar');
        
        function handleScroll() {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }
        
        handleScroll();
        window.addEventListener('scroll', handleScroll);
        
        // Fungsi untuk menangani dropdown dengan click
        const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
        
        dropdownToggles.forEach(toggle => {
            toggle.removeAttribute('data-bs-toggle');
            
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const parent = this.parentElement;
                const dropdownMenu = parent.querySelector('.dropdown-menu');
                
                if (!dropdownMenu) return;
                
                document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                    if (menu !== dropdownMenu) {
                        menu.classList.remove('show');
                        menu.style.display = '';
                    }
                });
                
                document.querySelectorAll('.dropdown.show').forEach(drop => {
                    if (drop !== parent) {
                        drop.classList.remove('show');
                    }
                });
                
                if (dropdownMenu.classList.contains('show')) {
                    dropdownMenu.classList.remove('show');
                    dropdownMenu.style.display = '';
                    parent.classList.remove('show');
                } else {
                    dropdownMenu.classList.add('show');
                    dropdownMenu.style.display = 'block';
                    parent.classList.add('show');
                }
            });
        });
        
        document.addEventListener('click', function(event) {
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(dropdown => {
                if (!dropdown.contains(event.target)) {
                    const menu = dropdown.querySelector('.dropdown-menu');
                    if (menu) {
                        menu.classList.remove('show');
                        menu.style.display = '';
                    }
                    dropdown.classList.remove('show');
                }
            });
        });
        
        const navLinks = document.querySelectorAll('.nav-link:not(.dropdown-toggle)');
        const navbarCollapse = document.querySelector('.navbar-collapse');
        
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 991) {
                    if (navbarCollapse.classList.contains('show')) {
                        navbarCollapse.classList.remove('show');
                    }
                }
            });
        });
    });
</script>