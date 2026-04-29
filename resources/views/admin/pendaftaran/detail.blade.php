@extends('layouts.admin')

@section('title', 'Detail Pendaftaran - Admin Panel')

@section('header_title', 'Detail Pendaftaran')
@section('header_subtitle', 'Informasi lengkap pendaftaran siswa')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="data-table p-4">
            <div class="row mb-3">
                <div class="col-md-6">
                    <small class="text-muted">Kode Pendaftaran</small>
                    <h5 class="fw-bold">{{ $pendaftaran->kode_pendaftaran }}</h5>
                </div>
                <div class="col-md-6">
                    <small class="text-muted">Status</small>
                    <div>
                        <span class="badge bg-{{ $pendaftaran->status == 'verified' ? 'success' : ($pendaftaran->status == 'pending' ? 'warning' : 'danger') }}">
                            {{ ucfirst($pendaftaran->status) }}
                        </span>
                    </div>
                </div>
            </div>
            <hr>
            <h6 class="fw-bold mb-3">Data Pribadi</h6>
            <div class="row mb-4">
                <div class="col-md-6 mb-2">
                    <small class="text-muted">Nama Lengkap</small>
                    <p class="fw-semibold">{{ $pendaftaran->nama_lengkap }}</p>
                </div>
                <div class="col-md-6 mb-2">
                    <small class="text-muted">Jenis Kelamin</small>
                    <p class="fw-semibold">{{ $pendaftaran->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                </div>
                <div class="col-md-6 mb-2">
                    <small class="text-muted">Tanggal Lahir</small>
                    <p class="fw-semibold">{{ $pendaftaran->tanggal_lahir->format('d F Y') }}</p>
                </div>
                <div class="col-md-6 mb-2">
                    <small class="text-muted">Kota/Kabupaten</small>
                    <p class="fw-semibold">{{ $pendaftaran->kota_kabupaten }}</p>
                </div>
                <div class="col-md-12 mb-2">
                    <small class="text-muted">Asal Sekolah</small>
                    <p class="fw-semibold">{{ $pendaftaran->asal_sekolah }}</p>
                </div>
            </div>

            <h6 class="fw-bold mb-3">Data Kontak</h6>
            <div class="row mb-4">
                <div class="col-md-6 mb-2">
                    <small class="text-muted">No. WhatsApp Siswa</small>
                    <p class="fw-semibold">{{ $pendaftaran->no_wa_siswa }}</p>
                </div>
                <div class="col-md-6 mb-2">
                    <small class="text-muted">No. WhatsApp Orang Tua</small>
                    <p class="fw-semibold">{{ $pendaftaran->no_wa_ortu }}</p>
                </div>
            </div>

            <h6 class="fw-bold mb-3">Data Pendidikan</h6>
            <div class="row mb-4">
                <div class="col-md-12 mb-2">
                    <small class="text-muted">Jurusan yang Dipilih</small>
                    <p class="fw-semibold">{{ $pendaftaran->jurusan }}</p>
                </div>
            </div>

            <hr>
            <div class="row">
                <div class="col-md-6">
                    <small class="text-muted">Tanggal Pendaftaran</small>
                    <p>{{ $pendaftaran->tanggal_daftar->format('d F Y H:i:s') }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="data-table p-4">
            <h6 class="fw-bold mb-3"><i class="fas fa-info-circle me-2"></i> Informasi</h6>
            <p class="small text-muted mb-0">
                <strong>Dibuat:</strong> {{ $pendaftaran->created_at->format('d M Y H:i') }}
            </p>
            <hr>
            <div class="d-grid gap-2">
                <a href="https://wa.me/{{ $pendaftaran->no_wa_siswa }}" target="_blank" class="btn btn-success">
                    <i class="fab fa-whatsapp me-2"></i> Hubungi Siswa
                </a>
                <a href="https://wa.me/{{ $pendaftaran->no_wa_ortu }}" target="_blank" class="btn btn-success">
                    <i class="fab fa-whatsapp me-2"></i> Hubungi Orang Tua
                </a>
                <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-outline-custom mt-2">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection