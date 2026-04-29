@extends('layouts.admin')

@section('title', 'Dashboard - Admin Panel')

@section('header_title', 'Dashboard')
@section('header_subtitle', 'Selamat datang di panel administrasi')

@section('content')
<style>
    /* Minimalis Dashboard Styles */
    .stat-card-mini {
        background: white;
        border-radius: 12px;
        padding: 1.25rem;
        border: 1px solid #e2e8f0;
        transition: all 0.2s ease;
    }
    
    .stat-card-mini:hover {
        border-color: #cbd5e1;
        transform: translateY(-2px);
    }
    
    .stat-icon-mini {
        width: 40px;
        height: 40px;
        background: #f1f5f9;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .stat-icon-mini i {
        font-size: 1.2rem;
        color: #2563eb;
    }
    
    .stat-number {
        font-size: 1.8rem;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.2;
    }
    
    .stat-label {
        font-size: 0.75rem;
        color: #64748b;
        margin-top: 0.25rem;
    }
    
    .section-card {
        background: white;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }
    
    .section-header {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid #e2e8f0;
        background: #fafbfc;
    }
    
    .section-header h6 {
        font-size: 0.85rem;
        font-weight: 600;
        margin: 0;
        color: #0f172a;
    }
    
    .list-item {
        padding: 0.9rem 1.25rem;
        border-bottom: 1px solid #f1f5f9;
        transition: background 0.2s;
    }
    
    .list-item:last-child {
        border-bottom: none;
    }
    
    .list-item:hover {
        background: #fafbfc;
    }
    
    .item-title {
        font-size: 0.85rem;
        font-weight: 600;
        color: #0f172a;
        text-decoration: none;
    }
    
    .item-title:hover {
        color: #2563eb;
    }
    
    .item-meta {
        font-size: 0.7rem;
        color: #94a3b8;
        margin-top: 0.25rem;
    }
    
    .badge-mini {
        padding: 0.2rem 0.6rem;
        font-size: 0.65rem;
        font-weight: 500;
        border-radius: 20px;
    }
    
    .badge-draft {
        background: #f1f5f9;
        color: #475569;
    }
    
    .badge-upcoming {
        background: #dcfce7;
        color: #166534;
    }
    
    .badge-ongoing {
        background: #fed7aa;
        color: #9a3412;
    }
    
    .badge-past {
        background: #f1f5f9;
        color: #475569;
    }
    
    .empty-state {
        padding: 2rem;
        text-align: center;
        color: #94a3b8;
        font-size: 0.8rem;
    }
    
    @media (max-width: 768px) {
        .stat-number {
            font-size: 1.4rem;
        }
        .list-item {
            padding: 0.75rem 1rem;
        }
    }
</style>

<!-- Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3 col-6">
        <div class="stat-card-mini">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-number">{{ $totalBerita ?? 0 }}</div>
                    <div class="stat-label">Total Berita</div>
                </div>
                <div class="stat-icon-mini">
                    <i class="fas fa-newspaper"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="stat-card-mini">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-number">{{ $totalJurusan ?? 0 }}</div>
                    <div class="stat-label">Total Jurusan</div>
                </div>
                <div class="stat-icon-mini">
                    <i class="fas fa-graduation-cap"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="stat-card-mini">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-number">{{ $totalGaleri ?? 0 }}</div>
                    <div class="stat-label">Total Galeri</div>
                </div>
                <div class="stat-icon-mini">
                    <i class="fas fa-images"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="stat-card-mini">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-number">{{ $totalAgenda ?? 0 }}</div>
                    <div class="stat-label">Total Agenda</div>
                </div>
                <div class="stat-icon-mini">
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Content -->
<div class="row g-3">
    <div class="col-md-6">
        <div class="section-card">
            <div class="section-header">
                <h6><i class="fas fa-newspaper me-2"></i> Berita Terbaru</h6>
            </div>
            <div>
                @if(isset($recentBerita) && $recentBerita->count() > 0)
                    @foreach($recentBerita as $berita)
                    <div class="list-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <a href="{{ route('admin.berita.edit', $berita) }}" class="item-title">
                                    {{ Str::limit($berita->judul, 55) }}
                                </a>
                                <div class="item-meta">
                                    <i class="far fa-calendar-alt me-1"></i> {{ $berita->created_at->format('d M Y') }}
                                    <span class="mx-1">•</span>
                                    <i class="far fa-user me-1"></i> {{ $berita->penulis }}
                                </div>
                            </div>
                            <span class="badge-mini badge-draft ms-2">Draft</span>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <i class="fas fa-newspaper mb-2 d-block"></i>
                        <span>Belum ada berita</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="section-card">
            <div class="section-header">
                <h6><i class="fas fa-calendar-alt me-2"></i> Agenda Mendatang</h6>
            </div>
            <div>
                @if(isset($upcomingAgenda) && $upcomingAgenda->count() > 0)
                    @foreach($upcomingAgenda as $agenda)
                    <div class="list-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="item-title">{{ Str::limit($agenda->judul, 50) }}</div>
                                <div class="item-meta">
                                    <i class="far fa-calendar-alt me-1"></i> {{ $agenda->tanggal_mulai->format('d M Y H:i') }}
                                    <span class="mx-1">•</span>
                                    <i class="fas fa-map-marker-alt me-1"></i> {{ $agenda->tempat }}
                                </div>
                            </div>
                            <span class="badge-mini 
                                @if($agenda->status == 'Akan Datang') badge-upcoming
                                @elseif($agenda->status == 'Berlangsung') badge-ongoing
                                @else badge-past
                                @endif ms-2">
                                {{ $agenda->status }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <i class="fas fa-calendar-alt mb-2 d-block"></i>
                        <span>Tidak ada agenda mendatang</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection