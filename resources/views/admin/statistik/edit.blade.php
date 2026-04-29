@extends('layouts.admin')

@section('title', 'Edit Statistik - Admin Panel')

@section('header_title', 'Statistik')
@section('header_subtitle', 'Kelola data statistik website')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="data-table p-4">
            <form action="{{ route('admin.statistik.update') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jumlah Siswa</label>
                            <input type="number" name="jumlah_siswa" class="form-control-custom" value="{{ old('jumlah_siswa', $statistik->jumlah_siswa ?? 1250) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jumlah Alumni</label>
                            <input type="number" name="jumlah_alumni" class="form-control-custom" value="{{ old('jumlah_alumni', $statistik->jumlah_alumni ?? 5800) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jumlah Guru</label>
                            <input type="number" name="jumlah_guru" class="form-control-custom" value="{{ old('jumlah_guru', $statistik->jumlah_guru ?? 85) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tahun Berdiri</label>
                            <input type="number" name="tahun_berdiri" class="form-control-custom" value="{{ old('tahun_berdiri', $statistik->tahun_berdiri ?? 1998) }}" required>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="fas fa-save me-2"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-custom">
                        <i class="fas fa-arrow-left me-2"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-4">
        <div class="data-table p-4">
            <h6 class="fw-bold mb-3"><i class="fas fa-info-circle me-2"></i> Informasi</h6>
            <p class="small text-muted">
                Statistik ini akan ditampilkan di halaman utama (beranda) website.
            </p>
            <hr>
            <h6 class="fw-bold mb-2">Data Saat Ini:</h6>
            <ul class="small text-muted">
                <li>Siswa: {{ number_format($statistik->jumlah_siswa ?? 1250) }}</li>
                <li>Alumni: {{ number_format($statistik->jumlah_alumni ?? 5800) }}</li>
                <li>Guru: {{ number_format($statistik->jumlah_guru ?? 85) }}</li>
                <li>Tahun Berdiri: {{ $statistik->tahun_berdiri ?? 1998 }}</li>
            </ul>
        </div>
    </div>
</div>
@endsection