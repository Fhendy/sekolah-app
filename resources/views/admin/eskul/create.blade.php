@extends('layouts.admin')

@section('title', 'Tambah Ekstrakurikuler - Admin Panel')

@section('header_title', 'Tambah Ekstrakurikuler')
@section('header_subtitle', 'Buat kegiatan ekstrakurikuler baru')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="data-table p-4">
            <form action="{{ route('admin.eskul.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Ekstrakurikuler <span class="text-danger">*</span></label>
                    <input type="text" name="nama" class="form-control-custom @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Pembina</label>
                    <input type="text" name="pembina" class="form-control-custom" value="{{ old('pembina') }}">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jadwal</label>
                            <input type="text" name="jadwal" class="form-control-custom" value="{{ old('jadwal') }}" placeholder="Contoh: Setiap Jumat, 14:00-16:00">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tempat</label>
                            <input type="text" name="tempat" class="form-control-custom" value="{{ old('tempat') }}" placeholder="Contoh: Lapangan Basket">
                        </div>
                    </div>
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
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control-custom" rows="6">{{ old('deskripsi') }}</textarea>
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
                    <a href="{{ route('admin.eskul.index') }}" class="btn btn-outline-custom">
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
                <li>Nama ekstrakurikuler harus unik</li>
                <li>Gambar akan ditampilkan sebagai thumbnail</li>
                <li>Deskripsi dapat diisi dengan kegiatan yang dilakukan</li>
                <li>Status "Nonaktif" tidak akan ditampilkan di website</li>
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
    
    document.querySelector('input[name="nama"]').addEventListener('keyup', function() {
        // Auto generate slug jika diperlukan
    });
</script>
@endsection