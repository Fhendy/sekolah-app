@extends('layouts.app')

@section('title', 'Pendaftaran Siswa Baru - SMK FH NUSANTARA')

@section('content')
<style>
    /* Hapus hero, langsung card dari atas */
    .page-wrapper {
        min-height: 100vh;
        padding: 100px 0 3rem;
        background: linear-gradient(135deg, #f0f9ff 0%, #e6f0fa 100%);
    }
    
    @media (max-width: 768px) {
        .page-wrapper {
            padding: 90px 1rem 2rem;
        }
    }
    
    .form-card {
        border: none;
        border-radius: 24px;
        background: white;
        box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.2s;
    }
    
    .form-card:hover {
        transform: translateY(-3px);
    }
    
    .form-header {
        background: linear-gradient(135deg, #003f87 0%, #001f4d 100%);
        padding: 1.75rem;
        text-align: center;
        color: white;
    }
    
    .form-header h3 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    
    .form-header p {
        font-size: 0.85rem;
        opacity: 0.85;
        margin-bottom: 0;
    }
    
    .form-body {
        padding: 2rem;
    }
    
    @media (max-width: 768px) {
        .form-body {
            padding: 1.5rem;
        }
        .form-header h3 {
            font-size: 1.25rem;
        }
    }
    
    .form-label {
        font-weight: 600;
        font-size: 0.85rem;
        margin-bottom: 0.5rem;
        color: #1e293b;
    }
    
    .required:after {
        content: " *";
        color: #dc2626;
        font-weight: bold;
    }
    
    .form-control, .form-select {
        border: 1px solid #cbd5e1;
        border-radius: 12px;
        padding: 0.7rem 1rem;
        font-size: 0.9rem;
        transition: all 0.2s;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #003f87;
        box-shadow: 0 0 0 3px rgba(0, 63, 135, 0.1);
        outline: none;
    }
    
    .btn-submit {
        background: linear-gradient(135deg, #003f87 0%, #001f4d 100%);
        color: white;
        border: none;
        padding: 14px 28px;
        border-radius: 40px;
        font-weight: 700;
        font-size: 1rem;
        transition: all 0.2s;
        cursor: pointer;
        width: 100%;
    }
    
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px -5px rgba(0, 63, 135, 0.3);
        background: linear-gradient(135deg, #004f9e 0%, #002a5c 100%);
    }
    
    .btn-submit i {
        margin-right: 8px;
    }
    
    .form-check-label {
        font-size: 0.8rem;
        color: #475569;
    }
    
    .form-check-input:checked {
        background-color: #003f87;
        border-color: #003f87;
    }
    
    .invalid-feedback {
        font-size: 0.7rem;
        margin-top: 5px;
        color: #dc2626;
    }
    
    .alert-danger {
        background-color: #fee2e2;
        border: 1px solid #fecaca;
        color: #dc2626;
        padding: 1rem;
        border-radius: 12px;
        margin-bottom: 1.5rem;
    }
    
    .alert-danger ul {
        margin-bottom: 0;
        padding-left: 1.25rem;
    }
    
    /* Row spacing */
    .row.g-4 {
        --bs-gutter-y: 1.5rem;
    }
</style>

<div class="page-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="form-card">
                    <div class="form-header">
                        <h3>
                            <i class="fas fa-edit me-2"></i> Formulir Pendaftaran Online
                        </h3>
                        <p>Isi data dengan lengkap dan benar untuk proses pendaftaran</p>
                    </div>
                    
                    <div class="form-body">
                        <!-- Tampilkan semua error -->
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('ppdb.submit') }}" method="POST">
                            @csrf
                            
                            <div class="row g-4">
                                <!-- 1. Nama Lengkap -->
                                <div class="col-md-12">
                                    <label class="form-label required">Nama Lengkap</label>
                                    <input type="text" 
                                           name="nama_lengkap" 
                                           class="form-control @error('nama_lengkap') is-invalid @enderror" 
                                           value="{{ old('nama_lengkap') }}" 
                                           placeholder="Masukkan nama lengkap sesuai ijazah"
                                           required>
                                    @error('nama_lengkap')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- 2. Jenis Kelamin + Tanggal Lahir -->
                                <div class="col-md-6">
                                    <label class="form-label required">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>👨 Laki-laki</option>
                                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>👩 Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label required">Tanggal Lahir</label>
                                    <input type="date" 
                                           name="tanggal_lahir" 
                                           class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                                           value="{{ old('tanggal_lahir') }}"
                                           required>
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- 3. Asal Sekolah -->
                                <div class="col-md-6">
                                    <label class="form-label required">Kota/Kabupaten Asal Sekolah</label>
                                    <input type="text" 
                                           name="kota_kabupaten" 
                                           class="form-control @error('kota_kabupaten') is-invalid @enderror" 
                                           value="{{ old('kota_kabupaten') }}"
                                           placeholder="Contoh: Kabupaten FH"
                                           required>
                                    @error('kota_kabupaten')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label required">Nama Sekolah Asal</label>
                                    <input type="text" 
                                           name="asal_sekolah" 
                                           class="form-control @error('asal_sekolah') is-invalid @enderror" 
                                           value="{{ old('asal_sekolah') }}"
                                           placeholder="Contoh: SMK FH NUSANTARA"
                                           required>
                                    @error('asal_sekolah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- 4. No WhatsApp -->
                                <div class="col-md-6">
                                    <label class="form-label required">No. WhatsApp Siswa</label>
                                    <input type="tel" 
                                           name="no_wa_siswa" 
                                           class="form-control @error('no_wa_siswa') is-invalid @enderror" 
                                           value="{{ old('no_wa_siswa') }}" 
                                           placeholder="Contoh: 081234567890"
                                           required>
                                    <small class="text-muted" style="font-size: 0.7rem;">Gunakan format angka, tanpa tanda hubung</small>
                                    @error('no_wa_siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label required">No. WhatsApp Orang Tua/Wali</label>
                                    <input type="tel" 
                                           name="no_wa_ortu" 
                                           class="form-control @error('no_wa_ortu') is-invalid @enderror" 
                                           value="{{ old('no_wa_ortu') }}" 
                                           placeholder="Contoh: 081234567890"
                                           required>
                                    <small class="text-muted" style="font-size: 0.7rem;">Gunakan format angka, tanpa tanda hubung</small>
                                    @error('no_wa_ortu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- 5. Jurusan -->
                                <div class="col-md-12">
                                    <label class="form-label required">Jurusan yang Dipilih</label>
                                    <select name="jurusan" class="form-select @error('jurusan') is-invalid @enderror" required>
                                        <option value="">Pilih Jurusan</option>
                                        @foreach($jurusans as $jurusan)
                                            <option value="{{ $jurusan->nama }}" {{ old('jurusan') == $jurusan->nama ? 'selected' : '' }}>
                                                📚 {{ $jurusan->nama }} ({{ $jurusan->kode }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('jurusan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Checkbox -->
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="agree" required>
                                        <label class="form-check-label" for="agree">
                                            ✅ Saya menyatakan bahwa data yang saya isikan adalah <strong>benar dan dapat dipertanggungjawabkan</strong>.
                                        </label>
                                    </div>
                                </div>

                                <!-- Tombol Submit -->
                                <div class="col-12">
                                    <button type="submit" class="btn-submit">
                                        <i class="fas fa-paper-plane"></i> Daftar Sekarang
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Smooth scroll untuk error validation
    @if($errors->any())
    document.addEventListener('DOMContentLoaded', function() {
        var firstError = document.querySelector('.is-invalid');
        if(firstError) {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            firstError.focus();
        }
    });
    @endif
</script>
@endsection