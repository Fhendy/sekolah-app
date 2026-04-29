@extends('layouts.app')

@section('title', 'Sejarah Sekolah - SMK FH NUSANTARA')

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

    .sejarah-img {
        border-radius: 16px;
        width: 100%;
        height: auto;
        object-fit: cover;
    }

    @media (min-width: 992px) {
        .sejarah-img {
            height: 400px;
        }
    }

    @media (max-width: 767px) {
        .sejarah-img {
            height: 250px;
            margin-bottom: 1.5rem;
        }
    }

    .sejarah-text {
        font-size: 1rem;
        line-height: 1.7;
        color: #334155;
    }

    @media (max-width: 768px) {
        .sejarah-text {
            font-size: 0.9rem;
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
                    <i class="fas fa-history me-2"></i>Sejarah
                </div>
                <h1 class="hero-title mb-4">
                    Sejarah<br>
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
            <li class="breadcrumb-item active">Sejarah Sekolah</li>
        </ol>
    </nav>

    <div class="row align-items-center g-5">
        <div class="col-lg-6" data-aos="fade-right">
            <img src="{{ asset('images/gedung-smk.png') }}" alt="Gedung Sekolah" class="sejarah-img">
        </div>
        <div class="col-lg-6" data-aos="fade-left">
            <p class="sejarah-text">
                SMK FH NUSANTARA didirikan pada tahun 1998 dengan tujuan mencetak tenaga kerja profesional di bidang teknologi dan bisnis. Berawal dari 3 program keahlian dan 50 siswa, kini SMK FH NUSANTARA telah berkembang menjadi salah satu sekolah kejuruan terkemuka di wilayah ini.
            </p>
            <p class="sejarah-text mt-3">
                Dengan motto <strong>"Maju, Unggul, Berkarakter"</strong>, kami terus berkomitmen untuk memberikan pendidikan terbaik dengan kurikulum yang selalu diperbaharui sesuai kebutuhan industri.
            </p>
            <p class="sejarah-text mt-3">
                Hingga saat ini, SMK FH NUSANTARA telah meluluskan lebih dari 5.800 alumni yang tersebar di berbagai perusahaan ternama, baik di dalam maupun luar negeri.
            </p>
        </div>
    </div>
</div>
@endsection