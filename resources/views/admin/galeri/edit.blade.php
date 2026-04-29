@extends('layouts.admin')

@section('title', 'Edit Galeri - Admin Panel')

@section('header_title', 'Edit Galeri')
@section('header_subtitle', 'Perbarui foto kegiatan')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="data-table p-4">
            <form action="{{ route('admin.galeri.update', $galeri) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label fw-semibold">Judul Foto <span class="text-danger">*</span></label>
                    <input type="text" name="judul" class="form-control-custom @error('judul') is-invalid @enderror" value="{{ old('judul', $galeri->judul) }}" required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control-custom" rows="3">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Gambar Saat Ini</label>
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $galeri->gambar) }}" width="200" class="rounded border">
                    </div>
                    <label class="form-label fw-semibold">Ganti Gambar</label>
                    <input type="file" name="gambar" class="form-control-custom" accept="image/*">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="fas fa-save me-2"></i> Update
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
            <h6 class="fw-bold mb-3"><i class="fas fa-info-circle me-2"></i> Informasi</h6>
            <p class="small text-muted mb-0">
                <strong>Dibuat:</strong> {{ $galeri->created_at->format('d M Y H:i') }}<br>
                <strong>Terakhir update:</strong> {{ $galeri->updated_at->format('d M Y H:i') }}
            </p>
        </div>
    </div>
</div>
@endsection