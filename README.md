# 🏫 Website SMK FH NUSANTARA

Sistem Informasi Sekolah berbasis Laravel untuk SMK FH NUSANTARA. Website ini menyediakan informasi lengkap tentang profil sekolah, program keahlian, berita, galeri, agenda, pendaftaran siswa baru (PPDB), serta panel administrasi untuk mengelola konten.

## 📋 Fitur Utama

### Frontend (Pengunjung)
- **Halaman Beranda** - Menampilkan informasi utama sekolah, statistik, program keahlian, berita terbaru, agenda, dan prestasi
- **Profil Sekolah** - Identitas sekolah, visi misi, sejarah, struktur organisasi, guru & karyawan, fasilitas, prestasi, mars sekolah, ekstrakurikuler
- **Program Keahlian** - Informasi detail setiap jurusan dengan logo, deskripsi, kompetensi, prospek karir, dan brosur download
- **Berita & Artikel** - Informasi terkini seputar kegiatan sekolah dengan fitur pencarian
- **Galeri Kegiatan** - Dokumentasi foto kegiatan sekolah
- **Agenda Sekolah** - Jadwal kegiatan dan acara penting
- **Ekstrakurikuler** - Informasi kegiatan ekstrakurikuler yang tersedia
- **Kontak Kami** - Informasi kontak, peta lokasi, dan form pesan
- **Pendaftaran Siswa Baru (PPDB)** - Form pendaftaran online dengan generate kode otomatis dan download bukti PDF

### Admin Panel
- **Dashboard** - Ringkasan data dan statistik
- **Manajemen Jurusan** - CRUD data jurusan (termasuk upload logo dan brosur PDF)
- **Manajemen Berita** - CRUD artikel berita dengan upload gambar
- **Manajemen Galeri** - Upload dan kelola foto kegiatan
- **Manajemen Agenda** - CRUD jadwal kegiatan
- **Manajemen Guru & Karyawan** - CRUD data tenaga pendidik dengan upload foto
- **Manajemen Prestasi** - CRUD data prestasi sekolah dengan upload gambar
- **Manajemen Ekstrakurikuler** - CRUD data ekstrakurikuler
- **Manajemen Statistik** - Update data statistik yang tampil di beranda
- **Manajemen Pendaftaran PPDB** - Lihat, verifikasi, dan kelola data pendaftar

### Superadmin
- **Manajemen User** - CRUD pengguna (superadmin, admin, user)

## 🛠️ Teknologi yang Digunakan

| Teknologi | Keterangan |
|-----------|------------|
| **Laravel 10** | PHP Framework |
| **PHP 8.1+** | Bahasa Pemrograman |
| **MySQL** | Database |
| **Bootstrap 5** | CSS Framework |
| **Font Awesome 6** | Icon Library |
| **AOS.js** | Scroll Animation |
| **html2pdf.js** | Generate PDF |
| **Laragon/XAMPP** | Local Development |


## 🚀 Instalasi

### Persyaratan
- PHP >= 8.1
- Composer
- MySQL
- Node.js & NPM (opsional, untuk assets)
