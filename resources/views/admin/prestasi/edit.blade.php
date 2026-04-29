@extends('layouts.admin')

@section('title', 'Edit Prestasi - Admin Panel')

@section('header_title', 'Edit Prestasi')
@section('header_subtitle', 'Perbarui data prestasi')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="data-table p-4">
            <form action="{{ route('admin.prestasi.update', $prestasi->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label fw-semibold">Judul Prestasi <span class="text-danger">*</span></label>
                    <input type="text" name="judul" class="form-control-custom @error('judul') is-invalid @enderror" value="{{ old('judul', $prestasi->judul) }}" required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kategori</label>
                            <input type="text" name="kategori" class="form-control-custom" value="{{ old('kategori', $prestasi->kategori) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tingkat</label>
                            <input type="text" name="tingkat" class="form-control-custom" value="{{ old('tingkat', $prestasi->tingkat) }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tahun</label>
                            <input type="text" name="tahun" class="form-control-custom" value="{{ old('tahun', $prestasi->tahun) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Urutan Tampil</label>
                            <input type="number" name="urutan" class="form-control-custom" value="{{ old('urutan', $prestasi->urutan) }}">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control-custom" rows="4">{{ old('deskripsi', $prestasi->deskripsi) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Gambar Saat Ini</label>
                    @if($prestasi->gambar && file_exists(public_path('storage/' . $prestasi->gambar)))
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $prestasi->gambar) }}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                            <div class="mt-1">
                                <label class="text-muted small">
                                    <input type="checkbox" name="hapus_gambar" value="1"> Hapus gambar ini
                                </label>
                            </div>
                        </div>
                    @else
                        <div class="mb-2">
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                                <i class="fas fa-trophy fa-3x text-muted"></i>
                            </div>
                            <p class="text-muted small mt-1">Belum ada gambar</p>
                        </div>
                    @endif
                    
                    <label class="form-label fw-semibold mt-2">Ganti Gambar</label>
                    <input type="file" name="gambar" class="form-control-custom" accept="image/*" id="gambarInput">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
                    
                    <div id="imagePreview" class="mt-2" style="display: none;">
                        <img id="previewImg" src="#" alt="Preview" style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-control-custom">
                        <option value="aktif" {{ old('status', $prestasi->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status', $prestasi->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="fas fa-save me-2"></i> Update
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
            <h6 class="fw-bold mb-3"><i class="fas fa-info-circle me-2"></i> Informasi</h6>
            <p class="small text-muted mb-0">
                <strong>Dibuat:</strong> {{ $prestasi->created_at->format('d M Y H:i') }}<br>
                <strong>Terakhir update:</strong> {{ $prestasi->updated_at->format('d M Y H:i') }}
            </p>
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