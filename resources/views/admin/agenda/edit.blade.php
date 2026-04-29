@extends('layouts.admin')

@section('title', 'Edit Agenda - Admin Panel')

@section('header_title', 'Edit Agenda')
@section('header_subtitle', 'Perbarui jadwal kegiatan')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="data-table p-4">
            <form action="{{ route('admin.agenda.update', $agenda->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label fw-semibold">Judul Agenda <span class="text-danger">*</span></label>
                    <input type="text" name="judul" class="form-control-custom @error('judul') is-invalid @enderror" value="{{ old('judul', $agenda->judul) }}" required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tanggal Mulai <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="tanggal_mulai" class="form-control-custom @error('tanggal_mulai') is-invalid @enderror" value="{{ old('tanggal_mulai', $agenda->tanggal_mulai->format('Y-m-d\TH:i')) }}" required>
                            @error('tanggal_mulai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tanggal Selesai <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="tanggal_selesai" class="form-control-custom @error('tanggal_selesai') is-invalid @enderror" value="{{ old('tanggal_selesai', $agenda->tanggal_selesai->format('Y-m-d\TH:i')) }}" required>
                            @error('tanggal_selesai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Tempat <span class="text-danger">*</span></label>
                    <input type="text" name="tempat" class="form-control-custom @error('tempat') is-invalid @enderror" value="{{ old('tempat', $agenda->tempat) }}" required>
                    @error('tempat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Tipe Agenda</label>
                    <select name="tipe" class="form-control-custom">
                        <option value="Umum" {{ old('tipe', $agenda->tipe) == 'Umum' ? 'selected' : '' }}>Umum</option>
                        <option value="Akademik" {{ old('tipe', $agenda->tipe) == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                        <option value="Humas" {{ old('tipe', $agenda->tipe) == 'Humas' ? 'selected' : '' }}>Humas</option>
                        <option value="Kesiswaan" {{ old('tipe', $agenda->tipe) == 'Kesiswaan' ? 'selected' : '' }}>Kesiswaan</option>
                        <option value="Prestasi" {{ old('tipe', $agenda->tipe) == 'Prestasi' ? 'selected' : '' }}>Prestasi</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control-custom" rows="4">{{ old('deskripsi', $agenda->deskripsi) }}</textarea>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="fas fa-save me-2"></i> Update
                    </button>
                    <a href="{{ route('admin.agenda.index') }}" class="btn btn-outline-custom">
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
                <strong>Status:</strong> 
                <span class="badge bg-{{ $agenda->status == 'Akan Datang' ? 'success' : ($agenda->status == 'Berlangsung' ? 'warning' : 'secondary') }}">
                    {{ $agenda->status }}
                </span>
                <br>
                <strong>Dibuat:</strong> {{ $agenda->created_at->format('d M Y H:i') }}<br>
                <strong>Terakhir update:</strong> {{ $agenda->updated_at->format('d M Y H:i') }}
            </p>
        </div>
    </div>
</div>
@endsection