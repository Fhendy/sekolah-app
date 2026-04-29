@extends('layouts.app')

@section('title', 'Struktur Organisasi - SMK FH NUSANTARA')

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

    .breadcrumb-custom .breadcrumb-item a {
        color: var(--primary);
        text-decoration: none;
    }

    /* Struktur Gambar */
    .struktur-img-container {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 1rem;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .struktur-img {
        width: 100%;
        height: auto;
        display: block;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .struktur-img-container {
            padding: 0.5rem;
            border-radius: 12px;
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
                    <i class="fas fa-sitemap me-2"></i>Struktur Organisasi
                </div>
                <h1 class="hero-title mb-4">
                    Struktur Organisasi<br>
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
            <li class="breadcrumb-item active">Struktur Organisasi</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-12" data-aos="fade-up">
            <div class="struktur-img-container">
                <img src="{{ asset('images/struktur-organisasi.png') }}" alt="Struktur Organisasi SMK FH NUSANTARA" class="struktur-img"
                     onerror="this.src='https://placehold.co/1200x800/e2e8f0/64748b?text=Struktur+Organisasi'; this.onerror=null;">
            </div>
        </div>
    </div>
</div>
@endsection