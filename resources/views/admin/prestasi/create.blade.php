@extends('layouts.admin')

@section('title', 'Tambah Prestasi - Admin Panel')

@section('header_title', 'Tambah Prestasi')
@section('header_subtitle', 'Tambah data prestasi baru')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="data-table p-4">
            <form action="{{ route('admin.prestasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label fw-semibold">Judul Prestasi <span class="text-danger">*</span></label>
                    <input type="text" name="judul" class="form-control-custom @error('judul') is-invalid @enderror" value="{{ old('judul') }}" required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kategori</label>
                            <input type="text" name="kategori" class="form-control-custom" value="{{ old('kategori') }}" placeholder="Contoh: Akademik, Non Akademik">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tingkat</label>
                            <input type="text" name="tingkat" class="form-control-custom" value="{{ old('tingkat') }}" placeholder="Contoh: Sekolah, Kabupaten, Provinsi, Nasional">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tahun</label>
                            <input type="text" name="tahun" class="form-control-custom" value="{{ old('tahun', date('Y')) }}" placeholder="Contoh: 2024">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Urutan Tampil</label>
                            <input type="number" name="urutan" class="form-control-custom" value="{{ old('urutan', 0) }}">
                            <small class="text-muted">Semakin kecil angka, semakin atas tampilannya</small>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control-custom" rows="4">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Gambar/Icon</label>
                    <input type="file" name="gambar" class="form-control-custom @error('gambar') is-invalid @enderror" accept="image/*" id="gambarInput">
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Format: JPG, PNG. Maksimal 2MB</small>
                    
                    <div id="imagePreview" class="mt-2" style="display: none;">
                        <img id="previewImg" src="#" alt="Preview" style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-control-custom">
                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="fas fa-save me-2"></i> Simpan
                    </button>
                    <a href="{{ route('admin.prestasi.index') }}" class="btn btn-outline-custom">
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
                <li>Isi judul prestasi dengan jelas</li>
                <li>Gambar akan ditampilkan sebagai icon prestasi</li>
                <li>Status "Nonaktif" tidak akan ditampilkan di website</li>
                <li>Urutan tampil menentukan posisi di halaman depan</li>
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
</script>
@endsection