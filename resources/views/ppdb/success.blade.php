@extends('layouts.app')

@section('title', 'Pendaftaran Berhasil - SMK FH NUSANTARA')

@section('content')
<style>
    /* ========== PERBAIKAN UNTUK NAVBAR FIXED ========== */
    /* Opsi 1: Beri padding-top pada body */
    body {
        padding-top: 80px !important;
    }
    
    /* Opsi 2: Atau beri margin pada container utama */
    .success-container {
        min-height: 100vh;
        padding: 120px 0 2rem;  /* Ditambah jadi 120px */
        margin-top: 0;
    }
    
    /* Jika navbar fixed dengan class tertentu, beri jarak */
    .navbar.fixed-top + .success-container,
    .navbar-sticky + .success-container,
    header + .success-container {
        padding-top: 120px;
    }
    
    .success-card {
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        background: white;
        overflow: hidden;
        max-width: 650px;
        margin: 0 auto;
        box-shadow: 0 5px 15px -5px rgba(0, 0, 0, 0.08);
    }
    
    .success-header {
        background: linear-gradient(135deg, #003f87 0%, #001f4d 100%);
        padding: 1rem;
        text-align: center;
        color: white;
    }
    
    .success-icon {
        width: 45px;
        height: 45px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.5rem;
    }
    
    .success-icon i {
        font-size: 1.5rem;
        color: white;
    }
    
    .success-header h2 {
        font-size: 1.1rem;
        margin-bottom: 0.2rem;
    }
    
    .success-header p {
        font-size: 0.7rem;
        opacity: 0.9;
        margin-bottom: 0;
    }
    
    .kode-box {
        background: #eef2ff;
        border: 1px solid #003f87;
        border-radius: 10px;
        padding: 0.6rem;
        text-align: center;
        margin-bottom: 0.75rem;
    }
    
    .kode-label {
        font-size: 0.6rem;
        color: #003f87;
        font-weight: 600;
        letter-spacing: 1px;
    }
    
    .kode-value {
        font-size: 1.1rem;
        font-weight: 700;
        color: #003f87;
        letter-spacing: 1px;
        font-family: monospace;
    }
    
    .nama-pendaftar {
        text-align: center;
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .nama-pendaftar span {
        font-weight: 600;
        color: #0f172a;
        font-size: 0.85rem;
    }
    
    .step-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .step-list li {
        margin-bottom: 0.75rem;
    }
    
    .step-list li:last-child {
        margin-bottom: 0;
    }
    
    .step-title {
        font-weight: 700;
        font-size: 0.75rem;
        color: #0f172a;
        margin-bottom: 0.35rem;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .step-number {
        display: inline-block;
        width: 18px;
        height: 18px;
        background: #003f87;
        color: white;
        border-radius: 50%;
        text-align: center;
        line-height: 18px;
        font-size: 0.6rem;
        font-weight: bold;
    }
    
    .doc-list {
        list-style: none;
        padding: 0;
        margin: 0 0 0 1.2rem;
    }
    
    .doc-list li {
        padding: 0.15rem 0;
        font-size: 0.65rem;
        color: #334155;
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 0;
    }
    
    .doc-list li i {
        color: #10b981;
        font-size: 0.6rem;
        width: 14px;
    }
    
    /* 2 KOLOM UNTUK TOMBOL WHATSAPP */
    .wa-row {
        display: flex;
        gap: 10px;
        margin-bottom: 10px;
    }
    
    .wa-col {
        flex: 1;
    }
    
    .btn-wa {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: #25D366;
        color: white;
        text-decoration: none;
        padding: 8px 12px;
        border-radius: 8px;
        font-size: 0.7rem;
        font-weight: 600;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
        width: 100%;
    }
    
    .btn-wa:hover {
        background: #128C7E;
        color: white;
        transform: translateY(-1px);
    }
    
    .btn-wa i {
        font-size: 0.8rem;
    }
    
    .contact-info {
        background: #f8fafc;
        border-radius: 8px;
        padding: 0.5rem;
        margin-top: 0.35rem;
    }
    
    .deadline-box {
        background: #fef3c7;
        border-radius: 8px;
        padding: 0.5rem;
        text-align: center;
        margin-top: 0.5rem;
    }
    
    .deadline-box i {
        color: #d97706;
        font-size: 0.8rem;
    }
    
    .deadline-date {
        font-weight: 700;
        color: #dc2626;
        font-size: 0.75rem;
        margin-top: 4px;
    }
    
    .btn-pdf {
        background: #dc2626;
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.75rem;
        transition: all 0.2s;
        cursor: pointer;
    }
    
    .btn-pdf:hover {
        background: #b91c1c;
        transform: translateY(-1px);
    }
    
    .btn-home {
        background: #003f87;
        color: white;
        padding: 8px 20px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.75rem;
        text-decoration: none;
        transition: all 0.2s;
    }
    
    .btn-home:hover {
        background: #002a5c;
        color: white;
        transform: translateY(-1px);
    }
    
    .content-padding {
        padding: 1rem;
    }
    
    /* Responsive mobile */
    @media (max-width: 768px) {
        .success-container {
            padding: 100px 1rem 2rem;
        }
        body {
            padding-top: 70px !important;
        }
    }
    
    /* Style untuk cetak PDF */
    @media print {
        body {
            background: white;
            padding: 0 !important;
            margin: 0;
        }
        .btn-pdf, .btn-home, .btn-wa, .navbar, footer {
            display: none !important;
        }
        .success-container {
            padding: 0 !important;
            margin: 0;
        }
        .success-card {
            box-shadow: none;
            border: 1px solid #ddd;
            max-width: 100%;
        }
        .success-header {
            background: #003f87;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .kode-box, .contact-info, .deadline-box {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    }
</style>

<!-- Tambahkan div pembungkus dengan ID untuk referensi scroll -->
<div id="top-page"></div>

<div class="success-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
               
                <div id="successCard" class="success-card">
                    <div class="success-header">
                        <div class="success-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h2>Pendaftaran Berhasil!</h2>
                        <p>Selamat! Kode pendaftaran Anda telah berhasil dibuat</p>
                    </div>
                    
                    <div class="content-padding">
                       
                        <div class="kode-box">
                            <div class="kode-label">KODE PENDAFTARAN</div>
                            <div class="kode-value">{{ $pendaftaran->kode_pendaftaran ?? 'Belum tersedia' }}</div>
                        </div>

                        
                        <div class="nama-pendaftar">
                            <span>Nama: {{ $pendaftaran->nama_lengkap ?? $pendaftaran->nama ?? '-' }}</span>
                        </div>

                        
                        <ul class="step-list">
                           
                            <li>
                                <div class="step-title">
                                    <span class="step-number">i</span>
                                    <span>Langkah Penting</span>
                                </div>
                                <div style="font-size: 0.65rem; background: #fef3c7; border: 1px solid #fde047; border-radius: 6px; padding: 0.4rem;">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    Screenshot atau simpan halaman ini sebagai bukti pendaftaran Anda.
                                </div>
                            </li>

                            <!-- 1. Dokumen yang Harus Dibawa -->
                            <li>
                                <div class="step-title">
                                    <span class="step-number">1</span>
                                    <span>Dokumen yang Harus Dibawa</span>
                                </div>
                                <p style="font-size: 0.6rem; margin-bottom: 0.25rem; color: #64748b;">Silakan datang ke SMK FH NUSANTARA dengan membawa:</p>
                                <ul class="doc-list">
                                    <li><i class="fas fa-check-circle"></i> Fotocopy Akta Kelahiran <strong>2 lembar</strong></li>
                                    <li><i class="fas fa-check-circle"></i> Fotocopy Kartu Keluarga <strong>2 lembar</strong></li>
                                    <li><i class="fas fa-check-circle"></i> PAS Foto Background Merah <strong>4 lembar</strong></li>
                                    <li><i class="fas fa-check-circle"></i> Fotocopy Ijazah SMP (jika ada) <strong>2 lembar</strong></li>
                                    <li><i class="fas fa-check-circle"></i> Fotocopy Raport SMP semester 1-5 <strong>1 lembar</strong></li>
                                    <li><i class="fas fa-check-circle"></i> Fotocopy KIP/KKC (opsional)</li>
                                    <li><i class="fas fa-check-circle"></i> Surat keterangan NISN <strong>1 lembar</strong></li>
                                </ul>
                            </li>

                            <!-- 2. Informasi Kontak dengan 2 Kolom Tombol -->
                            <li>
                                <div class="step-title">
                                    <span class="step-number">2</span>
                                    <span>Informasi Kontak</span>
                                </div>
                                <p style="font-size: 0.6rem; margin-bottom: 0.25rem; color: #64748b;">Untuk persyaratan tambahan, hubungi:</p>
                                <div class="contact-info">
                                    <!-- 2 KOLOM TOMBOL WHATSAPP -->
                                    <div class="wa-row">
                                        <div class="wa-col">
                                            <a href="https://wa.me/6285712686719?text=Halo%20kak%2C%20saya%20mau%20tanya%20soal%20persyaratan%20PPDB%20SMK%20FH%20NUSANTARA" 
                                               target="_blank" 
                                               class="btn-wa">
                                                <i class="fab fa-whatsapp"></i> 0857-1268-6719
                                            </a>
                                        </div>
                                        <div class="wa-col">
                                            <a href="https://wa.me/6282323855015?text=Halo%20kak%2C%20saya%20mau%20tanya%20soal%20persyaratan%20PPDB%20SMK%20FH%20NUSANTARA" 
                                               target="_blank" 
                                               class="btn-wa">
                                                <i class="fab fa-whatsapp"></i> 0823-2385-5015
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Batas Waktu Verifikasi - di bawah tombol -->
                                <div class="deadline-box">
                                    <i class="fas fa-clock"></i>
                                    <div style="font-weight: 600; font-size: 0.65rem;">⏰ Batas Waktu Verifikasi</div>
                                    <p style="font-size: 0.6rem; margin-bottom: 0.15rem;">Segera lakukan verifikasi pendaftaran sebelum tanggal:</p>
                                    <div class="deadline-date">
                                        {{ \Carbon\Carbon::parse($pendaftaran->tanggal_daftar ?? now())->addDays(7)->translatedFormat('d F Y') }}
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex flex-wrap gap-2 justify-content-center mt-3">
                    <button onclick="window.print()" class="btn-pdf">
                        <i class="fas fa-download me-1"></i> Simpan PDF
                    </button>
                    <a href="{{ route('home') }}" class="btn-home">
                        <i class="fas fa-home me-1"></i> Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Force scroll ke atas dengan offset untuk navbar fixed
    document.addEventListener('DOMContentLoaded', function() {
        // Cek tinggi navbar
        var navbar = document.querySelector('.navbar');
        var navbarHeight = navbar ? navbar.offsetHeight : 80;
        
        // Scroll dengan offset
        window.scrollTo({
            top: navbarHeight + 10,
            behavior: 'instant'
        });
    });
</script>

@if(!isset($pendaftaran) || empty($pendaftaran->kode_pendaftaran))
<script>
    console.warn('Data pendaftaran tidak lengkap. Pastikan variabel $pendaftaran terkirim dari controller.');
</script>
@endif
@endsection