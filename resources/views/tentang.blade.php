@extends('layouts.app')

@section('title', 'Tentang SMK FH NUSANTARA - Sekolah Unggulan Berprestasi')

@section('content')
<style>
    :root {
        --primary: #2563eb;
        --primary-dark: #1d4ed8;
        --primary-light: #3b82f6;
        --gray: #64748b;
        --light-bg: #f8fafc;
    }

    /* Reset untuk semua device */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html, body {
        width: 100%;
        overflow-x: hidden;
    }

    /* Container Responsive */
    .container {
        width: 100%;
        max-width: 100%;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
    }

    /* Hero Section - Responsive */
    .hero-tentang {
        position: relative;
        display: flex;
        align-items: center;
        background: linear-gradient(135deg, #003f87 0%, #001f4d 100%);
        overflow: hidden;
        width: 100%;
    }

    /* Desktop */
    @media (min-width: 992px) {
        .hero-tentang {
            min-height: 60vh;
            padding-top: 80px;
        }
        .hero-title {
            font-size: 3rem;
        }
        .hero-subtitle {
            font-size: 1.1rem;
            max-width: 600px;
        }
        .container {
            max-width: 1140px;
        }
    }

    /* Tablet */
    @media (min-width: 768px) and (max-width: 991px) {
        .hero-tentang {
            min-height: 55vh;
            padding-top: 75px;
        }
        .hero-title {
            font-size: 2.5rem;
        }
        .hero-subtitle {
            font-size: 1rem;
            max-width: 500px;
        }
        .container {
            max-width: 720px;
        }
    }

    /* Mobile */
    @media (max-width: 767px) {
        .hero-tentang {
            min-height: 50vh;
            padding-top: 70px;
        }
        .hero-title {
            font-size: 2rem;
        }
        .hero-subtitle {
            font-size: 0.95rem;
            max-width: 100%;
        }
        .container {
            padding-left: 15px;
            padding-right: 15px;
        }
        .row {
            margin-left: -10px;
            margin-right: -10px;
        }
        [class*="col-"] {
            padding-left: 10px;
            padding-right: 10px;
        }
    }

    /* Mobile Kecil */
    @media (max-width: 480px) {
        .hero-tentang {
            min-height: 45vh;
            padding-top: 65px;
        }
        .hero-title {
            font-size: 1.8rem;
        }
        .hero-subtitle {
            font-size: 0.85rem;
        }
        .badge {
            font-size: 0.7rem;
            padding: 6px 14px;
        }
    }

    /* Decorative Orbs - Responsive */
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

    @media (max-width: 768px) {
        .hero-orb-1 {
            width: 200px;
            height: 200px;
            top: -60px;
            right: -60px;
        }
        .hero-orb-2 {
            width: 180px;
            height: 180px;
            bottom: -50px;
            left: -50px;
        }
    }

    .hero-tentang .container {
        position: relative;
        z-index: 2;
    }

    .hero-tentang .badge {
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
        word-wrap: break-word;
    }

    .hero-subtitle {
        color: rgba(255, 255, 255, 0.85);
        word-wrap: break-word;
    }

    /* Section Title */
    .section-title-center {
        text-align: center;
        margin-bottom: 3rem;
    }

    .section-title-center .subtitle {
        display: inline-block;
        background: rgba(37, 99, 235, 0.1);
        color: var(--primary);
        padding: 4px 16px;
        border-radius: 30px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .section-title-center h2 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: #0f172a;
    }

    .section-title-center .divider {
        width: 60px;
        height: 3px;
        background: var(--primary);
        margin: 1rem auto;
        border-radius: 2px;
    }

    .section-title-left {
        margin-bottom: 2rem;
    }

    .section-title-left .subtitle {
        display: inline-block;
        background: rgba(37, 99, 235, 0.1);
        color: var(--primary);
        padding: 4px 16px;
        border-radius: 30px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .section-title-left h2 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: #0f172a;
    }

    .section-title-left .divider {
        width: 60px;
        height: 3px;
        background: var(--primary);
        margin: 1rem 0;
        border-radius: 2px;
    }

    /* Responsive Section Title */
    @media (max-width: 768px) {
        .section-title-center h2 {
            font-size: 1.5rem;
        }
        .section-title-left h2 {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 480px) {
        .section-title-center h2 {
            font-size: 1.3rem;
        }
        .section-title-left h2 {
            font-size: 1.3rem;
        }
        .section-title-center .subtitle,
        .section-title-left .subtitle {
            font-size: 0.7rem;
        }
    }

    /* Cards */
    .card-custom {
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        transition: all 0.3s ease;
        background: white;
        height: 100%;
    }

    .card-custom:hover {
        transform: translateY(-5px);
        border-color: #cbd5e1;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
    }

    /* Visi Card */
    .visi-card {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        border-radius: 12px;
        padding: 2rem;
        color: white;
        height: 100%;
    }

    .visi-card p {
        font-size: 1rem;
        line-height: 1.7;
        margin: 0;
    }

    @media (max-width: 768px) {
        .visi-card {
            padding: 1.5rem;
        }
        .visi-card p {
            font-size: 0.9rem;
        }
    }

    /* Misi List */
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
        font-size: 1rem;
        margin-top: 3px;
        flex-shrink: 0;
    }

    @media (max-width: 768px) {
        .misi-list li {
            font-size: 0.85rem;
            gap: 10px;
        }
    }

    /* Struktur Organisasi */
    .struktur-card {
        text-align: center;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.5rem;
        transition: all 0.3s ease;
        background: white;
        height: 100%;
    }

    .struktur-card:hover {
        transform: translateY(-5px);
        border-color: #cbd5e1;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
    }

    .struktur-avatar {
        width: 80px;
        height: 80px;
        background: rgba(37, 99, 235, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }

    .struktur-avatar i {
        font-size: 2.5rem;
        color: var(--primary);
    }

    .struktur-card h5 {
        font-weight: 700;
        margin-bottom: 0.25rem;
        color: #0f172a;
    }

    .struktur-card p {
        color: var(--gray);
        font-size: 0.85rem;
        margin: 0;
    }

    @media (max-width: 768px) {
        .struktur-card {
            padding: 1rem;
        }
        .struktur-avatar {
            width: 70px;
            height: 70px;
        }
        .struktur-avatar i {
            font-size: 2rem;
        }
        .struktur-card h5 {
            font-size: 0.9rem;
        }
        .struktur-card p {
            font-size: 0.75rem;
        }
    }

    /* Sejarah Section */
    .sejarah-img {
        border-radius: 12px;
        width: 100%;
        height: auto;
        object-fit: cover;
    }

    @media (min-width: 992px) {
        .sejarah-img {
            height: 350px;
        }
    }

    @media (min-width: 768px) and (max-width: 991px) {
        .sejarah-img {
            height: 300px;
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

    /* Statistik Mini */
    .stat-mini {
        display: flex;
        gap: 2rem;
        margin-top: 2rem;
        flex-wrap: wrap;
    }

    .stat-mini-item {
        text-align: left;
    }

    .stat-mini-number {
        font-size: 2rem;
        font-weight: 800;
        color: var(--primary);
        line-height: 1;
    }

    .stat-mini-label {
        font-size: 0.85rem;
        color: var(--gray);
    }

    @media (max-width: 768px) {
        .stat-mini {
            gap: 1rem;
            justify-content: space-between;
        }
        .stat-mini-number {
            font-size: 1.5rem;
        }
        .stat-mini-label {
            font-size: 0.7rem;
        }
    }

    @media (max-width: 480px) {
        .stat-mini {
            gap: 0.5rem;
        }
        .stat-mini-number {
            font-size: 1.2rem;
        }
        .stat-mini-label {
            font-size: 0.6rem;
        }
    }

    /* Section Background */
    .section-bg-light {
        background: #f8fafc;
    }

    .section-bg-white {
        background: white;
    }

    /* Padding Responsive */
    .py-5 {
        padding-top: 3rem;
        padding-bottom: 3rem;
    }

    @media (max-width: 768px) {
        .py-5 {
            padding-top: 2rem;
            padding-bottom: 2rem;
        }
    }

    .g-5 {
        --bs-gutter-y: 3rem;
        --bs-gutter-x: 3rem;
    }

    @media (max-width: 768px) {
        .g-5 {
            --bs-gutter-y: 1.5rem;
            --bs-gutter-x: 1.5rem;
        }
    }

    .g-4 {
        --bs-gutter-y: 1.5rem;
        --bs-gutter-x: 1.5rem;
    }

    @media (max-width: 768px) {
        .g-4 {
            --bs-gutter-y: 1rem;
            --bs-gutter-x: 1rem;
        }
    }
</style>

<!-- Hero Section -->
<section class="hero-tentang">
    <div class="hero-orb-1"></div>
    <div class="hero-orb-2"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12" data-aos="fade-up" data-aos-duration="1000">
                <div class="badge text-white mb-4 d-inline-block">
                    <i class="fas fa-school me-2"></i>Sejak 1998
                </div>
                <h1 class="hero-title mb-4">
                    Tentang<br>
                    SMK FH NUSANTARA
                </h1>
                <p class="hero-subtitle mb-4">
                    Sekolah Kejuruan Terakreditasi A yang berkomitmen mencetak generasi unggul, berkarakter, dan siap bersaing di era global.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Sejarah Section -->
<div class="section-bg-white py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 col-md-12" data-aos="fade-right">
                <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=600&h=400&fit=crop" alt="Gedung Sekolah" class="sejarah-img">
            </div>
            <div class="col-lg-6 col-md-12" data-aos="fade-left">
                <div class="section-title-left">
                    <span class="subtitle">Sejarah</span>
                    <h2>Perjalanan SMK FH NUSANTARA</h2>
                    <div class="divider"></div>
                </div>
                <p class="sejarah-text">
                    SMK FH NUSANTARA didirikan pada tahun 1998 dengan tujuan mencetak tenaga kerja profesional di bidang teknologi dan bisnis. Berawal dari 3 program keahlian dan 50 siswa, kini SMK FH NUSANTARA telah berkembang menjadi salah satu sekolah kejuruan terkemuka di wilayah ini.
                </p>
                <p class="sejarah-text mt-3">
                    Dengan motto <strong>"Maju, Unggul, Berkarakter"</strong>, kami terus berkomitmen untuk memberikan pendidikan terbaik dengan kurikulum yang selalu diperbaharui sesuai kebutuhan industri.
                </p>
                <p class="sejarah-text mt-3">
                    Hingga saat ini, SMK FH NUSANTARA telah meluluskan lebih dari 5.800 alumni yang tersebar di berbagai perusahaan ternama, baik di dalam maupun luar negeri.
                </p>
                
                <div class="stat-mini">
                    <div class="stat-mini-item">
                        <div class="stat-mini-number">26+</div>
                        <div class="stat-mini-label">Tahun Berdiri</div>
                    </div>
                    <div class="stat-mini-item">
                        <div class="stat-mini-number">5.8k+</div>
                        <div class="stat-mini-label">Alumni</div>
                    </div>
                    <div class="stat-mini-item">
                        <div class="stat-mini-number">100+</div>
                        <div class="stat-mini-label">Partner Industri</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Visi & Misi Section -->
<div class="section-bg-light py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-5 col-md-12" data-aos="fade-right">
                <div class="visi-card">
                    <h3 class="fw-bold mb-3">Visi</h3>
                    <p>"Menjadi lembaga pendidikan kejuruan yang unggul dalam menghasilkan lulusan berkarakter, berdaya saing global, dan berwawasan lingkungan"</p>
                </div>
            </div>
            <div class="col-lg-7 col-md-12" data-aos="fade-left">
                <div class="card-custom p-4 h-100">
                    <h3 class="fw-bold mb-3" style="color: #0f172a;">Misi</h3>
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
</div>

<!-- Struktur Organisasi Section -->
<div class="section-bg-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title-center" data-aos="fade-up">
                    <span class="subtitle">Pengurus</span>
                    <h2>Struktur Organisasi</h2>
                    <div class="divider"></div>
                    <p class="text-muted">Pemimpin dan penggerak SMK FH NUSANTARA</p>
                </div>
            </div>
            
            <div class="col-md-4 col-sm-6 col-12" data-aos="fade-up" data-aos-delay="100">
                <div class="struktur-card">
                    <div class="struktur-avatar">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <h5>Drs. H. Ahmad Fauzi, M.Pd</h5>
                    <p>Kepala Sekolah</p>
                </div>
            </div>
            
            <div class="col-md-4 col-sm-6 col-12" data-aos="fade-up" data-aos-delay="200">
                <div class="struktur-card">
                    <div class="struktur-avatar">
                        <i class="fas fa-chalkboard-user"></i>
                    </div>
                    <h5>Dra. Siti Aminah, M.Si</h5>
                    <p>Wakil Kepala Sekolah Kurikulum</p>
                </div>
            </div>
            
            <div class="col-md-4 col-sm-6 col-12" data-aos="fade-up" data-aos-delay="300">
                <div class="struktur-card">
                    <div class="struktur-avatar">
                        <i class="fas fa-users"></i>
                    </div>
                    <h5>Bambang Priyono, S.Pd</h5>
                    <p>Wakil Kepala Sekolah Kesiswaan</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection