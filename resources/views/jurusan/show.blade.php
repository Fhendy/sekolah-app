@extends('layouts.app')

@section('title', $jurusan->nama . ' - SMK FH NUSANTARA')

@section('content')
<style>
    :root {
        --primary: #2563eb;
        --primary-dark: #1d4ed8;
        --primary-light: #3b82f6;
        --gray: #64748b;
        --light-bg: #f8fafc;
    }

    /* Hero Section Detail Jurusan */
    .hero-detail {
        position: relative;
        min-height: 60vh;
        display: flex;
        align-items: center;
        background: linear-gradient(135deg, #003f87 0%, #001f4d 100%);
        overflow: hidden;
        padding-top: 80px;
    }

    .hero-orb-1 {
        position: absolute;
        top: -100px;
        right: -100px;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
        z-index: 0;
    }

    .hero-orb-2 {
        position: absolute;
        bottom: -80px;
        left: -80px;
        width: 250px;
        height: 250px;
        background: rgba(255, 255, 255, 0.03);
        border-radius: 50%;
        z-index: 0;
    }

    .hero-detail .container {
        position: relative;
        z-index: 2;
    }

    /* Logo Jurusan di Hero - HANYA LOGO, TANPA CARD */
    .hero-logo {
        width: 120px;
        height: 120px;
        object-fit: contain;
        margin-bottom: 1rem;
    }

    .hero-detail .badge {
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.2);
        padding: 8px 20px;
        border-radius: 30px;
        font-size: 0.85rem;
        font-weight: 500;
        display: inline-block;
    }

    .hero-title {
        font-size: 3rem;
        font-weight: 800;
        line-height: 1.2;
        color: white;
    }

    .hero-subtitle {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.85);
        max-width: 600px;
    }

    /* Breadcrumb */
    .breadcrumb-custom {
        background: transparent;
        padding: 1rem 0;
    }

    .breadcrumb-custom .breadcrumb-item a {
        color: var(--primary);
        text-decoration: none;
    }

    /* Section Title */
    .section-title-left {
        margin-bottom: 1.5rem;
    }

    .section-title-left .subtitle {
        display: inline-block;
        background: rgba(37, 99, 235, 0.1);
        color: var(--primary);
        padding: 4px 16px;
        border-radius: 30px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
    }

    .section-title-left h2 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: #0f172a;
    }

    .section-title-left .divider {
        width: 50px;
        height: 3px;
        background: var(--primary);
        margin: 0.75rem 0;
        border-radius: 2px;
    }

    /* Tombol */
    .btn-primary-custom {
        display: inline-block;
        background: white;
        border: 1px solid white;
        color: #003f87;
        padding: 10px 28px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-primary-custom:hover {
        background: rgba(255, 255, 255, 0.9);
        color: #003f87;
        transform: translateY(-2px);
    }

    .btn-outline-custom {
        display: inline-block;
        background: transparent;
        border: 1px solid white;
        color: white;
        padding: 10px 28px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-outline-custom:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        transform: translateY(-2px);
    }

    /* Kompetensi List */
    .kompetensi-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.75rem;
    }

    .kompetensi-list li {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #334155;
        font-size: 0.9rem;
        padding: 8px 0;
        border-bottom: 1px dashed #e2e8f0;
    }

    .kompetensi-list li:last-child {
        border-bottom: none;
    }

    .kompetensi-list li i {
        color: var(--primary);
        font-size: 1rem;
        width: 20px;
    }

    /* Prospek Karir Card */
    .karir-card {
        background: #f8fafc;
        border-radius: 12px;
        padding: 1.25rem;
        text-align: center;
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
        height: 100%;
    }

    .karir-card:hover {
        transform: translateY(-3px);
        border-color: #cbd5e1;
    }

    .karir-card i {
        font-size: 2rem;
        color: var(--primary);
        margin-bottom: 0.75rem;
    }

    .karir-card h4 {
        font-size: 1rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 0.25rem;
    }

    .karir-card p {
        font-size: 0.8rem;
        color: var(--gray);
        margin: 0;
    }

    /* Program Lainnya Card - SEPERTI DI HOME (dengan logo besar) */
    .jurusan-lain-card {
        display: block;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
        text-decoration: none;
        color: inherit;
        height: 100%;
    }

    .jurusan-lain-card:hover {
        transform: translateY(-5px);
        border-color: #cbd5e1;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
    }

    /* Logo wrapper - seperti di home */
    .jurusan-lain-logo-wrapper {
        background: linear-gradient(135deg, #003f87 0%, #001f4d 100%);
        padding: 1.5rem;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 160px;
    }

    .jurusan-lain-logo-img {
        width: auto;
        height: 100px;
        max-width: 90%;
        object-fit: contain;
    }

    /* Fallback icon jika tidak ada logo */
    .jurusan-lain-header {
        background: linear-gradient(135deg, #003f87 0%, #001f4d 100%);
        padding: 1.5rem;
        text-align: center;
        min-height: 160px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .jurusan-lain-header i {
        font-size: 3rem;
        color: white;
    }

    .jurusan-lain-body {
        padding: 1rem;
        text-align: center;
    }

    .jurusan-lain-body h5 {
        font-size: 0.9rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
        color: #0f172a;
    }

    .jurusan-lain-body p {
        font-size: 0.7rem;
        color: var(--gray);
        margin-top: 0.25rem;
        margin-bottom: 0;
    }

    /* Responsive untuk Program Lainnya */
    @media (max-width: 768px) {
        .jurusan-lain-logo-wrapper {
            min-height: 130px;
            padding: 1rem;
        }
        .jurusan-lain-logo-img {
            height: 70px;
        }
        .jurusan-lain-header {
            min-height: 130px;
        }
        .jurusan-lain-header i {
            font-size: 2.2rem;
        }
    }

    @media (max-width: 480px) {
        .jurusan-lain-logo-wrapper {
            min-height: 110px;
        }
        .jurusan-lain-logo-img {
            height: 55px;
        }
        .jurusan-lain-header {
            min-height: 110px;
        }
        .jurusan-lain-header i {
            font-size: 1.8rem;
        }
    }

    /* CTA Section */
    .cta-jurusan {
        background: linear-gradient(135deg, #003f87 0%, #001f4d 100%);
        padding: 3rem 0;
        text-align: center;
    }

    .cta-jurusan h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        margin-bottom: 0.5rem;
    }

    .cta-jurusan p {
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 1.5rem;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }

    .btn-white {
        display: inline-block;
        background: white;
        border: none;
        color: #003f87;
        padding: 10px 28px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .btn-white:hover {
        background: rgba(255, 255, 255, 0.9);
        transform: translateY(-2px);
    }

    .btn-outline-white {
        display: inline-block;
        background: transparent;
        border: 1px solid white;
        color: white;
        padding: 10px 28px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .btn-outline-white:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        transform: translateY(-2px);
    }

    .deskripsi-text {
        font-size: 1rem;
        line-height: 1.7;
        color: #334155;
    }

    @media (max-width: 768px) {
        .hero-detail {
            min-height: 50vh;
            padding-top: 70px;
        }
        .hero-title {
            font-size: 2rem;
        }
        .hero-subtitle {
            font-size: 1rem;
        }
        .kompetensi-list {
            grid-template-columns: 1fr;
        }
        .cta-jurusan h3 {
            font-size: 1.25rem;
        }
        .hero-logo {
            width: 80px;
            height: 80px;
        }
    }
</style>

<!-- Hero Section Detail Jurusan dengan Logo (TANPA CARD) -->
<section class="hero-detail">
    <div class="hero-orb-1"></div>
    <div class="hero-orb-2"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-7" data-aos="fade-up" data-aos-duration="1000">
                @if($jurusan->logo && file_exists(public_path('storage/' . $jurusan->logo)))
                    <img src="{{ asset('storage/' . $jurusan->logo) }}" alt="{{ $jurusan->nama }}" class="hero-logo">
                @endif
                <div class="badge text-white mb-4 d-inline-block">
                    <i class="fas fa-graduation-cap me-2"></i>{{ $jurusan->kode }}
                </div>
                <h1 class="hero-title mb-4">
                    {{ $jurusan->nama }}
                </h1>
                <p class="hero-subtitle mb-4">
                    {{ Str::limit($jurusan->deskripsi, 120) }}
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('daftar') }}" class="btn-primary-custom">
                        <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                    </a>
                    @if($jurusan->brosur && file_exists(public_path('storage/' . $jurusan->brosur)))
                        <a href="{{ asset('storage/' . $jurusan->brosur) }}" class="btn-outline-custom" download>
                            <i class="fas fa-download me-2"></i>Unduh Brosur
                        </a>
                    @else
                        <a href="#" class="btn-outline-custom" onclick="alert('Brosur belum tersedia'); return false;">
                            <i class="fas fa-download me-2"></i>Unduh Brosur
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Konten lainnya -->
<div class="container py-5">
    <nav aria-label="breadcrumb" class="breadcrumb-custom" data-aos="fade-up">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('jurusan.index') }}">Program Keahlian</a></li>
            <li class="breadcrumb-item active">{{ $jurusan->nama }}</li>
        </ol>
    </nav>

    <!-- Tentang Program -->
    <div class="row mb-5">
        <div class="col-lg-12" data-aos="fade-up">
            <div class="section-title-left">
                <span class="subtitle">Tentang Program</span>
                <h2>{{ $jurusan->nama }}</h2>
                <div class="divider"></div>
            </div>
            <p class="deskripsi-text">
                {{ $jurusan->deskripsi }}
            </p>
            <p class="deskripsi-text mt-3">
                Program ini dirancang untuk menghasilkan lulusan yang kompeten, profesional, dan siap bersaing di dunia industri maupun berwirausaha.
            </p>
        </div>
    </div>

    <!-- Yang Akan Dipelajari -->
    <div class="row mb-5">
        <div class="col-lg-12" data-aos="fade-up">
            <div class="section-title-left">
                <span class="subtitle">Kurikulum</span>
                <h2>Yang Akan Dipelajari</h2>
                <div class="divider"></div>
            </div>
            <ul class="kompetensi-list">
                @php
                    $kompetensi = [
                        'RPL' => [
                            'Pemrograman Dasar (HTML, CSS, JavaScript)',
                            'Pemrograman Berorientasi Objek (PHP, Java)',
                            'Database Management (MySQL, PostgreSQL)',
                            'Framework Laravel & CodeIgniter',
                            'UI/UX Design dan Prototyping',
                            'Mobile Programming (Flutter, React Native)',
                            'Project Management & Git Version Control',
                            'Pengujian dan Debugging Aplikasi'
                        ],
                        'TKJ' => [
                            'Administrasi Server dan Jaringan',
                            'Keamanan Jaringan Komputer',
                            'Instalasi dan Konfigurasi Jaringan',
                            'Cloud Computing & Virtualisasi',
                            'Routing dan Switching',
                            'Troubleshooting Jaringan',
                            'Sistem Operasi Jaringan (Linux, Windows Server)',
                            'Manajemen Infrastruktur TI'
                        ],
                        'MM' => [
                            'Desain Grafis (Photoshop, Illustrator)',
                            'Videografi dan Editing (Premiere, After Effects)',
                            'Animasi 2D dan 3D',
                            'Fotografi Produk',
                            'Motion Graphics',
                            'UI/UX Design',
                            'Digital Marketing & Sosial Media',
                            'Content Creation'
                        ],
                        'AKL' => [
                            'Akuntansi Dasar dan Lanjutan',
                            'Aplikasi Akuntansi (MYOB, Accurate)',
                            'Perpajakan',
                            'Manajemen Keuangan',
                            'Audit Internal',
                            'Administrasi Perkantoran',
                            'Pengolahan Data Keuangan',
                            'Etika Profesi Akuntan'
                        ]
                    ];
                    $defaultKompetensi = [
                        'Dasar-dasar Keahlian Program',
                        'Kompetensi Keahlian Inti',
                        'Praktik Kerja Lapangan (PKL)',
                        'Proyek Kreatif dan Inovatif',
                        'Pengembangan Soft Skill',
                        'Kewirausahaan',
                        'Sertifikasi Kompetensi',
                        'Bahasa Inggris Teknis'
                    ];
                    $selectedKompetensi = $kompetensi[$jurusan->kode] ?? $kompetensi[$jurusan->nama] ?? $defaultKompetensi;
                @endphp
                @foreach($selectedKompetensi as $item)
                <li><i class="fas fa-check-circle"></i> {{ $item }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Setelah Lulus -->
    <div class="row mb-5">
        <div class="col-lg-12" data-aos="fade-up">
            <div class="section-title-left">
                <span class="subtitle">Prospek Karir</span>
                <h2>Setelah Lulus</h2>
                <div class="divider"></div>
            </div>
            <div class="row g-3">
                @php
                    $karir = [
                        'RPL' => [
                            ['icon' => 'fa-code', 'title' => 'Software Engineer', 'desc' => 'Mengembangkan aplikasi web, desktop, dan mobile'],
                            ['icon' => 'fa-mobile-alt', 'title' => 'Mobile Developer', 'desc' => 'Membuat aplikasi Android & iOS'],
                            ['icon' => 'fa-database', 'title' => 'Database Administrator', 'desc' => 'Mengelola dan merawat database perusahaan'],
                            ['icon' => 'fa-laptop-code', 'title' => 'Frontend Developer', 'desc' => 'Membangun tampilan website interaktif'],
                            ['icon' => 'fa-server', 'title' => 'Backend Developer', 'desc' => 'Mengembangkan logika dan server aplikasi'],
                            ['icon' => 'fa-chalkboard-user', 'title' => 'IT Trainer', 'desc' => 'Mengajar dan melatih di bidang IT']
                        ],
                        'TKJ' => [
                            ['icon' => 'fa-network-wired', 'title' => 'Network Engineer', 'desc' => 'Merancang dan mengelola jaringan komputer'],
                            ['icon' => 'fa-shield-alt', 'title' => 'Network Security', 'desc' => 'Menjaga keamanan jaringan perusahaan'],
                            ['icon' => 'fa-cloud', 'title' => 'Cloud Engineer', 'desc' => 'Mengelola infrastruktur cloud'],
                            ['icon' => 'fa-server', 'title' => 'System Administrator', 'desc' => 'Mengelola server dan sistem operasi'],
                            ['icon' => 'fa-headset', 'title' => 'IT Support', 'desc' => 'Memberikan dukungan teknis IT'],
                            ['icon' => 'fa-chalkboard-user', 'title' => 'Network Trainer', 'desc' => 'Melatih di bidang jaringan']
                        ],
                        'MM' => [
                            ['icon' => 'fa-paintbrush', 'title' => 'Graphic Designer', 'desc' => 'Mendesain grafis untuk berbagai media'],
                            ['icon' => 'fa-video', 'title' => 'Video Editor', 'desc' => 'Mengedit video profesional'],
                            ['icon' => 'fa-film', 'title' => 'Animator', 'desc' => 'Membuat animasi 2D & 3D'],
                            ['icon' => 'fa-camera', 'title' => 'Photographer', 'desc' => 'Fotografi produk dan komersial'],
                            ['icon' => 'fa-chart-line', 'title' => 'Digital Marketer', 'desc' => 'Mengelola pemasaran digital'],
                            ['icon' => 'fa-chalkboard-user', 'title' => 'Multimedia Trainer', 'desc' => 'Melatih di bidang multimedia']
                        ],
                        'AKL' => [
                            ['icon' => 'fa-calculator', 'title' => 'Akuntan', 'desc' => 'Mengelola pembukuan dan laporan keuangan'],
                            ['icon' => 'fa-chart-line', 'title' => 'Analis Keuangan', 'desc' => 'Menganalisis kondisi keuangan perusahaan'],
                            ['icon' => 'fa-file-invoice-dollar', 'title' => 'Tax Consultant', 'desc' => 'Konsultan perpajakan'],
                            ['icon' => 'fa-building', 'title' => 'Administrasi Kantor', 'desc' => 'Mengelola administrasi perkantoran'],
                            ['icon' => 'fa-chalkboard-user', 'title' => 'Accounting Trainer', 'desc' => 'Melatih di bidang akuntansi']
                        ]
                    ];
                    $defaultKarir = [
                        ['icon' => 'fa-briefcase', 'title' => 'Tenaga Profesional', 'desc' => 'Bekerja di industri terkait'],
                        ['icon' => 'fa-chart-line', 'title' => 'Wirausaha Mandiri', 'desc' => 'Membuka usaha sendiri'],
                        ['icon' => 'fa-graduation-cap', 'title' => 'Melanjutkan Studi', 'desc' => 'Kuliah di perguruan tinggi'],
                        ['icon' => 'fa-certificate', 'title' => 'Sertifikasi Profesi', 'desc' => 'Mendapatkan sertifikasi kompetensi'],
                        ['icon' => 'fa-chalkboard-user', 'title' => 'Tenaga Pengajar', 'desc' => 'Mengajar di bidang keahlian'],
                        ['icon' => 'fa-users', 'title' => 'Konsultan', 'desc' => 'Menjadi konsultan di bidangnya']
                    ];
                    $selectedKarir = $karir[$jurusan->kode] ?? $karir[$jurusan->nama] ?? $defaultKarir;
                @endphp
                @foreach($selectedKarir as $item)
                <div class="col-md-4 col-sm-6">
                    <div class="karir-card">
                        <i class="fas {{ $item['icon'] }}"></i>
                        <h4>{{ $item['title'] }}</h4>
                        <p>{{ $item['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Program Keahlian Lainnya - SEPERTI DI HOME -->
    <div class="row mb-5">
        <div class="col-lg-12" data-aos="fade-up">
            <div class="section-title-left">
                <span class="subtitle">Eksplorasi</span>
                <h2>Program Keahlian Lainnya</h2>
                <div class="divider"></div>
                <p class="text-muted">Temukan program keahlian lain yang sesuai dengan minat Anda</p>
            </div>
            <div class="row g-4">
                @php
                    $otherJurusan = App\Models\Jurusan::where('id', '!=', $jurusan->id)->limit(4)->get();
                @endphp
                @forelse($otherJurusan as $item)
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <a href="{{ route('jurusan.show', $item) }}" class="jurusan-lain-card">
                        @if($item->logo && file_exists(public_path('storage/' . $item->logo)))
                            <div class="jurusan-lain-logo-wrapper">
                                <img src="{{ asset('storage/' . $item->logo) }}" alt="{{ $item->nama }}" class="jurusan-lain-logo-img">
                            </div>
                        @else
                            <div class="jurusan-lain-header">
                                <i class="fas {{ $item->ikon ?? 'fa-laptop-code' }}"></i>
                            </div>
                        @endif
                        <div class="jurusan-lain-body">
                            <h5>{{ $item->nama }}</h5>
                            <p>{{ $item->kode }}</p>
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-12">
                    <p class="text-muted text-center">Belum ada program keahlian lainnya</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<section class="cta-jurusan">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center" data-aos="fade-up">
                <h3>Siap Bergabung di {{ $jurusan->nama }}?</h3>
                <p>Tentukan karir masa depanmu bersama kami dan jadilah generasi unggul yang siap kerja.</p>
                <div class="d-flex flex-wrap gap-3 justify-content-center">
                    <a href="{{ route('daftar') }}" class="btn-white">
                        <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                    </a>
                    <a href="{{ route('kontak') }}" class="btn-outline-white">
                        <i class="fas fa-headset me-2"></i>Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection