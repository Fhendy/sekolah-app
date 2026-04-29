@extends('layouts.app')

@section('title', 'Hubungi Kami - SMK FH NUSANTARA')

@section('content')
<style>
    :root {
        --primary: #2563eb;
        --primary-dark: #1d4ed8;
        --primary-light: #3b82f6;
        --gray: #64748b;
        --light-bg: #f8fafc;
        --navbar-height: 80px;
    }

    /* Hero Section Kontak - Center */
    .hero-kontak {
        position: relative;
        min-height: 60vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        background: linear-gradient(135deg, #003f87 0%, #001f4d 100%);
        overflow: hidden;
    }

    .hero-orb-1 {
        position: absolute;
        top: -100px;
        right: -100px;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
        z-index: 0;
    }

    .hero-orb-2 {
        position: absolute;
        bottom: -100px;
        left: -100px;
        width: 350px;
        height: 350px;
        background: rgba(255, 255, 255, 0.03);
        border-radius: 50%;
        z-index: 0;
    }

    .hero-kontak .container {
        position: relative;
        z-index: 2;
    }

    .hero-title {
        font-size: 4rem;
        font-weight: 800;
        line-height: 1.2;
        color: white;
        margin-bottom: 1rem;
        letter-spacing: 2px;
    }

    .hero-subtitle {
        font-size: 1.25rem;
        color: rgba(255, 255, 255, 0.85);
        letter-spacing: 1px;
    }

    /* Breadcrumb */
    .breadcrumb-custom {
        background: transparent;
        padding: 1rem 0;
        margin-bottom: 1rem;
    }

    .breadcrumb-custom .breadcrumb-item a {
        color: var(--primary);
        text-decoration: none;
    }

    .breadcrumb-custom .breadcrumb-item.active {
        color: var(--gray);
    }

    /* Info Card */
    .info-card {
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 1.5rem;
        background: white;
        transition: all 0.3s ease;
        height: 100%;
    }

    .info-card:hover {
        transform: translateY(-3px);
        border-color: #cbd5e1;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
    }

    .info-icon {
        width: 50px;
        height: 50px;
        background: rgba(37, 99, 235, 0.1);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }

    .info-icon i {
        font-size: 1.5rem;
        color: var(--primary);
    }

    .info-card h4 {
        font-size: 1rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 0.75rem;
    }

    .info-card p, .info-card a {
        font-size: 0.85rem;
        color: #64748b;
        text-decoration: none;
        margin-bottom: 0.25rem;
        display: block;
        line-height: 1.5;
    }

    .info-card a:hover {
        color: var(--primary);
    }

    /* Maps Container */
    .maps-container {
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        overflow: hidden;
        height: 350px;
    }

    .maps-container iframe {
        width: 100%;
        height: 100%;
        border: 0;
    }

    /* Form Style */
    .form-card {
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 1.5rem;
        background: white;
    }

    .form-control-custom {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        outline: none;
    }

    .form-control-custom:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .form-label {
        font-weight: 600;
        font-size: 0.85rem;
        color: #0f172a;
        margin-bottom: 0.5rem;
    }

    .btn-submit {
        background: var(--primary);
        color: white;
        border: none;
        padding: 12px 28px;
        border-radius: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-submit:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
    }

    /* Navigasi Cepat */
    .nav-card {
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 1.5rem;
        background: white;
    }

    .nav-card h4 {
        font-size: 1rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--primary);
        display: inline-block;
    }

    .nav-links {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        align-items: center;
    }

    .nav-links a {
        color: #64748b;
        text-decoration: none;
        font-size: 0.85rem;
        transition: all 0.2s ease;
    }

    .nav-links a:hover {
        color: var(--primary);
    }

    .nav-links span {
        color: #cbd5e1;
    }

    /* Social Icons */
    .social-icons {
        display: flex;
        gap: 0.75rem;
        margin-top: 1rem;
    }

    .social-icon {
        width: 38px;
        height: 38px;
        background: #f1f5f9;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        color: #64748b;
        text-decoration: none;
    }

    .social-icon:hover {
        background: var(--primary);
        color: white;
        transform: translateY(-2px);
    }

    /* Responsive */
    @media (max-width: 768px) {
        :root {
            --navbar-height: 70px;
        }
        .hero-kontak {
            min-height: 45vh;
        }
        .hero-title {
            font-size: 2rem;
        }
        .hero-subtitle {
            font-size: 0.9rem;
        }
        .maps-container {
            height: 250px;
        }
        .info-card {
            padding: 1rem;
        }
        .form-card, .nav-card {
            padding: 1rem;
        }
    }
</style>

<!-- Hero Section Kontak - Center -->
<section class="hero-kontak">
    <div class="hero-orb-1"></div>
    <div class="hero-orb-2"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center" data-aos="fade-up" data-aos-duration="1000">
                <h1 class="hero-title">HUBUNGI KAMI</h1>
                <p class="hero-subtitle">Kami Siap Membantu Anda</p>
            </div>
        </div>
    </div>
</section>

<!-- Kontak Section -->
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="breadcrumb-custom" data-aos="fade-up">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Hubungi Kami</li>
        </ol>
    </nav>

    <div class="row g-5">
        <!-- Kolom Kiri: Informasi Kontak -->
        <div class="col-lg-6">
            <div class="mb-4">
                <h3 class="fw-bold mb-2">INFORMASI KONTAK</h3>
                <p class="text-muted">Temukan & Hubungi Kami</p>
            </div>

            <div class="row g-3">
                <!-- Alamat -->
                <div class="col-md-12">
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h4>Alamat</h4>
                        <p>Jl. Pendidikan No. 123, Kelurahan Maju,<br>Kecamatan Sejahtera, Kota Maju<br>Kode Pos: 12345</p>
                    </div>
                </div>

                <!-- Telepon -->
                <div class="col-md-6">
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <h4>Telepon</h4>
                        <p>(021) 1234-5678</p>
                        <a href="https://wa.me/6281234567890" target="_blank">0812-3456-7890 (WhatsApp)</a>
                    </div>
                </div>

                <!-- Email -->
                <div class="col-md-6">
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h4>Email</h4>
                        <a href="mailto:info@smkmajujaya.sch.id">info@smkmajujaya.sch.id</a>
                        <a href="mailto:ppdb@smkmajujaya.sch.id">ppdb@smkmajujaya.sch.id</a>
                    </div>
                </div>

                <!-- Jam Kerja -->
                <div class="col-md-12">
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h4>Jam Kerja</h4>
                        <p>Senin - Jumat: 07:00 - 16:00<br>Sabtu: 08:00 - 12:00</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Google Maps -->
        <div class="col-lg-6">
            <div class="maps-container" data-aos="fade-up">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3975.7945313251134!2d109.53979507504408!3d-6.9709887682579454!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fdf0afbf68eb3%3A0x4099d2abd2be655b!2sWINDA%20M%20COLLECTION%20-%20ALPINE!5e1!3m2!1sid!2sid!4v1776594809191!5m2!1sid!2sid" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>

    <!-- FORMULIR KONTAK & NAVIGASI CEPAT -->
    <div class="row g-5 mt-3">
        <!-- Kolom Kiri: Formulir Kontak -->
        <div class="col-lg-6">
            <div class="mb-4">
                <h3 class="fw-bold mb-2">FORMULIR KONTAK</h3>
                <p class="text-muted">Kirim Pesan</p>
            </div>

            <div class="form-card" data-aos="fade-up">
                <form action="#" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control-custom" required placeholder="Masukkan nama Anda">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control-custom" required placeholder="Masukkan email Anda">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. Telepon</label>
                            <input type="tel" name="telepon" class="form-control-custom" placeholder="Masukkan nomor telepon">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Subjek <span class="text-danger">*</span></label>
                            <input type="text" name="subjek" class="form-control-custom" required placeholder="Subjek pesan">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Pesan <span class="text-danger">*</span></label>
                            <textarea name="pesan" class="form-control-custom" rows="5" required placeholder="Tulis pesan Anda di sini..."></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn-submit">
                                <i class="fas fa-paper-plane me-2"></i> Kirim Pesan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Kolom Kanan: Navigasi Cepat -->
        <div class="col-lg-6">
            <div class="mb-4">
                <h3 class="fw-bold mb-2">NAVIGASI CEPAT</h3>
                <p class="text-muted">Tautan Penting</p>
            </div>

            <div class="nav-card" data-aos="fade-up">
                <div class="nav-links">
                    <a href="{{ route('home') }}">Beranda</a>
                    <span>•</span>
                    <a href="{{ route('tentang') }}">Tentang Kami</a>
                    <span>•</span>
                    <a href="{{ route('jurusan.index') }}">Program Jurusan</a>
                    <span>•</span>
                    <a href="{{ route('berita.index') }}">Berita & Artikel</a>
                    <span>•</span>
                    <a href="{{ route('galeri.index') }}">Galeri Kegiatan</a>
                    <span>•</span>
                    <a href="{{ route('agenda.index') }}">Agenda Sekolah</a>
                    <span>•</span>
                    <a href="{{ route('daftar') }}">Pendaftaran</a>
                    <span>•</span>
                    <a href="{{ route('kontak') }}">Hubungi Kami</a>
                </div>
            </div>

            <!-- Sosial Media -->
            <div class="nav-card mt-3" data-aos="fade-up" data-aos-delay="100">
                <h4 class="mb-3">Ikuti Kami</h4>
                <div class="social-icons">
                    <a href="#" class="social-icon" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon" target="_blank"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="social-icon" target="_blank"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection