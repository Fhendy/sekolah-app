<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Jurusan;
use App\Models\Berita;
use App\Models\Statistik;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create Superadmin
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@sekolah.com',
            'password' => Hash::make('password'),
            'role' => 'superadmin',
        ]);
        
        // Create Admin
        User::create([
            'name' => 'Admin Sekolah',
            'email' => 'admin@sekolah.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        
        // Create User biasa
        User::create([
            'name' => 'User Biasa',
            'email' => 'user@sekolah.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
        
        // Create Jurusan
        $jurusans = [
            [
                'kode' => 'RPL', 
                'nama' => 'Rekayasa Perangkat Lunak', 
                'deskripsi' => 'Mempelajari pengembangan software, web, dan mobile apps. Siswa akan dibekali dengan kemampuan programming, database, dan UI/UX design.', 
                'slug' => 'rpl'
            ],
            [
                'kode' => 'PBS', 
                'nama' => 'Perbankan Syariah', 
                'deskripsi' => 'Mempelajari sistem perbankan dan ekonomi syariah. Lulusan siap bekerja di bank syariah, koperasi, dan lembaga keuangan mikro.', 
                'slug' => 'pbs'
            ],
            [
                'kode' => 'TKR', 
                'nama' => 'Teknik Kendaraan Ringan', 
                'deskripsi' => 'Mempelajari perawatan dan perbaikan kendaraan ringan. Kompetensi meliputi mesin, kelistrikan, dan chassis otomotif.', 
                'slug' => 'tkr'
            ],
            [
                'kode' => 'PHT', 
                'nama' => 'Perhotelan & Pariwisata', 
                'deskripsi' => 'Mempelajari tata kelola hotel dan pariwisata. Termasuk front office, housekeeping, food & beverage service.', 
                'slug' => 'pht'
            ],
        ];
        
        foreach ($jurusans as $jurusan) {
            Jurusan::create($jurusan);
        }
        
        // Create sample berita
        Berita::create([
            'judul' => 'Penerimaan Siswa Baru Tahun Ajaran 2024/2025',
            'slug' => 'ppdb-2024',
            'konten' => '<p>SMK FH NUSANTARA membuka pendaftaran siswa baru untuk tahun ajaran 2024/2025. Pendaftaran dibuka mulai 1 Januari 2024 hingga 30 Juni 2024.</p><p>Persyaratan pendaftaran:<br/>- Ijazah SMP/sederajat<br/>- SKHU<br/>- KK dan Akta Kelahiran<br/>- Pas foto 3x4 (2 lembar)</p><p>Info lebih lanjut hubungi panitia PPDB di nomor (021) 1234-5678.</p>',
            'penulis' => 'Admin Sekolah',
            'tanggal' => now(),
            'is_published' => true,
        ]);
        
        Berita::create([
            'judul' => 'SMK FH NUSANTARA Raih Juara Umum LKS Tingkat Provinsi',
            'slug' => 'juara-lks-2024',
            'konten' => '<p>Tim SMK FH NUSANTARA berhasil meraih juara umum pada Lomba Kompetensi Siswa (LKS) tingkat Provinsi tahun 2024. Total 5 medali emas, 3 perak, dan 2 perunggu berhasil dibawa pulang.</p><p>Prestasi ini merupakan hasil dari latihan intensif dan bimbingan dari para guru pembimbing yang kompeten di bidangnya.</p><p>Selamat kepada seluruh siswa dan guru yang telah berjuang! Prestasi ini akan menjadi motivasi untuk meraih prestasi yang lebih tinggi di tingkat nasional.</p>',
            'penulis' => 'Humas Sekolah',
            'tanggal' => now()->subDays(7),
            'is_published' => true,
        ]);
        
        Berita::create([
            'judul' => 'Kerjasama dengan PT Teknologi Nusantara untuk Program Magang',
            'slug' => 'kerjasama-magang',
            'konten' => '<p>SMK FH NUSANTARA menjalin kerjasama dengan PT Teknologi Nusantara untuk program magang siswa kelas XII. Kerjasama ini mencakup program magang selama 6 bulan dan pelatihan soft skill untuk siswa.</p><p>Program ini diharapkan dapat meningkatkan kompetensi lulusan SMK FH NUSANTARA sehingga siap bersaing di dunia kerja.</p>',
            'penulis' => 'Kepala Sekolah',
            'tanggal' => now()->subDays(14),
            'is_published' => true,
        ]);
        
        // Statistik sudah otomatis terisi dari migration
        // Update statistik dengan data yang lebih realistis
        $statistik = Statistik::first();
        if ($statistik) {
            $statistik->update([
                'jumlah_siswa' => 1250,
                'jumlah_alumni' => 5800,
                'jumlah_guru' => 85,
                'tahun_berdiri' => 1998,
            ]);
        }
        
        $this->command->info('Database seeded successfully!');
        $this->command->info('Akun login:');
        $this->command->info('Superadmin: superadmin@sekolah.com / password');
        $this->command->info('Admin: admin@sekolah.com / password');
        $this->command->info('User: user@sekolah.com / password');
    }
}