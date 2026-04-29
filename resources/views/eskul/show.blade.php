@extends('layouts.app')

@section('title', $eskul->nama . ' - SMK FH NUSANTARA')

@section('content')
<style>
    :root {
        --primary: #2563eb;
        --primary-dark: #1d4ed8;
        --primary-light: #3b82f6;
        --gray: #64748b;
        --light-bg: #f8fafc;
    }

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

    .breadcrumb-custom {
        background: transparent;
        padding: 1rem 0;
        margin-bottom: 1rem;
    }

    .breadcrumb-custom .breadcrumb-item a {
        color: var(--primary);
        text-decoration: none;
    }

    .eskul-card {
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        overflow: hidden;
        background: white;
    }

    .eskul-img {
        width: 100%;
        max-height: 400px;
        object-fit: cover;
        background: #f1f5f9;
    }

    .eskul-body {
        padding: 2rem;
    }

    .eskul-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: #0f172a;
    }

    .eskul-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        padding-bottom: 1rem;
        margin-bottom: 1.5rem;
        border-bottom: 1px solid #e2e8f0;
        color: #64748b;
        font-size: 0.85rem;
    }

    .eskul-meta i {
        width: 18px;
        margin-right: 6px;
    }

    .eskul-content {
        font-size: 1rem;
        line-height: 1.8;
        color: #334155;
    }

    .sidebar-card {
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        overflow: hidden;
        background: white;
        margin-bottom: 1.5rem;
    }

    .sidebar-title {
        font-size: 1.1rem;
        font-weight: 700;
        padding: 1rem 1.25rem;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        color: #0f172a;
    }

    .sidebar-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar-list li {
        border-bottom: 1px solid #f1f5f9;
    }

    .sidebar-list li:last-child {
        border-bottom: none;
    }

    .sidebar-link {
        display: flex;
        gap: 12px;
        padding: 1rem 1.25rem;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .sidebar-link:hover {
        background: #f8fafc;
    }

    .sidebar-img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 10px;
        flex-shrink: 0;
        background: #f1f5f9;
    }

    .sidebar-info {
        flex: 1;
    }

    .sidebar-info h6 {
        font-size: 0.85rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
        color: #0f172a;
        line-height: 1.3;
    }

    .sidebar-info p {
        font-size: 0.7rem;
        color: #64748b;
        margin: 0;
    }

    .btn-back {
        display: inline-block;
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        color: #64748b;
        padding: 10px 24px;
        border-radius: 40px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-back:hover {
        background: #e2e8f0;
        color: #0f172a;
    }

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
        .eskul-title {
            font-size: 1.3rem;
        }
        .eskul-body {
            padding: 1.25rem;
        }
        .eskul-meta {
            gap: 0.75rem;
            font-size: 0.75rem;
        }
        .eskul-content {
            font-size: 0.9rem;
        }
    }
</style>

<!-- Hero Section -->
<section class="hero-eskul">
    <div class="hero-orb-1"></div>
    <div class="hero-orb-2"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center" data-aos="fade-up">
                <h1 class="hero-title">EKSTRAKURIKULER</h1>
                <p class="hero-subtitle">Wadah Mengembangkan Bakat & Minat Siswa</p>
            </div>
        </div>
    </div>
</section>

<!-- Konten Utama -->
<div class="container py-5">
    <nav aria-label="breadcrumb" class="breadcrumb-custom">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('eskul.index') }}">Ekstrakurikuler</a></li>
            <li class="breadcrumb-item active">{{ Str::limit($eskul->nama, 40) }}</li>
        </ol>
    </nav>

    <div class="row g-5">
        <div class="col-lg-8">
            <div class="eskul-card">
                @if($eskul->gambar && file_exists(public_path('storage/' . $eskul->gambar)))
                    <img src="{{ asset('storage/' . $eskul->gambar) }}" class="eskul-img" alt="{{ $eskul->nama }}">
                @else
                    <div class="eskul-img d-flex align-items-center justify-content-center bg-light">
                        <i class="fas fa-futbol fa-4x text-muted"></i>
                    </div>
                @endif
                
                <div class="eskul-body">
                    <h1 class="eskul-title">{{ $eskul->nama }}</h1>
                    <div class="eskul-meta">
                        @if($eskul->pembina)
                            <span><i class="fas fa-user"></i> Pembina: {{ $eskul->pembina }}</span>
                        @endif
                        @if($eskul->jadwal)
                            <span><i class="fas fa-calendar-alt"></i> Jadwal: {{ $eskul->jadwal }}</span>
                        @endif
                        @if($eskul->tempat)
                            <span><i class="fas fa-map-marker-alt"></i> Tempat: {{ $eskul->tempat }}</span>
                        @endif
                    </div>
                    
                    <div class="eskul-content">
                        {!! nl2br(e($eskul->deskripsi)) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="sidebar-card">
                <div class="sidebar-title">
                    <i class="fas fa-futbol me-2"></i> Ekstrakurikuler Lainnya
                </div>
                <ul class="sidebar-list">
                    @forelse($eskulLain as $item)
                    <li>
                        <a href="{{ route('eskul.show', $item->slug) }}" class="sidebar-link">
                            @if($item->gambar && file_exists(public_path('storage/' . $item->gambar)))
                                <img src="{{ asset('storage/' . $item->gambar) }}" class="sidebar-img" alt="{{ $item->nama }}">
                            @else
                                <div class="sidebar-img d-flex align-items-center justify-content-center bg-light">
                                    <i class="fas fa-futbol text-muted"></i>
                                </div>
                            @endif
                            <div class="sidebar-info">
                                <h6>{{ Str::limit($item->nama, 40) }}</h6>
                                @if($item->pembina)
                                    <p><i class="fas fa-user me-1"></i> {{ $item->pembina }}</p>
                                @endif
                            </div>
                        </a>
                    </li>
                    @empty
                    <li>
                        <div class="sidebar-link">
                            <p class="text-muted mb-0">Belum ada ekstrakurikuler lainnya</p>
                        </div>
                    </li>
                    @endforelse
                </ul>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('eskul.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left me-2"></i> Semua Ekstrakurikuler
                </a>
            </div>
        </div>
    </div>
</div>
@endsection