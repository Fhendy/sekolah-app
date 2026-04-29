@extends('layouts.app')

@section('title', 'SMK FH NUSANTARA - Sekolah Unggulan Berprestasi')

@section('content')
<style>
    :root {
        --primary: #2563eb;
        --primary-dark: #1d4ed8;
        --primary-light: #3b82f6;
        --accent: #f72585;
        --success: #06d6a0;
        --warning: #ffd166;
        --dark: #0f172a;
        --darker: #020617;
        --light: #f8fafc;
        --gray: #64748b;
        --cta-bg: #003f87;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', 'Inter', sans-serif;
        overflow-x: hidden;
    }

    /* ============================================ */
    /* HERO SLIDER - HANYA GAMBAR (tanpa teks) */
    /* ============================================ */
    .hero-slider-container {
        position: relative;
        width: 100%;
        overflow: hidden;
    }

    .hero-slider-container .carousel-item {
        min-height: 100vh;
    }

    .hero-slider-container .carousel-item img {
        width: 100%;
        height: 100vh;
        object-fit: cover;
    }

    /* Carousel Controls */
    .hero-slider-container .carousel-control-prev,
    .hero-slider-container .carousel-control-next {
        width: 5%;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .hero-slider-container:hover .carousel-control-prev,
    .hero-slider-container:hover .carousel-control-next {
        opacity: 1;
    }

    .hero-slider-container .carousel-control-prev-icon,
    .hero-slider-container .carousel-control-next-icon {
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
        padding: 20px;
        background-size: 50%;
    }

    .hero-slider-container .carousel-indicators {
        bottom: 20px;
    }

    .hero-slider-container .carousel-indicators button {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin: 0 6px;
        background-color: white;
        opacity: 0.5;
    }

    .hero-slider-container .carousel-indicators button.active {
        opacity: 1;
    }

    @media (max-width: 768px) {
        .hero-slider-container .carousel-item {
            min-height: 70vh;
        }
        .hero-slider-container .carousel-item img {
            height: 70vh;
        }
        .hero-slider-container .carousel-control-prev,
        .hero-slider-container .carousel-control-next {
            opacity: 0.5;
        }
        .hero-slider-container .carousel-control-prev-icon,
        .hero-slider-container .carousel-control-next-icon {
            padding: 12px;
            background-size: 40%;
        }
    }

    @media (max-width: 576px) {
        .hero-slider-container .carousel-item {
            min-height: 50vh;
        }
        .hero-slider-container .carousel-item img {
            height: 50vh;
        }
        .hero-slider-container .carousel-indicators {
            bottom: 10px;
        }
        .hero-slider-container .carousel-indicators button {
            width: 8px;
            height: 8px;
            margin: 0 4px;
        }
    }

    /* Animasi Fade */
    .carousel-fade .carousel-item {
        opacity: 0;
        transition-duration: 0.6s;
        transition-property: opacity;
    }

    .carousel-fade .carousel-item.active,
    .carousel-fade .carousel-item-next.carousel-item-start,
    .carousel-fade .carousel-item-prev.carousel-item-end {
        opacity: 1;
    }

    .carousel-fade .active.carousel-item-start,
    .carousel-fade .active.carousel-item-end {
        opacity: 0;
    }

    .carousel-fade .carousel-item-next,
    .carousel-fade .carousel-item-prev,
    .carousel-fade .carousel-item.active,
    .carousel-fade .active.carousel-item-start,
    .carousel-fade .active.carousel-item-prev {
        transform: translateX(0);
    }

    /* Stat Cards */
    .stat-card {
        background: #ffffff;
        border-radius: 8px;
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 2px rgba(0,0,0,0.03);
    }

    .stat-card:hover {
        transform: translateY(-3px);
        border-color: #cbd5e1;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }

    .stat-icon {
        width: 56px;
        height: 56px;
        background: #f1f5f9;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }

    .stat-icon i {
        font-size: 1.6rem;
        color: var(--primary);
    }

    .counter {
        font-size: 2rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 0.25rem;
    }

    @media (max-width: 768px) {
        .counter {
            font-size: 1.5rem;
        }
        .stat-icon {
            width: 45px;
            height: 45px;
        }
        .stat-icon i {
            font-size: 1.3rem;
        }
        .stat-card {
            padding: 1rem;
        }
    }

    /* Jurusan Cards - Dengan Logo Portrait */
    .jurusan-card {
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

    .jurusan-card:hover {
        transform: translateY(-5px);
        border-color: #cbd5e1;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
    }

    .jurusan-logo-wrapper {
        background: linear-gradient(135deg, #003f87 0%, #001f4d 100%);
        padding: 1rem;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 160px;
    }

    .jurusan-logo-img {
        width: auto;
        height: 130px;
        max-width: 90%;
        object-fit: contain;
    }

    .jurusan-header {
        background: linear-gradient(135deg, #003f87 0%, #001f4d 100%);
        padding: 1rem;
        text-align: center;
        min-height: 160px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .jurusan-header i {
        font-size: 4rem;
        color: white;
    }

    .jurusan-body {
        padding: 0.75rem 0.75rem 1rem;
        text-align: center;
    }

    .jurusan-body h5 {
        font-size: 0.9rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
        color: #0f172a;
        line-height: 1.3;
    }

    .jurusan-code {
        display: inline-block;
        background: #f1f5f9;
        color: var(--dark);
        padding: 2px 8px;
        border-radius: 4px;
        font-size: 0.6rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .jurusan-body p {
        color: #64748b;
        font-size: 0.7rem;
        line-height: 1.4;
        margin-bottom: 0;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    @media (max-width: 992px) {
        .jurusan-logo-img {
            height: 110px;
        }
        .jurusan-header i {
            font-size: 3.5rem;
        }
    }

    @media (max-width: 768px) {
        .jurusan-logo-wrapper {
            min-height: 130px;
        }
        .jurusan-logo-img {
            height: 90px;
        }
        .jurusan-header {
            min-height: 130px;
        }
        .jurusan-header i {
            font-size: 2.8rem;
        }
        .jurusan-body {
            padding: 0.6rem 0.6rem 0.8rem;
        }
        .jurusan-body h5 {
            font-size: 0.8rem;
        }
        .jurusan-body p {
            font-size: 0.65rem;
        }
    }

    @media (max-width: 575px) {
        .jurusan-logo-wrapper {
            min-height: 110px;
            padding: 0.75rem;
        }
        .jurusan-logo-img {
            height: 75px;
        }
        .jurusan-header {
            min-height: 110px;
        }
        .jurusan-header i {
            font-size: 2.2rem;
        }
        .jurusan-body {
            padding: 0.5rem 0.5rem 0.7rem;
        }
        .jurusan-body h5 {
            font-size: 0.7rem;
        }
        .jurusan-body p {
            font-size: 0.6rem;
        }
        .jurusan-code {
            font-size: 0.55rem;
            padding: 2px 6px;
        }
    }

    /* News Cards */
    .news-card {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
        height: 100%;
    }

    .news-card:hover {
        transform: translateY(-3px);
        border-color: #cbd5e1;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .news-image-link {
        display: block;
        overflow: hidden;
        height: 180px;
    }

    .news-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .news-card:hover .news-image {
        transform: scale(1.03);
    }

    .news-content {
        padding: 1rem;
    }

    .news-date {
        font-size: 0.7rem;
        color: var(--gray);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
    }

    .news-content h5 {
        font-size: 0.9rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }

    .news-content p {
        font-size: 0.75rem;
        color: #64748b;
        line-height: 1.5;
        margin-bottom: 0;
    }

    /* Agenda Cards */
    .agenda-card {
        background: white;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
    }

    .agenda-card:hover {
        transform: translateX(4px);
        border-color: #cbd5e1;
    }

    .agenda-date {
        background: #f1f5f9;
        border-radius: 8px;
        padding: 8px 14px;
        text-align: center;
        min-width: 70px;
    }

    /* Prestasi Cards */
    .prestasi-card {
        text-align: center;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 1.5rem;
        transition: all 0.3s ease;
        background: white;
        height: 100%;
    }

    .prestasi-card:hover {
        transform: translateY(-5px);
        border-color: #cbd5e1;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
    }

    .prestasi-img-wrapper {
        width: 120px;
        height: 160px;
        margin: 0 auto 1rem;
        overflow: hidden;
        border-radius: 12px;
    }

    .prestasi-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .prestasi-card:hover .prestasi-img {
        transform: scale(1.05);
    }

    .prestasi-icon {
        width: 100px;
        height: 140px;
        margin: 0 auto 1rem;
        background: linear-gradient(135deg, #003f87 0%, #001f4d 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .prestasi-icon i {
        font-size: 2.5rem;
        color: white;
    }

    .prestasi-card h5 {
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: #0f172a;
        font-size: 0.95rem;
    }

    .prestasi-card p {
        color: var(--gray);
        font-size: 0.75rem;
        margin: 0;
        line-height: 1.5;
    }

    .prestasi-tahun {
        display: inline-block;
        background: rgba(37, 99, 235, 0.1);
        color: var(--primary);
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.7rem;
        margin-top: 0.75rem;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .prestasi-card {
            padding: 1rem;
        }
        .prestasi-img-wrapper {
            width: 90px;
            height: 120px;
        }
        .prestasi-icon {
            width: 75px;
            height: 105px;
        }
        .prestasi-icon i {
            font-size: 1.8rem;
        }
        .prestasi-card h5 {
            font-size: 0.85rem;
        }
        .prestasi-card p {
            font-size: 0.7rem;
        }
    }

    /* Buttons */
    .btn-primary-custom {
        display: inline-block;
        background: #f1f5f9;
        border: 1px solid #cbd5e1;
        color: var(--dark);
        padding: 8px 20px;
        border-radius: 8px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-primary-custom:hover {
        background: #e2e8f0;
        border-color: #94a3b8;
        color: var(--dark);
    }

    .btn-outline-custom {
        display: inline-block;
        background: transparent;
        border: 1px solid #cbd5e1;
        color: var(--dark);
        padding: 6px 16px;
        border-radius: 8px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-outline-custom:hover {
        background: #f1f5f9;
        border-color: #94a3b8;
        color: var(--dark);
    }

    .btn-solid-custom {
        display: inline-block;
        background: white;
        border: 1px solid white;
        color: #003f87;
        padding: 10px 24px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-solid-custom:hover {
        background: rgba(255,255,255,0.9);
        border-color: rgba(255,255,255,0.9);
        color: #003f87;
        transform: translateY(-2px);
    }

    .btn-outline-white {
        display: inline-block;
        background: transparent;
        border: 1px solid white;
        color: white;
        padding: 10px 24px;
        border-radius: 8px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-outline-white:hover {
        background: rgba(255,255,255,0.1);
        border-color: white;
        color: white;
    }

    /* Section Title */
    .section-title {
        text-align: center;
        margin-bottom: 2.5rem;
    }

    .section-title .subtitle {
        display: inline-block;
        background: #f1f5f9;
        color: var(--primary);
        padding: 4px 14px;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
    }

    .section-title h2 {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: var(--dark);
    }

    .section-title .divider {
        width: 50px;
        height: 3px;
        background: var(--primary);
        margin: 0.75rem auto;
        border-radius: 2px;
    }

    @media (max-width: 768px) {
        .section-title h2 {
            font-size: 1.4rem;
        }
    }

    /* CTA Section */
    .cta-section {
        background: #003f87;
        text-align: center;
        padding: 3rem 0;
    }

    .cta-section h2 {
        color: white;
        font-size: 1.5rem;
    }

    .cta-section p {
        color: rgba(255,255,255,0.8);
        font-size: 0.9rem;
    }

    @media (max-width: 768px) {
        .cta-section {
            padding: 2rem 0;
        }
        .cta-section h2 {
            font-size: 1.2rem;
        }
    }
</style>

<!-- Hero Slider - HANYA GAMBAR (tanpa teks, badge, tombol, gradient) -->
<div class="hero-slider-container">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-indicators">
            @foreach($heroSliders as $index => $slider)
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach($heroSliders as $index => $slider)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <img src="{{ asset('storage/' . $slider->gambar) }}" alt="Hero Slide {{ $index+1 }}">
            </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<!-- Statistik Section -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h3 class="counter mb-1" data-target="{{ $statistik->jumlah_siswa ?? 1250 }}">0</h3>
                    <p class="text-muted mb-0 small">Total Siswa Aktif</p>
                </div>
            </div>
            <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="counter mb-1" data-target="{{ $statistik->jumlah_alumni ?? 5800 }}">0</h3>
                    <p class="text-muted mb-0 small">Total Alumni</p>
                </div>
            </div>
            <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-chalkboard-user"></i>
                    </div>
                    <h3 class="counter mb-1" data-target="{{ $statistik->jumlah_guru ?? 85 }}">0</h3>
                    <p class="text-muted mb-0 small">Tenaga Pengajar</p>
                </div>
            </div>
            <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="400">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h3 class="counter mb-1" data-target="{{ $statistik->tahun_berdiri ?? 1998 }}">0</h3>
                    <p class="text-muted mb-0 small">Tahun Berdiri</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Program Jurusan - Dengan Logo Portrait -->
<section id="jurusan" class="py-5 bg-light">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <span class="subtitle"><i class="fas fa-graduation-cap me-2"></i>Program Unggulan</span>
            <h2>Program Keahlian</h2>
            <div class="divider"></div>
            <p class="text-muted mt-2">Klik card untuk mempelajari lebih lanjut tentang program keahlian</p>
        </div>
        <div class="row g-3">
            @forelse($jurusans as $index => $jurusan)
            <div class="col-md-6 col-lg-3 col-6" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <a href="{{ route('jurusan.show', $jurusan) }}" class="jurusan-card">
                    @if($jurusan->logo && file_exists(public_path('storage/' . $jurusan->logo)))
                        <div class="jurusan-logo-wrapper">
                            <img src="{{ asset('storage/' . $jurusan->logo) }}" alt="{{ $jurusan->nama }}" class="jurusan-logo-img">
                        </div>
                    @else
                        <div class="jurusan-header">
                            <i class="fas {{ $jurusan->ikon ?? 'fa-laptop-code' }}"></i>
                        </div>
                    @endif
                    <div class="jurusan-body">
                        <span class="jurusan-code">{{ $jurusan->kode }}</span>
                        <h5>{{ Str::limit($jurusan->nama, 25) }}</h5>
                        <p>{{ Str::limit($jurusan->deskripsi, 60) }}</p>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada data jurusan</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Berita Terbaru -->
<section id="berita" class="py-5 bg-white">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <span class="subtitle"><i class="fas fa-newspaper me-2"></i>Update Terkini</span>
            <h2>Berita & Artikel</h2>
            <div class="divider"></div>
            <p class="text-muted mt-2">Klik thumbnail atau judul berita untuk membaca selengkapnya</p>
        </div>
        <div class="row g-4">
            @forelse($beritas as $index => $berita)
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <div class="news-card">
                    <a href="{{ route('berita.show', $berita) }}" class="news-image-link">
                        @if($berita->gambar && file_exists(public_path('storage/' . $berita->gambar)))
                        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="news-image">
                        @else
                        <img src="{{ asset('images/placeholder-news.jpg') }}" alt="Berita" class="news-image">
                        @endif
                    </a>
                    <div class="news-content">
                        <div class="news-date">
                            <i class="far fa-calendar-alt"></i> {{ $berita->tanggal->format('d M Y') }}
                            <span class="mx-1">•</span>
                            <i class="fas fa-user-circle"></i> {{ $berita->penulis }}
                        </div>
                        <a href="{{ route('berita.show', $berita) }}" class="text-decoration-none">
                            <h5>{{ Str::limit($berita->judul, 50) }}</h5>
                        </a>
                        <p>{{ Str::limit(strip_tags($berita->konten), 80) }}</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada berita terbaru</p>
            </div>
            @endforelse
        </div>
        <div class="text-center mt-5" data-aos="fade-up">
            <a href="{{ route('berita.index') }}" class="btn-primary-custom">
                <i class="fas fa-newspaper me-2"></i>Lihat Semua Berita
            </a>
        </div>
    </div>
</section>

<!-- Agenda -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-12" data-aos="fade-right">
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                    <h3 class="fw-bold mb-0">
                        <i class="fas fa-calendar-alt text-primary me-2"></i>Agenda Mendatang
                    </h3>
                    <a href="{{ route('agenda.index') }}" class="btn-outline-custom btn-sm">Lihat Semua <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
                @forelse($agendas as $agenda)
                <div class="agenda-card">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="agenda-date">
                                <div class="fs-3 fw-bold">{{ $agenda->tanggal_mulai->format('d') }}</div>
                                <div class="small">{{ $agenda->tanggal_mulai->format('M') }}</div>
                            </div>
                        </div>
                        <div class="col">
                            <h5 class="fw-bold mb-1">{{ Str::limit($agenda->judul, 40) }}</h5>
                            <div class="d-flex flex-wrap gap-3 small text-muted">
                                <span><i class="fas fa-clock"></i> {{ $agenda->tanggal_mulai->format('H:i') }} WIB</span>
                                <span><i class="fas fa-map-marker-alt"></i> {{ $agenda->tempat }}</span>
                            </div>
                            <p class="mb-0 small mt-2">{{ Str::limit($agenda->deskripsi, 80) }}</p>
                        </div>
                        <div class="col-auto">
                            <span class="badge {{ $agenda->status == 'Akan Datang' ? 'bg-success' : ($agenda->status == 'Berlangsung' ? 'bg-warning' : 'bg-secondary') }} px-3 py-2">
                                {{ $agenda->status }}
                            </span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-4">
                    <div class="bg-light p-4 d-inline-flex mb-3 rounded">
                        <i class="fas fa-calendar-alt fa-3x text-muted"></i>
                    </div>
                    <p class="text-muted">Belum ada agenda mendatang</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

<!-- Prestasi Section -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <span class="subtitle"><i class="fas fa-trophy me-2"></i>Pencapaian Kami</span>
            <h2>Prestasi & Penghargaan</h2>
            <div class="divider"></div>
            <p class="text-muted mt-2">Bukti komitmen kami dalam memberikan pendidikan terbaik</p>
        </div>
        <div class="row g-4">
            @php
                use App\Models\Prestasi;
                $prestasiHome = Prestasi::where('status', 'aktif')->orderBy('urutan', 'asc')->limit(3)->get();
            @endphp
            @forelse($prestasiHome as $index => $item)
            <div class="col-md-4 col-6" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <div class="prestasi-card">
                    @if($item->gambar && file_exists(public_path('storage/' . $item->gambar)))
                        <div class="prestasi-img-wrapper">
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="prestasi-img">
                        </div>
                    @else
                        <div class="prestasi-icon">
                            <i class="fas fa-trophy text-warning"></i>
                        </div>
                    @endif
                    <h5>{{ Str::limit($item->judul, 30) }}</h5>
                    <p>{{ Str::limit($item->deskripsi, 50) }}</p>
                    @if($item->tahun)
                        <div class="prestasi-tahun">{{ $item->tahun }}</div>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-md-4 col-6">
                <div class="prestasi-card">
                    <div class="prestasi-icon">
                        <i class="fas fa-trophy text-warning"></i>
                    </div>
                    <h5>Juara 1 LKS</h5>
                    <p>Tingkat Provinsi 2024</p>
                </div>
            </div>
            <div class="col-md-4 col-6">
                <div class="prestasi-card">
                    <div class="prestasi-icon">
                        <i class="fas fa-leaf text-success"></i>
                    </div>
                    <h5>Adiwiyata Nasional</h5>
                    <p>Sekolah Peduli Lingkungan</p>
                </div>
            </div>
            <div class="col-md-4 col-6">
                <div class="prestasi-card">
                    <div class="prestasi-icon">
                        <i class="fas fa-award text-danger"></i>
                    </div>
                    <h5>Akreditasi A</h5>
                    <p>BAN-S/M 2023</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center" data-aos="fade-up">
                <h2 class="fw-bold mb-3">Siap Bergabung dengan SMK FH NUSANTARA?</h2>
                <p class="mb-4">Daftarkan diri Anda sekarang dan raih masa depan cerah bersama kami</p>
                <div class="d-flex flex-wrap gap-3 justify-content-center">
                    <a href="{{ route('daftar') }}" class="btn-solid-custom">
                        <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                    </a>
                    <a href="#jurusan" class="btn-outline-white">
                        <i class="fas fa-book-open me-2"></i>Propram Keahlian
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    AOS.init({
        duration: 800,
        once: true,
        easing: 'ease-out-cubic'
    });

    function startCounters() {
        const counters = document.querySelectorAll('.counter');
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'));
            let current = 0;
            const duration = 2000;
            const step = Math.ceil(target / (duration / 16));
            
            const updateCounter = () => {
                if (current < target) {
                    current += step;
                    if (current > target) current = target;
                    counter.innerText = current.toLocaleString();
                    requestAnimationFrame(updateCounter);
                }
            };
            updateCounter();
        });
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                startCounters();
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.3 });

    const statsSection = document.querySelector('.stat-card')?.parentElement?.parentElement;
    if (statsSection) observer.observe(statsSection);

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
</script>
@endpush
@endsection 