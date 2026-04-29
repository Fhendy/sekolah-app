@extends('layouts.admin')

@section('title', 'Edit Hero Slider - Admin Panel')

@section('header_title', 'Hero Slider')
@section('header_subtitle', 'Edit slide banner')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Form Edit Hero Slider</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.hero-slider.update', $heroSlider->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row g-4">
                <!-- Gambar Desktop -->
                <div class="col-md-12">
                    <label class="form-label">Gambar Desktop</label>
                    @if($heroSlider->gambar && file_exists(public_path('storage/' . $heroSlider->gambar)))
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $heroSlider->gambar) }}" width="300" class="img-thumbnail">
                        </div>
                    @endif
                    <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror" accept="image/*">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Gambar Mobile -->
                <div class="col-md-12">
                    <label class="form-label">Gambar Mobile</label>
                    @if($heroSlider->gambar_mobile && file_exists(public_path('storage/' . $heroSlider->gambar_mobile)))
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $heroSlider->gambar_mobile) }}" width="150" class="img-thumbnail">
                        </div>
                    @endif
                    <input type="file" name="gambar_mobile" class="form-control @error('gambar_mobile') is-invalid @enderror" accept="image/*">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
                    @error('gambar_mobile')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Link -->
                <div class="col-md-12">
                    <label class="form-label">Link (Opsional)</label>
                    <input type="url" name="link" class="form-control @error('link') is-invalid @enderror" value="{{ old('link', $heroSlider->link) }}" placeholder="https://... atau /halaman">
                    <small class="text-muted">Banner akan menjadi link jika diklik</small>
                    @error('link')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Urutan -->
                <div class="col-md-6">
                    <label class="form-label required">Urutan</label>
                    <input type="number" name="urutan" class="form-control @error('urutan') is-invalid @enderror" value="{{ old('urutan', $heroSlider->urutan) }}" required>
                    @error('urutan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Aktif -->
                <div class="col-md-6">
                    <div class="form-check mt-4">
                        <input class="form-check-input" type="checkbox" name="aktif" id="aktif" {{ old('aktif', $heroSlider->aktif) ? 'checked' : '' }}>
                        <label class="form-check-label" for="aktif">
                            Aktifkan slide ini
                        </label>
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="fas fa-save me-2"></i> Update
                    </button>
                    <a href="{{ route('admin.hero-slider.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i> Kembali
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    .btn-primary-custom {
        background: linear-gradient(135deg, #003f87 0%, #001f4d 100%);
        color: white;
        border: none;
    }
    .btn-primary-custom:hover {
        background: linear-gradient(135deg, #004f9e 0%, #002a5c 100%);
        color: white;
    }
    .required:after {
        content: " *";
        color: #dc2626;
    }
</style>
@endsection