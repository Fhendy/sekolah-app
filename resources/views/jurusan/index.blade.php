    @extends('layouts.app')

    @section('title', 'Program Keahlian - SMK FH NUSANTARA')

    @section('content')
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: #3b82f6;
            --gray: #64748b;
            --light-bg: #f8fafc;
        }

    /* Hero Section - Hanya Warna Biru Gradient */
    .hero-jurusan {
        position: relative;
        min-height: 60vh;
        display: flex;
        align-items: center;
        background: linear-gradient(135deg, #003f87 0%, #001f4d 100%);
        overflow: hidden;
        padding-top: 80px; /* Tambahkan padding-top untuk menghindari navbar */
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-jurusan {
            min-height: 50vh;
            padding-top: 70px; /* Padding lebih kecil di mobile */
        }
        .hero-title {
            font-size: 2rem;
        }
        .hero-subtitle {
            font-size: 1rem;
        }
    }

        /* Decorative Orbs */
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

        .hero-jurusan .container {
            position: relative;
            z-index: 2;
        }

        .hero-jurusan .badge {
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

        /* Jurusan Cards - Seluruh Card Bisa Diklik */
        .jurusan-card {
            display: block;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
            text-decoration: none;
            color: inherit;
            height: 100%;
        }

        .jurusan-card:hover {
            transform: translateY(-5px);
            border-color: #cbd5e1;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
            text-decoration: none;
        }

        .jurusan-header {
            background: linear-gradient(135deg, #003f87 0%, #001f4d 100%);
            padding: 2rem;
            text-align: center;
            color: white;
        }

        .jurusan-header i {
            font-size: 3rem;
        }

        .jurusan-body {
            padding: 1.5rem;
            text-align: center;
        }

        .jurusan-body h3 {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #0f172a;
        }

        .jurusan-code {
            display: inline-block;
            background: #e0e7ff;
            color: var(--primary);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .jurusan-body p {
            color: #64748b;
            font-size: 0.85rem;
            line-height: 1.6;
            margin-bottom: 0;
        }

        /* CTA Bantuan Section - Full Width Tanpa Border */
        .cta-bantuan {
            background: linear-gradient(135deg, #003f87 0%, #001f4d 100%);
            padding: 4rem 0;
            text-align: center;
        }

        .cta-bantuan h3 {
            font-size: 1.75rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.5rem;
        }

        .cta-bantuan p {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 1.5rem;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-cta {
            display: inline-block;
            background: white;
            border: none;
            color: #003f87;
            padding: 12px 32px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .btn-cta:hover {
            background: rgba(255, 255, 255, 0.9);
            transform: translateY(-2px);
            text-decoration: none;
            color: #003f87;
        }

        /* Section Background */
        .section-bg-light {
            background: #f8fafc;
        }

        .section-bg-white {
            background: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-jurusan {
                min-height: 50vh;
            }
            .hero-title {
                font-size: 2rem;
            }
            .hero-subtitle {
                font-size: 1rem;
            }
            .section-title-center h2 {
                font-size: 1.5rem;
            }
            .cta-bantuan {
                padding: 2.5rem 1rem;
            }
            .cta-bantuan h3 {
                font-size: 1.25rem;
            }
        }
    </style>

    <!-- Hero Section - Hanya Warna Biru Gradient -->
    <section class="hero-jurusan">
        <div class="hero-orb-1"></div>
        <div class="hero-orb-2"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-7" data-aos="fade-up" data-aos-duration="1000">
                    <div class="badge text-white mb-4 d-inline-block">
                        <i class="fas fa-graduation-cap me-2"></i>Program Unggulan
                    </div>
                    <h1 class="hero-title mb-4">
                        Program<br>
                        Keahlian
                    </h1>
                    <p class="hero-subtitle mb-4">
                        SMK FH NUSANTARA memiliki 4 program keahlian unggulan yang siap mencetak lulusan kompeten dan siap bersaing di dunia industri.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Pilihan Program -->
    <div class="section-bg-white py-5">
        <div class="container">
            <div class="section-title-center" data-aos="fade-up">
                <span class="subtitle">Pilihan Program</span>
                <h2>Temukan Keahlian Anda</h2>
                <div class="divider"></div>
                <p class="text-muted">Klik card untuk mempelajari lebih lanjut tentang program keahlian</p>
            </div>

            <div class="row g-4">
                @forelse($jurusans as $index => $jurusan)
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <a href="{{ route('jurusan.show', $jurusan) }}" class="jurusan-card">
                        <div class="jurusan-header">
                            <i class="fas {{ $jurusan->ikon ?? 'fa-laptop-code' }}"></i>
                        </div>
                        <div class="jurusan-body">
                            <h3>{{ $jurusan->nama }}</h3>
                            <span class="jurusan-code">{{ $jurusan->kode }}</span>
                            <p>{{ Str::limit($jurusan->deskripsi, 100) }}</p>
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Belum ada data jurusan</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Section Butuh Bantuan - Full Width Tanpa Border -->
    <section class="cta-bantuan">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center" data-aos="fade-up">
                    <h3>Butuh Bantuan?</h3>
                    <p>Belum yakin pilih jurusan? Konsultasikan pilihan jurusan Anda dengan tim kami. Kami siap membimbing Anda menemukan program yang tepat.</p>
                    <a href="{{ route('kontak') }}" class="btn-cta">
                        Hubungi Kami <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endsection