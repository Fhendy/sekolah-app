@extends('layouts.admin')

@section('title', 'Edit Jurusan - Admin Panel')

@section('header_title', 'Edit Jurusan')
@section('header_subtitle', 'Perbarui data program keahlian')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="data-table p-4">
            <form action="{{ route('admin.jurusan.update', $jurusan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label fw-semibold">Kode Jurusan <span class="text-danger">*</span></label>
                    <input type="text" name="kode" class="form-control-custom @error('kode') is-invalid @enderror" value="{{ old('kode', $jurusan->kode) }}" required>
                    @error('kode')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Jurusan <span class="text-danger">*</span></label>
                    <input type="text" name="nama" class="form-control-custom @error('nama') is-invalid @enderror" value="{{ old('nama', $jurusan->nama) }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Slug</label>
                    <input type="text" name="slug" class="form-control-custom" value="{{ old('slug', $jurusan->slug) }}">
                    <small class="text-muted">Biarkan kosong untuk otomatis terisi</small>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Ikon</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas {{ $jurusan->ikon ?? 'fa-laptop-code' }}"></i></span>
                        <input type="text" name="ikon" class="form-control-custom" value="{{ old('ikon', $jurusan->ikon ?? 'fa-laptop-code') }}">
                    </div>
                    <small class="text-muted">Gunakan kelas Font Awesome, contoh: fa-laptop-code, fa-code, fa-database</small>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Logo Saat Ini</label>
                    @if($jurusan->logo && file_exists(public_path('storage/' . $jurusan->logo)))
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $jurusan->logo) }}" style="height: 60px; width: auto;">
                            <div class="mt-1">
                                <label class="text-muted small">
                                    <input type="checkbox" name="hapus_logo" value="1"> Hapus logo ini
                                </label>
                            </div>
                        </div>
                    @else
                        <p class="text-muted">Belum ada logo</p>
                    @endif
                    
                    <label class="form-label fw-semibold mt-2">Ganti Logo</label>
                    <input type="file" name="logo" class="form-control-custom" accept="image/*" id="logoInput">
                    <small class="text-muted">Format: JPG, PNG. Maksimal 1MB</small>
                    <div id="logoPreview" class="mt-2" style="display: none;">
                        <img id="previewLogo" src="#" alt="Preview" style="height: 60px; width: auto;">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Brosur Saat Ini</label>
                    @if($jurusan->brosur && file_exists(public_path('storage/' . $jurusan->brosur)))
                        <div class="mb-2">
                            <a href="{{ asset('storage/' . $jurusan->brosur) }}" target="_blank" class="btn btn-sm btn-outline-custom">
                                <i class="fas fa-file-pdf me-1"></i> Lihat Brosur
                            </a>
                            <div class="mt-1">
                                <label class="text-muted small">
                                    <input type="checkbox" name="hapus_brosur" value="1"> Hapus brosur ini
                                </label>
                            </div>
                        </div>
                    @else
                        <p class="text-muted">Belum ada brosur</p>
                    @endif
                    
                    <label class="form-label fw-semibold mt-2">Ganti Brosur</label>
                    <input type="file" name="brosur" class="form-control-custom" accept="application/pdf" id="brosurInput">
                    <small class="text-muted">Format: PDF. Maksimal 5MB</small>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Deskripsi <span class="text-danger">*</span></label>
                    <textarea name="deskripsi" class="form-control-custom @error('deskripsi') is-invalid @enderror" rows="6" required>{{ old('deskripsi', $jurusan->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="fas fa-save me-2"></i> Update
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
            <h6 class="fw-bold mb-3"><i class="fas fa-info-circle me-2"></i> Informasi</h6>
            <p class="small text-muted mb-0">
                <strong>Dibuat:</strong> {{ $jurusan->created_at->format('d M Y H:i') }}<br>
                <strong>Terakhir update:</strong> {{ $jurusan->updated_at->format('d M Y H:i') }}
            </p>
            <hr>
            <h6 class="fw-bold mb-2">Preview</h6>
            <p><strong>URL:</strong> <code>{{ url('/jurusan/' . $jurusan->slug) }}</code></p>
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
    
    // Auto generate slug from nama
    document.querySelector('input[name="nama"]').addEventListener('keyup', function() {
        let slugInput = document.querySelector('input[name="slug"]');
        if (slugInput.value === '{{ $jurusan->slug }}' || slugInput.value === '') {
            slugInput.value = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-');
        }
    });
</script>
@endsection