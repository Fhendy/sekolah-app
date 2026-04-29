@extends('layouts.admin')

@section('title', 'Edit Guru - Admin Panel')

@section('header_title', 'Edit Guru')
@section('header_subtitle', 'Perbarui data tenaga pendidik')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="data-table p-4">
            <form action="{{ route('admin.guru.update', $guru->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control-custom @error('nama') is-invalid @enderror" value="{{ old('nama', $guru->nama) }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">NIP</label>
                            <input type="text" name="nip" class="form-control-custom" value="{{ old('nip', $guru->nip) }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jabatan <span class="text-danger">*</span></label>
                            <input type="text" name="jabatan" class="form-control-custom @error('jabatan') is-invalid @enderror" value="{{ old('jabatan', $guru->jabatan) }}" required>
                            @error('jabatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Bidang/Mapel</label>
                            <input type="text" name="bidang" class="form-control-custom" value="{{ old('bidang', $guru->bidang) }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control-custom" value="{{ old('email', $guru->email) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">No. Telepon</label>
                            <input type="text" name="no_hp" class="form-control-custom" value="{{ old('no_hp', $guru->no_hp) }}">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Foto Saat Ini</label>
                    @if($guru->foto && file_exists(public_path('storage/' . $guru->foto)))
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $guru->foto) }}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; border: 2px solid #e2e8f0;">
                            <div class="mt-1">
                                <label class="text-muted small">
                                    <input type="checkbox" name="hapus_foto" value="1"> Hapus foto ini
                                </label>
                            </div>
                        </div>
                    @else
                        <div class="mb-2">
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                                <i class="fas fa-user fa-3x text-muted"></i>
                            </div>
                            <p class="text-muted small mt-1">Belum ada foto</p>
                        </div>
                    @endif
                    
                    <label class="form-label fw-semibold mt-2">Ganti Foto</label>
                    <input type="file" name="foto" class="form-control-custom" accept="image/*" id="fotoInput">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah foto</small>
                    
                    <div id="imagePreview" class="mt-2" style="display: none;">
                        <img id="previewImg" src="#" alt="Preview" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; border: 2px solid #e2e8f0;">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" class="form-control-custom">
                                <option value="aktif" {{ old('status', $guru->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ old('status', $guru->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Urutan Tampil</label>
                            <input type="number" name="urutan" class="form-control-custom" value="{{ old('urutan', $guru->urutan) }}">
                            <small class="text-muted">Semakin kecil angka, semakin atas tampilannya</small>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="fas fa-save me-2"></i> Update
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
            <h6 class="fw-bold mb-3"><i class="fas fa-info-circle me-2"></i> Informasi</h6>
            <p class="small text-muted mb-0">
                <strong>Dibuat:</strong> {{ $guru->created_at->format('d M Y H:i') }}<br>
                <strong>Terakhir update:</strong> {{ $guru->updated_at->format('d M Y H:i') }}
            </p>
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