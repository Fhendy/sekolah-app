@extends('layouts.admin')

@section('title', 'Tambah Guru - Admin Panel')

@section('header_title', 'Tambah Guru')
@section('header_subtitle', 'Tambah data tenaga pendidik baru')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="data-table p-4">
            <form action="{{ route('admin.guru.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control-custom @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">NIP</label>
                            <input type="text" name="nip" class="form-control-custom" value="{{ old('nip') }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jabatan <span class="text-danger">*</span></label>
                            <input type="text" name="jabatan" class="form-control-custom @error('jabatan') is-invalid @enderror" value="{{ old('jabatan') }}" required>
                            @error('jabatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Bidang/Mapel</label>
                            <input type="text" name="bidang" class="form-control-custom" value="{{ old('bidang') }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control-custom" value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">No. Telepon</label>
                            <input type="text" name="no_hp" class="form-control-custom" value="{{ old('no_hp') }}">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Foto</label>
                    <input type="file" name="foto" class="form-control-custom @error('foto') is-invalid @enderror" accept="image/*" id="fotoInput">
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Format: JPG, PNG. Maksimal 2MB</small>
                    
                    <div id="imagePreview" class="mt-2" style="display: none;">
                        <img id="previewImg" src="#" alt="Preview" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; border: 2px solid #e2e8f0;">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" class="form-control-custom">
                                <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
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

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="fas fa-save me-2"></i> Simpan
                    </button>
                    <a href="{{ route('admin.guru.index') }}" class="btn btn-outline-custom">
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
                <li>Isi semua field yang bertanda bintang (*)</li>
                <li>Foto akan ditampilkan dalam bentuk bulat</li>
                <li>Urutan tampil menentukan posisi di halaman depan</li>
                <li>Status "Nonaktif" tidak akan ditampilkan di website</li>
            </ul>
        </div>
    </div>
</div>

<script>
    document.getElementById('fotoInput').addEventListener('change', function(e) {
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