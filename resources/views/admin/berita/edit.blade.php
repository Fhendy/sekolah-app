@extends('layouts.admin')

@section('title', 'Edit Berita - Admin Panel')

@section('header_title', 'Edit Berita')
@section('header_subtitle', 'Perbarui artikel berita')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="data-table p-4">
            <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label fw-semibold">Judul Berita <span class="text-danger">*</span></label>
                    <input type="text" name="judul" class="form-control-custom" value="{{ old('judul', $berita->judul) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Slug</label>
                    <input type="text" name="slug" class="form-control-custom" value="{{ old('slug', $berita->slug) }}">
                    <small class="text-muted">Biarkan kosong untuk otomatis terisi</small>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Gambar Saat Ini</label>
                    @if($berita->gambar)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $berita->gambar) }}" class="img-fluid rounded border" style="max-width: 200px;" onerror="this.src='https://placehold.co/200x150/e2e8f0/64748b?text=No+Image'; this.onerror=null;">
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
                    <small class="text-muted">Format: JPG, PNG, JPEG. Maksimal 2MB. Kosongkan jika tidak ingin mengubah</small>
                    
                    <div id="imagePreview" class="mt-2" style="display: none;">
                        <img id="previewImg" src="#" alt="Preview" style="max-width: 200px; border-radius: 8px; border: 1px solid #ddd;">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Penulis</label>
                    <input type="text" name="penulis" class="form-control-custom" value="{{ old('penulis', $berita->penulis) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Tanggal <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal" class="form-control-custom" value="{{ old('tanggal', $berita->tanggal->format('Y-m-d')) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Konten <span class="text-danger">*</span></label>
                    <textarea name="konten" class="form-control-custom" rows="10" required>{{ old('konten', $berita->konten) }}</textarea>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="fas fa-save me-2"></i> Update
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
            <h6 class="fw-bold mb-3"><i class="fas fa-info-circle me-2"></i> Informasi</h6>
            <p class="small text-muted mb-0">
                <strong>Dibuat:</strong> {{ $berita->created_at->format('d M Y H:i') }}<br>
                <strong>Terakhir update:</strong> {{ $berita->updated_at->format('d M Y H:i') }}
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
    
    document.querySelector('input[name="judul"]').addEventListener('keyup', function() {
        let slugInput = document.querySelector('input[name="slug"]');
        if (slugInput.value === '{{ $berita->slug }}' || slugInput.value === '') {
            slugInput.value = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-');
        }
    });
</script>
@endsection