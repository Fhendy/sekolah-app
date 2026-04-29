@extends('layouts.admin')

@section('title', 'Edit Ekstrakurikuler - Admin Panel')

@section('header_title', 'Edit Ekstrakurikuler')
@section('header_subtitle', 'Perbarui kegiatan ekstrakurikuler')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="data-table p-4">
            <form action="{{ route('admin.eskul.update', $eskul->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Ekstrakurikuler <span class="text-danger">*</span></label>
                    <input type="text" name="nama" class="form-control-custom @error('nama') is-invalid @enderror" value="{{ old('nama', $eskul->nama) }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Pembina</label>
                    <input type="text" name="pembina" class="form-control-custom" value="{{ old('pembina', $eskul->pembina) }}">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jadwal</label>
                            <input type="text" name="jadwal" class="form-control-custom" value="{{ old('jadwal', $eskul->jadwal) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tempat</label>
                            <input type="text" name="tempat" class="form-control-custom" value="{{ old('tempat', $eskul->tempat) }}">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Gambar Saat Ini</label>
                    @if($eskul->gambar && file_exists(public_path('storage/' . $eskul->gambar)))
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $eskul->gambar) }}" class="img-fluid rounded border" style="max-width: 200px;">
                            <div class="mt-1">
                                <label class="text-muted small">
                                    <input type="checkbox" name="hapus_gambar" value="1"> Hapus gambar ini
                                </label>
                            </div>
                        </div>
                    @else
                        <div class="mb-2">
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 200px; height: 150px;">
                                <i class="fas fa-image fa-3x text-muted"></i>
                            </div>
                            <p class="text-muted small mt-1">Belum ada gambar</p>
                        </div>
                    @endif
                    
                    <label class="form-label fw-semibold mt-2">Ganti Gambar</label>
                    <input type="file" name="gambar" class="form-control-custom" accept="image/*" id="gambarInput">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
                    
                    <div id="imagePreview" class="mt-2" style="display: none;">
                        <img id="previewImg" src="#" alt="Preview" style="max-width: 200px; border-radius: 8px; border: 1px solid #ddd;">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control-custom" rows="6">{{ old('deskripsi', $eskul->deskripsi) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-control-custom">
                        <option value="aktif" {{ old('status', $eskul->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status', $eskul->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="fas fa-save me-2"></i> Update
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
            <h6 class="fw-bold mb-3"><i class="fas fa-info-circle me-2"></i> Informasi</h6>
            <p class="small text-muted mb-0">
                <strong>Dibuat:</strong> {{ $eskul->created_at->format('d M Y H:i') }}<br>
                <strong>Terakhir update:</strong> {{ $eskul->updated_at->format('d M Y H:i') }}
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