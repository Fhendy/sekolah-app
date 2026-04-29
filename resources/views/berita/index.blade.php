@extends('layouts.app')

@section('title', 'Berita & Artikel - SMK FH NUSANTARA')

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

    .hero-berita {
        position: relative;
        min-height: calc(100vh - var(--navbar-height));
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

    .hero-berita .container {
        position: relative;
        z-index: 2;
    }

    .hero-berita .badge {
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
        margin: 0 auto;
    }

    .search-box {
        max-width: 450px;
        margin: 1.5rem auto 0;
    }

    .search-input-group {
        display: flex;
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .search-input {
        flex: 1;
        border: none;
        padding: 12px 18px;
        font-size: 0.9rem;
        outline: none;
    }

    .search-input::placeholder {
        color: #9ca3af;
    }

    .search-btn {
        background: white;
        border: none;
        color: var(--primary);
        padding: 0 24px;
        cursor: pointer;
        transition: all 0.2s ease;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .search-btn:hover {
        color: var(--primary-dark);
    }

    .news-card {
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

    .news-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
        border-color: #cbd5e1;
    }

    .news-img {
        height: 220px;
        width: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .news-card:hover .news-img {
        transform: scale(1.03);
    }

    .news-img-wrapper {
        overflow: hidden;
        position: relative;
        background: #f1f5f9;
    }

    .news-date {
        position: absolute;
        bottom: 12px;
        left: 12px;
        background: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(4px);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
    }

    .news-body {
        padding: 1.25rem;
    }

    .news-title {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
        color: #0f172a;
        line-height: 1.4;
    }

    .news-excerpt {
        font-size: 0.85rem;
        color: #64748b;
        line-height: 1.5;
        margin-bottom: 0;
    }

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

    @media (max-width: 768px) {
        .hero-berita {
            min-height: calc(100vh - var(--navbar-height));
        }
        .hero-title {
            font-size: 2rem;
        }
        .news-img {
            height: 180px;
        }
    }
</style>

<section class="hero-berita">
    <div class="hero-orb-1"></div>
    <div class="hero-orb-2"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center" data-aos="fade-up">
                <div class="badge text-white mb-4 d-inline-block">
                    <i class="fas fa-newspaper me-2"></i>Update Terkini
                </div>
                <h1 class="hero-title mb-4">Berita & Artikel</h1>
                <p class="hero-subtitle mb-4">
                    Informasi terkini seputar kegiatan dan prestasi SMK FH NUSANTARA
                </p>
                
                <form action="{{ route('berita.index') }}" method="GET" class="search-box">
                    <div class="search-input-group">
                        <input type="text" name="search" class="search-input" 
                               placeholder="Cari berita..." value="{{ request('search') }}">
                        <button type="submit" class="search-btn">
                            <i class="fas fa-search me-1"></i> Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<div class="container py-5">
    @if(request('search'))
    <div class="mb-4 text-center">
        <p class="text-muted">
            Menampilkan hasil pencarian untuk: <strong>"{{ request('search') }}"</strong>
            <a href="{{ route('berita.index') }}" class="btn btn-sm btn-outline-primary rounded-pill ms-2">Reset</a>
        </p>
    </div>
    @endif

    @if($beritas->count() > 0)
    <div class="row g-4">
        @foreach($beritas as $index => $berita)
        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($index % 6) * 100 }}">
            <a href="{{ route('berita.show', $berita->slug) }}" class="news-card">
                <div class="news-img-wrapper">
                    @if($berita->gambar)
                        <img src="{{ asset('storage/' . $berita->gambar) }}" class="news-img" alt="{{ $berita->judul }}" onerror="this.src='https://placehold.co/400x220/e2e8f0/64748b?text=No+Image'; this.onerror=null;">
                    @else
                        <div class="news-img d-flex align-items-center justify-content-center bg-light">
                            <i class="fas fa-image fa-3x text-muted"></i>
                        </div>
                    @endif
                    <span class="news-date">
                        <i class="far fa-calendar-alt me-1"></i> {{ $berita->tanggal->format('d M Y') }}
                    </span>
                </div>
                <div class="news-body">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="fas fa-user-circle text-primary"></i>
                        <small class="text-muted">{{ $berita->penulis }}</small>
                    </div>
                    <h5 class="news-title">{{ Str::limit($berita->judul, 55) }}</h5>
                    <p class="news-excerpt">{{ Str::limit(strip_tags($berita->konten), 100) }}</p>
                </div>
            </a>
        </div>
        @endforeach
    </div>

    @if(method_exists($beritas, 'links'))
    <div class="d-flex justify-content-center mt-5">
        {{ $beritas->links('pagination::bootstrap-4') }}
    </div>
    @endif
    @else
    <div class="empty-state">
        <i class="fas fa-newspaper"></i>
        <h3>Belum Ada Berita</h3>
        <p>Belum ada berita yang dipublikasikan saat ini.</p>
        @if(request('search'))
        <a href="{{ route('berita.index') }}" class="btn btn-outline-primary rounded-pill mt-3">Kembali ke Semua Berita</a>
        @endif
    </div>
    @endif
</div>
@endsection