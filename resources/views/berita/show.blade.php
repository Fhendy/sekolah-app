@extends('layouts.app')

@section('title', $berita->judul . ' - SMK FH NUSANTARA')

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

    .hero-berita-detail {
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

    .hero-berita-detail .container {
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

    .berita-content {
        font-size: 1.05rem;
        line-height: 1.8;
        color: #334155;
    }

    .berita-content h2, .berita-content h3 {
        margin-top: 1.5rem;
        margin-bottom: 1rem;
        font-weight: 700;
        color: #0f172a;
    }

    .share-section {
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid #e2e8f0;
    }

    .share-title {
        font-weight: 600;
        margin-bottom: 0.75rem;
        color: #0f172a;
    }

    .share-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        align-items: center;
    }

    .btn-share {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        border-radius: 30px;
        font-size: 0.85rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
        cursor: pointer;
        border: none;
    }

    .btn-share-wa { background: #25D366; color: white; }
    .btn-share-wa:hover { background: #128C7E; color: white; }
    .btn-share-fb { background: #1877F2; color: white; }
    .btn-share-fb:hover { background: #0d65d9; color: white; }
    .btn-share-twitter { background: #1DA1F2; color: white; }
    .btn-share-twitter:hover { background: #0c85d0; color: white; }
    .btn-copy-link { background: #f1f5f9; color: #334155; border: 1px solid #e2e8f0; }
    .btn-copy-link:hover { background: #e2e8f0; color: #0f172a; }

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
        width: 70px;
        height: 70px;
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

    .article-card {
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        overflow: hidden;
        background: white;
    }

    .article-img {
        width: 100%;
        max-height: 450px;
        object-fit: cover;
        background: #f1f5f9;
    }

    .article-body {
        padding: 2rem;
    }

    .article-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: #0f172a;
    }

    .article-meta {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 1rem;
        margin-bottom: 1.5rem;
        border-bottom: 1px solid #e2e8f0;
        color: #64748b;
        font-size: 0.85rem;
    }

    @media (max-width: 768px) {
        .hero-berita-detail { min-height: 45vh; }
        .hero-title { font-size: 2rem; }
        .hero-subtitle { font-size: 0.9rem; }
        .article-title { font-size: 1.3rem; }
        .article-body { padding: 1.25rem; }
    }
</style>

<section class="hero-berita-detail">
    <div class="hero-orb-1"></div>
    <div class="hero-orb-2"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center" data-aos="fade-up">
                <h1 class="hero-title">JENDELA INFORMASI</h1>
                <p class="hero-subtitle">Dinamika & Wawasan</p>
            </div>
        </div>
    </div>
</section>

<div class="container py-5">
    <nav aria-label="breadcrumb" class="breadcrumb-custom">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('berita.index') }}">Berita</a></li>
            <li class="breadcrumb-item active">{{ Str::limit($berita->judul, 40) }}</li>
        </ol>
    </nav>

    <div class="row g-5">
        <div class="col-lg-8">
            <div class="article-card">
                @if($berita->gambar)
                    <img src="{{ asset('storage/' . $berita->gambar) }}" class="article-img" alt="{{ $berita->judul }}" onerror="this.src='https://placehold.co/800x450/e2e8f0/64748b?text=No+Image'; this.onerror=null;">
                @else
                    <div class="article-img d-flex align-items-center justify-content-center bg-light">
                        <i class="fas fa-image fa-4x text-muted"></i>
                    </div>
                @endif
                
                <div class="article-body">
                    <h1 class="article-title">{{ $berita->judul }}</h1>
                    <div class="article-meta">
                        <span><i class="far fa-calendar-alt me-2"></i> {{ $berita->tanggal->format('d F Y') }}</span>
                        <span><i class="far fa-user me-2"></i> {{ $berita->penulis }}</span>
                    </div>
                    
                    <div class="berita-content">
                        {!! $berita->konten !!}
                    </div>

                    <div class="share-section">
                        <div class="share-title">
                            <i class="fas fa-share-alt me-2"></i> Bagikan Artikel
                        </div>
                        <div class="share-buttons">
                            <button class="btn-share btn-copy-link" onclick="copyLink()">
                                <i class="fas fa-link"></i> Salin Tautan
                            </button>
                            <a href="https://wa.me/?text={{ urlencode($berita->judul . ' - ' . route('berita.show', $berita->slug)) }}" 
                               target="_blank" class="btn-share btn-share-wa">
                                <i class="fab fa-whatsapp"></i> WhatsApp
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('berita.show', $berita->slug)) }}" 
                               target="_blank" class="btn-share btn-share-fb">
                                <i class="fab fa-facebook-f"></i> Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($berita->judul) }}&url={{ urlencode(route('berita.show', $berita->slug)) }}" 
                               target="_blank" class="btn-share btn-share-twitter">
                                <i class="fab fa-twitter"></i> Twitter
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="sidebar-card">
                <div class="sidebar-title">
                    <i class="fas fa-newspaper me-2"></i> Artikel Lainnya
                </div>
                <ul class="sidebar-list">
                    @php
                        $otherBerita = App\Models\Berita::where('id', '!=', $berita->id)
                            ->orderBy('tanggal', 'desc')
                            ->limit(5)
                            ->get();
                    @endphp
                    @forelse($otherBerita as $item)
                    <li>
                        <a href="{{ route('berita.show', $item->slug) }}" class="sidebar-link">
                            @if($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" class="sidebar-img" alt="{{ $item->judul }}" onerror="this.src='https://placehold.co/70x70/e2e8f0/64748b?text=No+Image'; this.onerror=null;">
                            @else
                                <div class="sidebar-img d-flex align-items-center justify-content-center bg-light">
                                    <i class="fas fa-image text-muted"></i>
                                </div>
                            @endif
                            <div class="sidebar-info">
                                <h6>{{ Str::limit($item->judul, 45) }}</h6>
                                <p><i class="far fa-calendar-alt me-1"></i> {{ $item->tanggal->format('d M Y') }}</p>
                            </div>
                        </a>
                    </li>
                    @empty
                    <li>
                        <div class="sidebar-link">
                            <p class="text-muted mb-0">Belum ada artikel lainnya</p>
                        </div>
                    </li>
                    @endforelse
                </ul>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('berita.index') }}" class="btn btn-outline-primary rounded-pill px-4">
                    <i class="fas fa-arrow-left me-2"></i> Semua Berita
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    function copyLink() {
        const url = window.location.href;
        navigator.clipboard.writeText(url).then(() => {
            alert('Tautan berhasil disalin!');
        });
    }
</script>
@endsection