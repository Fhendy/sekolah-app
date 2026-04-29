@extends('layouts.app')

@section('title', 'Guru & Karyawan - SMK FH NUSANTARA')

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

    .guru-card {
        text-align: center;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 1.25rem;
        transition: all 0.3s ease;
        background: white;
        height: 100%;
    }

    .guru-card:hover {
        transform: translateY(-5px);
        border-color: #cbd5e1;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
    }

    /* Foto Guru - Portrait ukuran sedang */
    .guru-img-wrapper {
        width: 120px;
        height: 160px;
        margin: 0 auto 1rem;
        overflow: hidden;
        border-radius: 12px;
    }

    .guru-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .guru-card:hover .guru-img {
        transform: scale(1.05);
    }

    /* Fallback jika tidak ada foto */
    .guru-icon {
        width: 120px;
        height: 160px;
        margin: 0 auto 1rem;
        background: linear-gradient(135deg, #003f87 0%, #001f4d 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .guru-icon i {
        font-size: 2.5rem;
        color: white;
    }

    .guru-card h5 {
        font-weight: 700;
        margin-bottom: 0.25rem;
        color: #0f172a;
        font-size: 0.95rem;
    }

    .guru-card p {
        color: var(--gray);
        font-size: 0.75rem;
        margin: 0;
        line-height: 1.4;
    }

    .guru-nip {
        font-size: 0.65rem;
        color: #94a3b8;
        margin-top: 0.25rem;
    }

    @media (max-width: 768px) {
        .guru-card {
            padding: 1rem;
        }
        .guru-img-wrapper, .guru-icon {
            width: 100px;
            height: 133px;
        }
        .guru-icon i {
            font-size: 2rem;
        }
        .guru-card h5 {
            font-size: 0.85rem;
        }
        .guru-card p {
            font-size: 0.7rem;
        }
        .guru-nip {
            font-size: 0.6rem;
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
                    <i class="fas fa-chalkboard-user me-2"></i>Tenaga Pendidik
                </div>
                <h1 class="hero-title mb-4">
                    Guru & Karyawan<br>
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
            <li class="breadcrumb-item active">Guru & Karyawan</li>
        </ol>
    </nav>

    <div class="row g-4">
        @forelse($guruList as $item)
        <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
            <div class="guru-card">
                @if($item->foto && file_exists(public_path('storage/' . $item->foto)))
                    <div class="guru-img-wrapper">
                        <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}" class="guru-img">
                    </div>
                @else
                    <div class="guru-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                @endif
                <h5>{{ Str::limit($item->nama, 25) }}</h5>
                <p>{{ $item->jabatan }}</p>
                @if($item->nip)
                    <div class="guru-nip">NIP. {{ $item->nip }}</div>
                @endif
            </div>
        </div>
        @empty
        <div class="col-12 text-center">
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i> Belum ada data guru & karyawan.
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection