<footer class="footer">
    <div class="container">
        <div class="row">
            <!-- Kolom 1: Logo dan Deskripsi -->
            <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                <div class="footer-logo">
                    <img src="{{ asset('images/logo-white.png') }}" alt="SMK FH NUSANTARA" class="footer-logo-img"
                         onerror="this.src='{{ asset('images/logo-smk.png') }}'; this.onerror=null;">
                </div>
                <p class="footer-description">
                    Sekolah Kejuruan Terakreditasi A dengan fasilitas modern dan tenaga pengajar profesional yang siap mencetak lulusan berkompetensi global.
                </p>
                <div class="social-links">
                    <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
            
            <!-- Kolom 2: Navigasi -->
            <div class="col-lg-2 col-md-6 col-sm-6 mb-4">
                <h5 class="footer-title">Navigasi</h5>
                <ul class="footer-list">
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li><a href="{{ route('tentang') }}">Tentang Kami</a></li>
                    <li><a href="{{ route('jurusan.index') }}">Program Jurusan</a></li>
                    <li><a href="{{ route('berita.index') }}">Berita & Artikel</a></li>
                    <li><a href="{{ route('galeri.index') }}">Galeri Kegiatan</a></li>
                    <li><a href="{{ route('agenda.index') }}">Agenda Sekolah</a></li>
                    <li><a href="{{ route('kontak') }}">Kontak Kami</a></li>
                </ul>
            </div>
            
            <!-- Kolom 3: Kontak Kami -->
            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                <h5 class="footer-title">Kontak Kami</h5>
                <ul class="footer-list contact-list">
                    <li><i class="fas fa-map-marker-alt me-2"></i> Jl. Pendidikan No. 123, Kota Maju, Indonesia</li>
                    <li><i class="fas fa-phone me-2"></i> (021) 1234-5678</li>
                    <li><i class="fas fa-envelope me-2"></i> info@smkfhnusantara.sch.id</li>
                    <li><i class="fas fa-clock me-2"></i> Senin - Jumat: 07:00 - 16:00</li>
                </ul>
            </div>
            
            <!-- Kolom 4: Card Maps Sekolah -->
            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                <h5 class="footer-title">Lokasi Kami</h5>
                <div class="maps-card">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3975.7945313251134!2d109.53979507504408!3d-6.9709887682579454!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fdf0afbf68eb3%3A0x4099d2abd2be655b!2sWINDA%20M%20COLLECTION%20-%20ALPINE!5e1!3m2!1sid!2sid!4v1776594809191!5m2!1sid!2sid" 
                    width="100%" 
                    height="120" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
                </div>
                <p class="maps-address mt-2">
                    <i class="fas fa-location-dot me-1"></i> Jl. Pendidikan No. 123, Kota Maju
                </p>
            </div>
        </div>
        
        <!-- Copyright dan Dibuat Oleh -->
        <div class="footer-bottom">
            <div class="footer-divider"></div>
            <div class="footer-bottom-wrapper">
                <p class="copyright">
                    &copy; {{ date('Y') }} SMK FH NUSANTARA. All Rights Reserved.
                </p>
                <p class="credit">
                    <i class="fas fa-code me-1"></i> Dibuat oleh <strong>FH DIGITAL</strong>
                </p>
            </div>
        </div>
    </div>
</footer>

<style>
    .footer {
        background: #001f4d;
        color: #ffffff;
        padding: 3rem 0 1.5rem;
        margin-top: 0;
    }
    
    .footer-logo {
        margin-bottom: 1.25rem;
    }
    
    .footer-logo-img {
        height: 55px;
        width: auto;
        object-fit: contain;
    }
    
    .footer-description {
        color: rgba(255, 255, 255, 0.75);
        line-height: 1.6;
        font-size: 0.85rem;
        margin-bottom: 1.5rem;
    }
    
    .social-links {
        display: flex;
        gap: 0.75rem;
    }
    
    .social-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        color: white;
        font-size: 1rem;
        transition: all 0.2s ease;
        text-decoration: none;
    }
    
    .social-link:hover {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        transform: translateY(-2px);
    }
    
    .footer-title {
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 1rem;
        color: white;
        position: relative;
        display: inline-block;
    }
    
    .footer-title:after {
        content: '';
        position: absolute;
        bottom: -6px;
        left: 0;
        width: 35px;
        height: 2px;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 2px;
    }
    
    .footer-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .footer-list li {
        margin-bottom: 0.5rem;
    }
    
    .footer-list a {
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        transition: all 0.2s ease;
        font-size: 0.85rem;
    }
    
    .footer-list a:hover {
        color: white;
        padding-left: 4px;
    }
    
    .contact-list li {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.85rem;
        margin-bottom: 0.6rem;
        line-height: 1.5;
        display: flex;
        align-items: flex-start;
    }
    
    .contact-list li i {
        width: 20px;
        margin-top: 2px;
    }
    
    .maps-card {
        overflow: hidden;
        border-radius: 10px;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .maps-address {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.7rem;
        margin-top: 0.5rem;
        margin-bottom: 0;
    }
    
    .footer-bottom {
        margin-top: 2rem;
    }
    
    .footer-divider {
        height: 1px;
        background: rgba(255, 255, 255, 0.15);
        margin: 0 0 1rem 0;
    }
    
    .footer-bottom-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }
    
    .copyright {
        color: rgba(255, 255, 255, 0.5);
        font-size: 0.75rem;
        margin: 0;
    }
    
    .credit {
        color: rgba(255, 255, 255, 0.5);
        font-size: 0.75rem;
        margin: 0;
    }
    
    .credit i {
        color: #e74c3c;
    }
    
    .credit strong {
        color: rgba(255, 255, 255, 0.7);
        font-weight: 600;
    }
    
    /* ============================================ */
    /* RESPONSIVE - MOBILE 2x2 GRID */
    /* ============================================ */
    
    /* Desktop Large (1200px ke atas) */
    @media (min-width: 1200px) {
        .footer-logo-img {
            height: 55px;
        }
    }
    
    /* Desktop Medium (992px - 1199px) */
    @media (min-width: 992px) and (max-width: 1199px) {
        .footer-logo-img {
            height: 50px;
        }
        .footer-description {
            font-size: 0.8rem;
        }
    }
    
    /* Tablet (768px - 991px) - 2x2 grid */
    @media (min-width: 768px) and (max-width: 991px) {
        .footer {
            padding: 2rem 0 1rem;
        }
        
        /* 2x2 grid: kolom 1 & 2 di atas, kolom 3 & 4 di bawah */
        .footer .row {
            display: flex;
            flex-wrap: wrap;
        }
        
        .footer .col-md-6 {
            width: 50%;
        }
        
        /* Atur urutan: kolom 1,2 lalu kolom 3,4 */
        .footer .col-md-6:nth-child(1),
        .footer .col-md-6:nth-child(2) {
            margin-bottom: 2rem;
        }
        
        .footer-title {
            text-align: left;
            display: inline-block;
        }
        
        .footer-title:after {
            left: 0;
            transform: none;
        }
        
        .footer-logo {
            text-align: left;
        }
        
        .footer-description {
            text-align: left;
        }
        
        .social-links {
            justify-content: flex-start;
        }
        
        .footer-list {
            text-align: left;
        }
        
        .contact-list li {
            justify-content: flex-start;
        }
        
        .maps-card {
            max-width: 100%;
            margin: 0;
        }
        
        .maps-address {
            text-align: left;
        }
        
        .footer-bottom-wrapper {
            flex-direction: row;
            justify-content: space-between;
            text-align: left;
        }
    }
    
    /* Mobile Landscape & Portrait (max-width: 767px) - 2x2 grid */
    @media (max-width: 767px) {
        .footer {
            padding: 2rem 0 1rem;
        }
        
        /* 2x2 grid: kolom 1 & 2 di atas, kolom 3 & 4 di bawah */
        .footer .col-sm-6 {
            width: 50%;
            float: left;
        }
        
        .footer .row {
            display: flex;
            flex-wrap: wrap;
        }
        
        /* Atur urutan: kolom 1 (atas kiri), kolom 2 (atas kanan), kolom 3 (bawah kiri), kolom 4 (bawah kanan) */
        .footer .col-sm-6:nth-child(1),
        .footer .col-sm-6:nth-child(2) {
            margin-bottom: 2rem;
        }
        
        .footer-title {
            text-align: left;
            display: inline-block;
            font-size: 0.9rem;
        }
        
        .footer-title:after {
            left: 0;
            transform: none;
            width: 30px;
        }
        
        .footer-logo {
            text-align: left;
        }
        
        .footer-logo-img {
            height: 45px;
        }
        
        .footer-description {
            text-align: left;
            font-size: 0.8rem;
            margin-bottom: 1rem;
        }
        
        .social-links {
            justify-content: flex-start;
        }
        
        .social-link {
            width: 32px;
            height: 32px;
            font-size: 0.9rem;
        }
        
        .footer-list {
            text-align: left;
        }
        
        .footer-list li {
            margin-bottom: 0.4rem;
        }
        
        .footer-list a {
            font-size: 0.75rem;
        }
        
        .contact-list li {
            justify-content: flex-start;
            font-size: 0.75rem;
            margin-bottom: 0.5rem;
        }
        
        .contact-list li i {
            width: 18px;
            font-size: 0.75rem;
        }
        
        .maps-card {
            max-width: 100%;
            margin: 0;
        }
        
        .maps-card iframe {
            height: 100px;
        }
        
        .maps-address {
            text-align: left;
            font-size: 0.65rem;
        }
        
        .footer-bottom {
            margin-top: 1rem;
        }
        
        .footer-bottom-wrapper {
            flex-direction: column;
            text-align: center;
            gap: 0.5rem;
        }
        
        .copyright, .credit {
            font-size: 0.7rem;
        }
    }
    
    /* Mobile Kecil (max-width: 480px) */
    @media (max-width: 480px) {
        .footer .col-sm-6 {
            width: 50%;
        }
        
        .footer-logo-img {
            height: 40px;
        }
        
        .footer-description {
            font-size: 0.7rem;
        }
        
        .footer-title {
            font-size: 0.85rem;
        }
        
        .footer-list a {
            font-size: 0.7rem;
        }
        
        .contact-list li {
            font-size: 0.7rem;
        }
        
        .maps-card iframe {
            height: 90px;
        }
    }
    
    /* Clearfix untuk memastikan grid rapi */
    .footer .row:before,
    .footer .row:after {
        display: table;
        content: " ";
        clear: both;
    }
</style>