@extends('layouts.app')

@section('title', 'Agenda Sekolah - SMK FH NUSANTARA')

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

    /* Hero Section Agenda - Center */
    .hero-agenda {
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

    .hero-agenda .container {
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

    /* Agenda Card */
    .agenda-card {
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        overflow: hidden;
        background: white;
        transition: all 0.3s ease;
        margin-bottom: 1.25rem;
    }

    .agenda-card:hover {
        transform: translateY(-3px);
        border-color: #cbd5e1;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
    }

    .agenda-date-box {
        text-align: center;
        border-radius: 12px;
        padding: 12px 16px;
        min-width: 90px;
    }

    .agenda-date-day {
        font-size: 1.8rem;
        font-weight: 800;
        line-height: 1;
    }

    .agenda-date-month {
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .agenda-date-year {
        font-size: 0.7rem;
        opacity: 0.8;
    }

    .bg-status-upcoming {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }

    .bg-status-ongoing {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    }

    .bg-status-past {
        background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
    }

    .badge-status {
        padding: 6px 14px;
        border-radius: 30px;
        font-size: 0.7rem;
        font-weight: 600;
    }

    .badge-upcoming {
        background: #10b981;
        color: white;
    }

    .badge-ongoing {
        background: #f59e0b;
        color: white;
    }

    .badge-past {
        background: #6b7280;
        color: white;
    }

    /* Sidebar */
    .sidebar-card {
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        overflow: hidden;
        background: white;
        position: sticky;
        top: 100px;
    }

    .sidebar-header {
        background: linear-gradient(135deg, #003f87 0%, #001f4d 100%);
        padding: 1rem;
        text-align: center;
    }

    .sidebar-header h5 {
        color: white;
        margin: 0;
        font-weight: 600;
    }

    .upcoming-list {
        padding: 1rem;
    }

    .upcoming-item {
        display: flex;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid #e2e8f0;
    }

    .upcoming-item:last-child {
        border-bottom: none;
    }

    .upcoming-date {
        background: #f1f5f9;
        border-radius: 10px;
        text-align: center;
        padding: 8px 12px;
        min-width: 55px;
    }

    .upcoming-date-day {
        font-size: 1.1rem;
        font-weight: 800;
        color: #0f172a;
        line-height: 1;
    }

    .upcoming-date-month {
        font-size: 0.65rem;
        color: #64748b;
    }

    .upcoming-info h6 {
        font-size: 0.85rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
        color: #0f172a;
    }

    .upcoming-info p {
        font-size: 0.7rem;
        color: #64748b;
        margin: 0;
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
        .hero-agenda {
            min-height: 45vh;
        }
        .hero-title {
            font-size: 2rem;
        }
        .hero-subtitle {
            font-size: 0.9rem;
        }
        .agenda-date-box {
            min-width: 70px;
            padding: 8px 12px;
        }
        .agenda-date-day {
            font-size: 1.4rem;
        }
        .sidebar-card {
            position: relative;
            top: 0;
            margin-top: 1.5rem;
        }
    }
</style>

<!-- Hero Section Agenda - Center -->
<section class="hero-agenda">
    <div class="hero-orb-1"></div>
    <div class="hero-orb-2"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center" data-aos="fade-up" data-aos-duration="1000">
                <h1 class="hero-title">Agenda Sekolah</h1>
                <p class="hero-subtitle">Jadwal kegiatan dan acara penting SMK FH NUSANTARA</p>
            </div>
        </div>
    </div>
</section>

<!-- Agenda Section -->
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="breadcrumb-custom" data-aos="fade-up">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Agenda</li>
        </ol>
    </nav>

    <div class="row g-5">
        <!-- Kolom Kiri: Semua Agenda -->
        <div class="col-lg-8">
            <h3 class="fw-bold mb-4">Semua Agenda</h3>
            
            @if($agendas->count() > 0)
                @foreach($agendas as $agenda)
                <div class="agenda-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="agenda-date-box 
                                    @if($agenda->status == 'Akan Datang') bg-status-upcoming
                                    @elseif($agenda->status == 'Berlangsung') bg-status-ongoing
                                    @else bg-status-past
                                    @endif text-white">
                                    <div class="agenda-date-day">{{ $agenda->tanggal_mulai->format('d') }}</div>
                                    <div class="agenda-date-month">{{ $agenda->tanggal_mulai->format('M') }}</div>
                                    <div class="agenda-date-year">{{ $agenda->tanggal_mulai->format('Y') }}</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="d-flex flex-wrap justify-content-between align-items-start gap-2">
                                    <div>
                                        <h4 class="fw-bold mb-2">{{ $agenda->judul }}</h4>
                                        <div class="text-muted small mb-2">
                                            <i class="fas fa-clock me-1"></i> {{ $agenda->tanggal_mulai->format('H:i') }} - {{ $agenda->tanggal_selesai->format('H:i') }}
                                            <i class="fas fa-map-marker-alt ms-3 me-1"></i> {{ $agenda->tempat }}
                                        </div>
                                        <p class="mb-0">{{ Str::limit($agenda->deskripsi, 120) }}</p>
                                    </div>
                                    <span class="badge-status 
                                        @if($agenda->status == 'Akan Datang') badge-upcoming
                                        @elseif($agenda->status == 'Berlangsung') badge-ongoing
                                        @else badge-past
                                        @endif">
                                        {{ $agenda->status }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $agendas->links('pagination::bootstrap-4') }}
                </div>
            @else
            <!-- Empty State -->
            <div class="empty-state" data-aos="fade-up">
                <i class="fas fa-calendar-alt"></i>
                <h3>Belum Ada Agenda</h3>
                <p>Belum ada agenda yang dijadwalkan saat ini.</p>
            </div>
            @endif
        </div>

        <!-- Kolom Kanan: Agenda Mendatang -->
        <div class="col-lg-4">
            <div class="sidebar-card">
                <div class="sidebar-header">
                    <h5><i class="fas fa-calendar-week me-2"></i> Agenda Mendatang</h5>
                </div>
                <div class="upcoming-list">
                    @php
                        $upcomingAgendas = App\Models\Agenda::where('tanggal_mulai', '>=', now())
                            ->orderBy('tanggal_mulai', 'asc')
                            ->limit(5)
                            ->get();
                    @endphp
                    
                    @forelse($upcomingAgendas as $agenda)
                    <div class="upcoming-item">
                        <div class="upcoming-date">
                            <div class="upcoming-date-day">{{ $agenda->tanggal_mulai->format('d') }}</div>
                            <div class="upcoming-date-month">{{ $agenda->tanggal_mulai->format('M') }}</div>
                        </div>
                        <div class="upcoming-info">
                            <h6>{{ Str::limit($agenda->judul, 35) }}</h6>
                            <p><i class="fas fa-clock me-1"></i> {{ $agenda->tanggal_mulai->format('H:i') }} WIB</p>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-3">
                        <p class="text-muted mb-0">Tidak ada agenda mendatang</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection