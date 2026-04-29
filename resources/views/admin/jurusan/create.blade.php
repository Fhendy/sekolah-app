@extends('layouts.admin')

@section('title', 'Tambah Jurusan - Admin Panel')

@section('header_title', 'Tambah Jurusan')
@section('header_subtitle', 'Buat program keahlian baru')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="data-table p-4">
            <form action="{{ route('admin.jurusan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label fw-semibold">Kode Jurusan <span class="text-danger">*</span></label>
                    <input type="text" name="kode" class="form-control-custom @error('kode') is-invalid @enderror" value="{{ old('kode') }}" required>
                    @error('kode')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Jurusan <span class="text-danger">*</span></label>
                    <input type="text" name="nama" class="form-control-custom @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Slug</label>
                    <input type="text" name="slug" class="form-control-custom" value="{{ old('slug') }}" placeholder="Akan otomatis terisi">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Ikon</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-laptop-code"></i></span>
                        <input type="text" name="ikon" class="form-control-custom" value="{{ old('ikon', 'fa-laptop-code') }}">
                    </div>
                    <small class="text-muted">Gunakan kelas Font Awesome, contoh: fa-laptop-code, fa-code, fa-database</small>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Logo Jurusan</label>
                    <input type="file" name="logo" class="form-control-custom" accept="image/*" id="logoInput">
                    <small class="text-muted">Format: JPG, PNG. Maksimal 1MB. Ukuran ideal: 200x200px</small>
                    <div id="logoPreview" class="mt-2" style="display: none;">
                        <img id="previewLogo" src="#" alt="Preview" style="height: 60px; width: auto;">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Brosur (PDF)</label>
                    <input type="file" name="brosur" class="form-control-custom" accept="application/pdf" id="brosurInput">
                    <small class="text-muted">Format: PDF. Maksimal 5MB</small>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Deskripsi <span class="text-danger">*</span></label>
                    <textarea name="deskripsi" class="form-control-custom @error('deskripsi') is-invalid @enderror" rows="6" required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="fas fa-save me-2"></i> Simpan
                    </button>
                    <a href="{{ route('admin.jurusan.index') }}" class="btn btn-outline-custom">
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
                <li>Kode jurusan harus unik (RPL, TKJ, MM, AKL, dll)</li>
                <li>Slug akan digunakan untuk URL (contoh: /jurusan/rpl)</li>
                <li>Ikon menggunakan Font Awesome 6 (free)</li>
                <li>Logo akan ditampilkan di halaman detail jurusan</li>
                <li>Brosur dapat diunduh oleh pengunjung</li>
            </ul>
        </div>
    </div>
</div>

<script>
    document.getElementById('logoInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('previewLogo').src = event.target.result;
                document.getElementById('logoPreview').style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection