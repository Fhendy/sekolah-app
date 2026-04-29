@extends('layouts.app')

@section('title', 'Galeri Kegiatan - SMK FH NUSANTARA')

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

    /* Hero Section Galeri - Center */
    .hero-galeri {
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

    .hero-galeri .container {
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

    /* Gallery Card */
    .galeri-card {
        display: block;
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        overflow: hidden;
        background: white;
        text-decoration: none;
        color: inherit;
        cursor: pointer;
    }

    .galeri-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
        border-color: #cbd5e1;
    }

    .galeri-img {
        height: 250px;
        width: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .galeri-card:hover .galeri-img {
        transform: scale(1.03);
    }

    .galeri-img-wrapper {
        overflow: hidden;
        position: relative;
    }

    .galeri-body {
        padding: 1rem;
    }

    .galeri-title {
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
        color: #0f172a;
    }

    .galeri-desc {
        font-size: 0.8rem;
        color: #64748b;
        margin: 0;
    }

    /* Modal */
    .modal-content {
        border: none;
        border-radius: 20px;
        overflow: hidden;
    }

    .modal-body {
        padding: 0;
    }

    .modal-img {
        width: 100%;
        max-height: 70vh;
        object-fit: contain;
        background: #f8fafc;
    }

    .modal-info {
        padding: 1.25rem;
    }

    .modal-info h5 {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: #0f172a;
    }

    .modal-info p {
        font-size: 0.9rem;
        color: #64748b;
        margin: 0;
    }

    .btn-close-custom {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        border-radius: 50%;
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10;
        transition: all 0.2s ease;
    }

    .btn-close-custom:hover {
        background: rgba(0, 0, 0, 0.7);
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

    .pagination .page-item .page-link:hover {
        background: var(--primary-light);
        border-color: var(--primary-light);
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

    .empty-state h3 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #0f172a;
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        color: #64748b;
    }

    /* Responsive */
    @media (max-width: 768px) {
        :root {
            --navbar-height: 70px;
        }
        .hero-galeri {
            min-height: 45vh;
        }
        .hero-title {
            font-size: 2rem;
        }
        .hero-subtitle {
            font-size: 0.9rem;
        }
        .galeri-img {
            height: 200px;
        }
        .modal-img {
            max-height: 50vh;
        }
    }
</style>

<!-- Hero Section Galeri - Center -->
<section class="hero-galeri">
    <div class="hero-orb-1"></div>
    <div class="hero-orb-2"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center" data-aos="fade-up" data-aos-duration="1000">
                <h1 class="hero-title">Galeri Kegiatan</h1>
                <p class="hero-subtitle">Dokumentasi kegiatan dan prestasi SMK FH NUSANTARA</p>
            </div>
        </div>
    </div>
</section>

<!-- Galeri Section -->
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="breadcrumb-custom" data-aos="fade-up">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Galeri</li>
        </ol>
    </nav>

    @if($galeris->count() > 0)
    <div class="row g-4">
        @foreach($galeris as $index => $galeri)
        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($index % 6) * 100 }}">
            <div class="galeri-card" data-bs-toggle="modal" data-bs-target="#galleryModal{{ $galeri->id }}">
                <div class="galeri-img-wrapper">
                    <img src="{{ asset('storage/' . $galeri->gambar) }}" class="galeri-img" alt="{{ $galeri->judul }}">
                </div>
                <div class="galeri-body">
                    <h5 class="galeri-title">{{ Str::limit($galeri->judul, 50) }}</h5>
                    @if($galeri->deskripsi)
                    <p class="galeri-desc">{{ Str::limit($galeri->deskripsi, 70) }}</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="galleryModal{{ $galeri->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                    <div class="modal-body">
                        <img src="{{ asset('storage/' . $galeri->gambar) }}" class="modal-img" alt="{{ $galeri->judul }}">
                        <div class="modal-info">
                            <h5>{{ $galeri->judul }}</h5>
                            @if($galeri->deskripsi)
                            <p>{{ $galeri->deskripsi }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-5">
        {{ $galeris->links('pagination::bootstrap-4') }}
    </div>
    @else
    <!-- Empty State -->
    <div class="empty-state" data-aos="fade-up">
        <i class="fas fa-images"></i>
        <h3>Belum Ada Galeri</h3>
        <p>Belum ada foto kegiatan yang diupload.</p>
    </div>
    @endif
</div>
@endsection