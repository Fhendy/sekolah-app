@extends('layouts.app')

@section('title', 'Ekstrakurikuler - SMK FH NUSANTARA')

@section('content')
<style>
    :root {
        --primary: #2563eb;
        --primary-dark: #1d4ed8;
        --primary-light: #3b82f6;
        --gray: #64748b;
        --light-bg: #f8fafc;
    }

    /* Hero Section */
    .hero-eskul {
        position: relative;
        min-height: 60vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        background: linear-gradient(135deg, #003f87 0%, #001f4d 100%);
        overflow: hidden;
        padding-top: 80px;
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

    .hero-eskul .container {
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

    /* Eskul Card */
    .eskul-card {
        display: block;
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        overflow: hidden;
        background: white;
        height: 100%;
        text-decoration: none;
        color: inherit;
    }

    .eskul-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
        border-color: #cbd5e1;
    }

    .eskul-img {
        height: 200px;
        width: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .eskul-card:hover .eskul-img {
        transform: scale(1.03);
    }

    .eskul-img-wrapper {
        overflow: hidden;
        position: relative;
        background: #f1f5f9;
    }

    .eskul-body {
        padding: 1.25rem;
    }

    .eskul-title {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: #0f172a;
        line-height: 1.4;
    }

    .eskul-meta {
        font-size: 0.75rem;
        color: #64748b;
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-bottom: 0.5rem;
    }

    .eskul-meta i {
        width: 14px;
        margin-right: 4px;
    }

    .eskul-desc {
        font-size: 0.85rem;
        color: #64748b;
        line-height: 1.5;
        margin-bottom: 0;
    }

    /* Pagination */
    .pagination {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 2rem;
    }

    .pagination .page-item .page-link {
        color: var(--primary);
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 8px 14px;
        transition: all 0.2s ease;
    }

    .pagination .page-item.active .page-link {
        background: var(--primary);
        border-color: var(--primary);
        color: white;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: #f8fafc;
        border-radius: 16px;
    }

    .empty-state i {
        font-size: 4rem;
        color: #cbd5e1;
        margin-bottom: 1rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-eskul {
            min-height: 45vh;
            padding-top: 70px;
        }
        .hero-title {
            font-size: 2rem;
        }
        .hero-subtitle {
            font-size: 0.9rem;
        }
        .eskul-img {
            height: 180px;
        }
    }
</style>

<!-- Hero Section -->
<section class="hero-eskul">
    <div class="hero-orb-1"></div>
    <div class="hero-orb-2"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center" data-aos="fade-up" data-aos-duration="1000">
                <h1 class="hero-title">EKSTRAKURIKULER</h1>
                <p class="hero-subtitle">Wadah Mengembangkan Bakat & Minat Siswa</p>
            </div>
        </div>
    </div>
</section>

<!-- Konten Utama -->
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="breadcrumb-custom" data-aos="fade-up">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Ekstrakurikuler</li>
        </ol>
    </nav>

    @if($eskuls->count() > 0)
    <div class="row g-4">
        @foreach($eskuls as $index => $eskul)
        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($index % 6) * 100 }}">
            <a href="{{ route('eskul.show', $eskul->slug) }}" class="eskul-card">
                <div class="eskul-img-wrapper">
                    @if($eskul->gambar && file_exists(public_path('storage/' . $eskul->gambar)))
                        <img src="{{ asset('storage/' . $eskul->gambar) }}" class="eskul-img" alt="{{ $eskul->nama }}">
                    @else
                        <div class="eskul-img d-flex align-items-center justify-content-center bg-light">
                            <i class="fas fa-futbol fa-3x text-muted"></i>
                        </div>
                    @endif
                </div>
                <div class="eskul-body">
                    <h5 class="eskul-title">{{ Str::limit($eskul->nama, 50) }}</h5>
                    <div class="eskul-meta">
                        @if($eskul->pembina)
                            <span><i class="fas fa-user"></i> {{ $eskul->pembina }}</span>
                        @endif
                        @if($eskul->jadwal)
                            <span><i class="fas fa-calendar-alt"></i> {{ $eskul->jadwal }}</span>
                        @endif
                        @if($eskul->tempat)
                            <span><i class="fas fa-map-marker-alt"></i> {{ $eskul->tempat }}</span>
                        @endif
                    </div>
                    <p class="eskul-desc">{{ Str::limit(strip_tags($eskul->deskripsi), 100) }}</p>
                </div>
            </a>
        </div>
        @endforeach
    </div>

    @if(method_exists($eskuls, 'links'))
    <div class="d-flex justify-content-center mt-5">
        {{ $eskuls->links('pagination::bootstrap-4') }}
    </div>
    @endif
    @else
    <div class="empty-state" data-aos="fade-up">
        <i class="fas fa-futbol"></i>
        <h3>Belum Ada Ekstrakurikuler</h3>
        <p>Belum ada ekstrakurikuler yang dipublikasikan saat ini.</p>
    </div>
    @endif
</div>
@endsection