@extends('layouts.app')

@section('title', 'Fasilitas - SMK FH NUSANTARA')

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

    .fasilitas-card {
        text-align: center;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 1.5rem;
        transition: all 0.3s ease;
        background: white;
        height: 100%;
    }

    .fasilitas-card:hover {
        transform: translateY(-5px);
        border-color: #cbd5e1;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
    }

    .fasilitas-icon {
        width: 70px;
        height: 70px;
        background: rgba(37, 99, 235, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }

    .fasilitas-icon i {
        font-size: 2rem;
        color: var(--primary);
    }

    .fasilitas-card h5 {
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: #0f172a;
    }

    .fasilitas-card p {
        color: var(--gray);
        font-size: 0.85rem;
        margin: 0;
    }
</style>

<section class="hero-profil">
    <div class="hero-orb-1"></div>
    <div class="hero-orb-2"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12" data-aos="fade-up">
                <div class="badge text-white mb-4 d-inline-block">
                    <i class="fas fa-building me-2"></i>Sarana & Prasarana
                </div>
                <h1 class="hero-title mb-4">
                    Fasilitas<br>
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
            <li class="breadcrumb-item active">Fasilitas</li>
        </ol>
    </nav>

    <div class="row g-4">
        <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="100">
            <div class="fasilitas-card">
                <div class="fasilitas-icon">
                    <i class="fas fa-laptop-code"></i>
                </div>
                <h5>Lab. Komputer</h5>
                <p>3 Lab dengan 120 unit PC</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="200">
            <div class="fasilitas-card">
                <div class="fasilitas-icon">
                    <i class="fas fa-microscope"></i>
                </div>
                <h5>Lab. Sains</h5>
                <p>Peralatan lengkap</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="300">
            <div class="fasilitas-card">
                <div class="fasilitas-icon">
                    <i class="fas fa-futbol"></i>
                </div>
                <h5>Lapangan Olahraga</h5>
                <p>Multi-fungsi</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="400">
            <div class="fasilitas-card">
                <div class="fasilitas-icon">
                    <i class="fas fa-wifi"></i>
                </div>
                <h5>WiFi Gratis</h5>
                <p>Hotspot Area</p>
            </div>
        </div>
    </div>
</div>
@endsection