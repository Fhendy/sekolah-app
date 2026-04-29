@extends('layouts.admin')

@section('title', 'Tambah Galeri - Admin Panel')

@section('header_title', 'Tambah Galeri')
@section('header_subtitle', 'Upload foto kegiatan baru')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="data-table p-4">
            <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label fw-semibold">Judul Foto <span class="text-danger">*</span></label>
                    <input type="text" name="judul" class="form-control-custom @error('judul') is-invalid @enderror" value="{{ old('judul') }}" required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control-custom" rows="3">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Gambar <span class="text-danger">*</span></label>
                    <input type="file" name="gambar" class="form-control-custom @error('gambar') is-invalid @enderror" accept="image/*" required>
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Format: JPG, PNG, JPEG. Maksimal 2MB</small>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="fas fa-upload me-2"></i> Upload
                    </button>
                    <a href="{{ route('admin.galeri.index') }}" class="btn btn-outline-custom">
                        <i class="fas fa-arrow-left me-2"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-4">
        <div class="data-table p-4">
            <h6 class="fw-bold mb-3"><i class="fas fa-info-circle me-2"></i> Petunjuk</h6>
            <ul class="small text-muted ps-3">
                <li>Gunakan foto dengan resolusi baik</li>
                <li>Foto akan ditampilkan di galeri website</li>
                <li>Deskripsi bersifat opsional</li>
            </ul>
        </div>
    </div>
</div>
@endsection