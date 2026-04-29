@extends('layouts.admin')

@section('title', 'Tambah Berita - Admin Panel')

@section('header_title', 'Tambah Berita')
@section('header_subtitle', 'Buat artikel berita baru')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="data-table p-4">
            <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label fw-semibold">Judul Berita <span class="text-danger">*</span></label>
                    <input type="text" name="judul" class="form-control-custom @error('judul') is-invalid @enderror" value="{{ old('judul') }}" required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Slug</label>
                    <input type="text" name="slug" class="form-control-custom" value="{{ old('slug') }}" placeholder="Akan otomatis terisi">
                    <small class="text-muted">Biarkan kosong untuk otomatis terisi</small>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Gambar</label>
                    <input type="file" name="gambar" class="form-control-custom @error('gambar') is-invalid @enderror" accept="image/*" id="gambarInput">
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Format: JPG, PNG, JPEG. Maksimal 2MB</small>
                    
                    <div id="imagePreview" class="mt-2" style="display: none;">
                        <img id="previewImg" src="#" alt="Preview" style="max-width: 200px; border-radius: 8px; border: 1px solid #ddd;">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Penulis</label>
                    <input type="text" name="penulis" class="form-control-custom" value="{{ old('penulis', Auth::user()->name ?? 'Admin') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Tanggal <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal" class="form-control-custom" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Konten <span class="text-danger">*</span></label>
                    <textarea name="konten" class="form-control-custom" rows="10" required>{{ old('konten') }}</textarea>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="fas fa-save me-2"></i> Simpan
                    </button>
                    <a href="{{ route('admin.berita.index') }}" class="btn btn-outline-custom">
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
                <li>Judul berita harus unik dan deskriptif</li>
                <li>Gambar akan ditampilkan sebagai thumbnail</li>
                <li>Konten mendukung HTML dasar</li>
                <li>Tanggal akan ditampilkan di halaman berita</li>
            </ul>
        </div>
    </div>
</div>

<script>
    document.getElementById('gambarInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('previewImg').src = event.target.result;
                document.getElementById('imagePreview').style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });
    
    document.querySelector('input[name="judul"]').addEventListener('keyup', function() {
        let slugInput = document.querySelector('input[name="slug"]');
        if (slugInput.value === '') {
            slugInput.value = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-');
        }
    });
</script>
@endsection