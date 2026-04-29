@extends('layouts.app')

@section('title', 'Prestasi - SMK FH NUSANTARA')

@section('content')
<style>
    :root {
        --primary: #2563eb;
        --primary-dark: #1d4ed8;
        --primary-light: #3b82f6;
        --gray: #64748b;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html, body {
        width: 100%;
        overflow-x: hidden;
    }

    .hero-profil {
        position: relative;
        display: flex;
        align-items: center;
        background: linear-gradient(135deg, #003f87 0%, #001f4d 100%);
        overflow: hidden;
        width: 100%;
    }

    @media (min-width: 992px) {
        .hero-profil {
            min-height: 50vh;
            padding-top: 80px;
        }
        .hero-title {
            font-size: 3rem;
        }
        .container {
            max-width: 1140px;
        }
    }

    @media (max-width: 767px) {
        .hero-profil {
            min-height: 40vh;
            padding-top: 70px;
        }
        .hero-title {
            font-size: 2rem;
        }
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

    .hero-profil .container {
        position: relative;
        z-index: 2;
    }

    .hero-profil .badge {
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.2);
        padding: 8px 20px;
        border-radius: 30px;
        display: inline-block;
    }

    .hero-title {
        font-weight: 800;
        line-height: 1.2;
        color: white;
    }

    .breadcrumb-custom {
        background: transparent;
        padding: 1rem 0;
        margin-bottom: 1rem;
    }

    .prestasi-card {
        text-align: center;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 1.25rem;
        transition: all 0.3s ease;
        background: white;
        height: 100%;
    }

    .prestasi-card:hover {
        transform: translateY(-5px);
        border-color: #cbd5e1;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
    }

    /* Gambar Prestasi - Portrait ukuran sedang */
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

    /* Fallback jika tidak ada gambar */
    .prestasi-icon {
        width: 120px;
        height: 160px;
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
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 0.65rem;
        margin-top: 0.75rem;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .prestasi-card {
            padding: 1rem;
        }
        .prestasi-img-wrapper, .prestasi-icon {
            width: 100px;
            height: 133px;
        }
        .prestasi-icon i {
            font-size: 2rem;
        }
        .prestasi-card h5 {
            font-size: 0.85rem;
        }
        .prestasi-card p {
            font-size: 0.7rem;
        }
    }
</style>

<section class="hero-profil">
    <div class="hero-orb-1"></div>
    <div class="hero-orb-2"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12" data-aos="fade-up">
                <div class="badge text-white mb-4 d-inline-block">
                    <i class="fas fa-trophy me-2"></i>Pencapaian
                </div>
                <h1 class="hero-title mb-4">
                    Prestasi<br>
                    SMK FH NUSANTARA
                </h1>
            </div>
        </div>
    </div>
</section>

<div class="container py-5">
    <nav aria-label="breadcrumb" class="breadcrumb-custom">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Prestasi</li>
        </ol>
    </nav>

    <div class="row g-4">
        @forelse($prestasi as $item)
        <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
            <div class="prestasi-card">
                @if($item->gambar && file_exists(public_path('storage/' . $item->gambar)))
                    <div class="prestasi-img-wrapper">
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="prestasi-img">
                    </div>
                @else
                    <div class="prestasi-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                @endif
                <h5>{{ Str::limit($item->judul, 30) }}</h5>
                <p>{{ Str::limit($item->deskripsi, 60) }}</p>
                @if($item->tahun)
                    <div class="prestasi-tahun">{{ $item->tahun }}</div>
                @endif
            </div>
        </div>
        @empty
        <div class="col-12 text-center">
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i> Belum ada data prestasi.
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection