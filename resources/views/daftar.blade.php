@extends('layouts.app')

@section('title', 'Pendaftaran Siswa Baru')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto text-center mb-5" data-aos="fade-up">
            <h1 class="display-4 fw-bold mb-4">Pendaftaran Siswa Baru</h1>
            <p class="lead">Tahun Ajaran 2024/2025</p>
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> Pendaftaran dibuka mulai 1 Januari 2024 hingga 30 Juni 2024
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-8 mx-auto" data-aos="fade-up">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-header bg-primary text-white text-center py-4 rounded-top-4">
                    <h3 class="mb-0">Formulir Pendaftaran Online</h3>
                    <p class="mb-0">Isi data dengan lengkap dan benar</p>
                </div>
                <div class="card-body p-5">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h4 class="fw-bold mb-4">Data Pribadi</h4>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="form-control form-control-lg" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">NIK <span class="text-danger">*</span></label>
                                <input type="text" name="nik" class="form-control form-control-lg" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tempat Lahir <span class="text-danger">*</span></label>
                                <input type="text" name="tempat_lahir" class="form-control form-control-lg" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_lahir" class="form-control form-control-lg" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select name="jenis_kelamin" class="form-select form-select-lg" required>
                                    <option value="">Pilih...</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Agama <span class="text-danger">*</span></label>
                                <select name="agama" class="form-select form-select-lg" required>
                                    <option value="">Pilih...</option>
                                    <option>Islam</option>
                                    <option>Kristen</option>
                                    <option>Katolik</option>
                                    <option>Hindu</option>
                                    <option>Buddha</option>
                                </select>
                            </div>
                        </div>
                        
                        <h4 class="fw-bold mb-4">Data Kontak</h4>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control form-control-lg" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">No. HP/WA <span class="text-danger">*</span></label>
                                <input type="tel" name="hp" class="form-control form-control-lg" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Alamat Lengkap <span class="text-danger">*</span></label>
                                <textarea name="alamat" rows="3" class="form-control" required></textarea>
                            </div>
                        </div>
                        
                        <h4 class="fw-bold mb-4">Data Pendidikan</h4>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Asal Sekolah <span class="text-danger">*</span></label>
                                <input type="text" name="asal_sekolah" class="form-control form-control-lg" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">NISN <span class="text-danger">*</span></label>
                                <input type="text" name="nisn" class="form-control form-control-lg" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tahun Lulus <span class="text-danger">*</span></label>
                                <input type="number" name="tahun_lulus" class="form-control form-control-lg" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Jurusan yang Dipilih <span class="text-danger">*</span></label>
                                <select name="jurusan" class="form-select form-select-lg" required>
                                    <option value="">Pilih Jurusan...</option>
                                    <option value="RPL">Rekayasa Perangkat Lunak (RPL)</option>
                                    <option value="PBS">Perbankan Syariah (PBS)</option>
                                    <option value="TKR">Teknik Kendaraan Ringan (TKR)</option>
                                    <option value="PHT">Perhotelan & Pariwisata (PHT)</option>
                                </select>
                            </div>
                        </div>
                        
                        <h4 class="fw-bold mb-4">Data Orang Tua/Wali</h4>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Ayah</label>
                                <input type="text" name="nama_ayah" class="form-control form-control-lg">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Ibu</label>
                                <input type="text" name="nama_ibu" class="form-control form-control-lg">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Pekerjaan Ayah</label>
                                <input type="text" name="pekerjaan_ayah" class="form-control form-control-lg">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Pekerjaan Ibu</label>
                                <input type="text" name="pekerjaan_ibu" class="form-control form-control-lg">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">No. HP Orang Tua</label>
                                <input type="tel" name="hp_ortu" class="form-control form-control-lg">
                            </div>
                        </div>
                        
                        <h4 class="fw-bold mb-4">Upload Dokumen</h4>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Ijazah/SKHU (PDF/Image)</label>
                                <input type="file" name="ijazah" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Kartu Keluarga (PDF/Image)</label>
                                <input type="file" name="kk" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Akta Kelahiran (PDF/Image)</label>
                                <input type="file" name="akta" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Pas Foto (JPG/PNG)</label>
                                <input type="file" name="foto" class="form-control" accept=".jpg,.jpeg,.png">
                            </div>
                        </div>
                        
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="agree" required>
                            <label class="form-check-label" for="agree">
                                Saya menyatakan bahwa data yang saya isikan adalah benar dan dapat dipertanggungjawabkan.
                            </label>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-paper-plane"></i> Daftar Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection