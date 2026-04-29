@extends('layouts.app')

@section('title', 'Visi dan Misi - SMK FH NUSANTARA')

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

    .visi-card {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        border-radius: 16px;
        padding: 2rem;
        color: white;
        height: 100%;
    }

    .visi-card p {
        font-size: 1.1rem;
        line-height: 1.7;
        margin: 0;
    }

    .misi-card {
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 2rem;
        background: white;
        height: 100%;
    }

    .misi-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .misi-list li {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid #e2e8f0;
        color: #334155;
        line-height: 1.5;
    }

    .misi-list li:last-child {
        border-bottom: none;
    }

    .misi-list li i {
        color: var(--primary);
        font-size: 1.1rem;
        margin-top: 3px;
    }

    @media (max-width: 768px) {
        .visi-card p {
            font-size: 0.9rem;
        }
        .misi-list li {
            font-size: 0.85rem;
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
                    <i class="fas fa-eye me-2"></i>Visi & Misi
                </div>
                <h1 class="hero-title mb-4">
                    Visi dan Misi<br>
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
            <li class="breadcrumb-item active">Visi dan Misi</li>
        </ol>
    </nav>

    <div class="row g-4">
        <div class="col-lg-5" data-aos="fade-right">
            <div class="visi-card">
                <h3 class="fw-bold mb-3">Visi</h3>
                <p>"Menjadi lembaga pendidikan kejuruan yang unggul dalam menghasilkan lulusan berkarakter, berdaya saing global, dan berwawasan lingkungan"</p>
            </div>
        </div>
        <div class="col-lg-7" data-aos="fade-left">
            <div class="misi-card">
                <h3 class="fw-bold mb-3">Misi</h3>
                <ul class="misi-list">
                    <li><i class="fas fa-check-circle"></i> Menyelenggarakan pendidikan vokasi yang berkualitas dan relevan dengan dunia industri</li>
                    <li><i class="fas fa-check-circle"></i> Mengembangkan karakter siswa yang beriman, jujur, disiplin, dan bertanggung jawab</li>
                    <li><i class="fas fa-check-circle"></i> Membekali siswa dengan keterampilan soft skill dan hard skill yang mumpuni</li>
                    <li><i class="fas fa-check-circle"></i> Menjalin kerjasama dengan DU/DI untuk program magang dan penyerapan tenaga kerja</li>
                    <li><i class="fas fa-check-circle"></i> Menumbuhkan jiwa kewirausahaan dan kreativitas siswa</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection