@extends('layouts.admin')

@section('title', 'Tambah Hero Slider - Admin Panel')

@section('header_title', 'Hero Slider')
@section('header_subtitle', 'Tambah slide banner baru')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Form Tambah Hero Slider</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.hero-slider.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row g-4">
                <!-- Gambar Desktop -->
                <div class="col-md-12">
                    <label class="form-label required">Gambar Desktop</label>
                    <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror" accept="image/*" required>
                    <small class="text-muted">Rekomendasi: 1920x1080px (Landscape), maks 2MB</small>
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Gambar Mobile (Opsional) -->
                <div class="col-md-12">
                    <label class="form-label">Gambar Mobile (Opsional)</label>
                    <input type="file" name="gambar_mobile" class="form-control @error('gambar_mobile') is-invalid @enderror" accept="image/*">
                    <small class="text-muted">Rekomendasi: 768x1024px (Portrait). Jika kosong, akan menggunakan gambar desktop</small>
                    @error('gambar_mobile')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Link (Opsional) -->
                <div class="col-md-12">
                    <label class="form-label">Link (Opsional)</label>
                    <input type="url" name="link" class="form-control @error('link') is-invalid @enderror" value="{{ old('link') }}" placeholder="https://... atau /halaman">
                    <small class="text-muted">Banner akan menjadi link jika diklik</small>
                    @error('link')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Urutan -->
                <div class="col-md-6">
                    <label class="form-label required">Urutan</label>
                    <input type="number" name="urutan" class="form-control @error('urutan') is-invalid @enderror" value="{{ old('urutan', 0) }}" required>
                    <small class="text-muted">Semakin kecil angka, semakin atas posisinya</small>
                    @error('urutan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Aktif -->
                <div class="col-md-6">
                    <div class="form-check mt-4">
                        <input class="form-check-input" type="checkbox" name="aktif" id="aktif" {{ old('aktif', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="aktif">
                            Aktifkan slide ini
                        </label>
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="fas fa-save me-2"></i> Simpan
                    </button>
                    <a href="{{ route('admin.hero-slider.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i> Kembali
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    .btn-primary-custom {
        background: linear-gradient(135deg, #003f87 0%, #001f4d 100%);
        color: white;
        border: none;
    }
    .btn-primary-custom:hover {
        background: linear-gradient(135deg, #004f9e 0%, #002a5c 100%);
        color: white;
    }
    .required:after {
        content: " *";
        color: #dc2626;
    }
</style>
@endsection