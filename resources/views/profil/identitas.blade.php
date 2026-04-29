@extends('layouts.app')

@section('title', 'Identitas Sekolah - SMK FH NUSANTARA')

@section('content')
<style>
    :root {
        --primary: #2563eb;
        --primary-dark: #1d4ed8;
        --primary-light: #3b82f6;
        --gray: #64748b;
        --light-bg: #f8fafc;
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

    .container {
        width: 100%;
        max-width: 100%;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
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

    @media (min-width: 768px) and (max-width: 991px) {
        .hero-profil {
            min-height: 45vh;
            padding-top: 75px;
        }
        .hero-title {
            font-size: 2.5rem;
        }
        .container {
            max-width: 720px;
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
        .container {
            padding-left: 15px;
            padding-right: 15px;
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
        font-size: 0.85rem;
        font-weight: 500;
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

    .info-card {
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 1.5rem;
        background: white;
        transition: all 0.3s ease;
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

    @media (max-width: 768px) {
        .info-card {
            padding: 1rem;
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
                    <i class="fas fa-building me-2"></i>Profil Sekolah
                </div>
                <h1 class="hero-title mb-4">
                    Identitas<br>
                    SMK FH NUSANTARA
                </h1>
                <p class="hero-subtitle mb-4">
                    Informasi lengkap tentang identitas sekolah kami.
                </p>
            </div>
        </div>
    </div>
</section>

<div class="container py-5">
    <nav aria-label="breadcrumb" class="breadcrumb-custom">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Identitas Sekolah</li>
        </ol>
    </nav>

    <div class="row g-4">
        <div class="col-lg-4 col-md-6">
            <div class="info-card">
                <div class="info-icon">
                    <i class="fas fa-school"></i>
                </div>
                <h4 class="fw-bold">Nama Sekolah</h4>
                <p class="text-muted">SMK FH NUSANTARA</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="info-card">
                <div class="info-icon">
                    <i class="fas fa-hashtag"></i>
                </div>
                <h4 class="fw-bold">NPSN</h4>
                <p class="text-muted">12345678</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="info-card">
                <div class="info-icon">
                    <i class="fas fa-star"></i>
                </div>
                <h4 class="fw-bold">Akreditasi</h4>
                <p class="text-muted">A (Unggul)</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="info-card">
                <div class="info-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <h4 class="fw-bold">Tahun Berdiri</h4>
                <p class="text-muted">1998</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="info-card">
                <div class="info-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h4 class="fw-bold">Alamat</h4>
                <p class="text-muted">Jl. Pendidikan No. 123, Kota Maju, Indonesia</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="info-card">
                <div class="info-icon">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <h4 class="fw-bold">Kontak</h4>
                <p class="text-muted">(021) 1234-5678</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="info-card">
                <div class="info-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <h4 class="fw-bold">Email</h4>
                <p class="text-muted">info@smkfhnusantara.sch.id</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="info-card">
                <div class="info-icon">
                    <i class="fas fa-globe"></i>
                </div>
                <h4 class="fw-bold">Website</h4>
                <p class="text-muted">www.smkfhnusantara.sch.id</p>
            </div>
        </div>
    </div>
</div>
@endsection