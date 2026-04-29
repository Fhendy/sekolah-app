<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\EskulController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\PPDBController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==============================================
// PROFIL ROUTES (Frontend)
// ==============================================
Route::prefix('profil')->name('profil.')->group(function () {
    Route::get('/identitas-sekolah', [ProfilController::class, 'identitas'])->name('identitas');
    Route::get('/visi-misi', [ProfilController::class, 'visiMisi'])->name('visi-misi');
    Route::get('/sejarah', [ProfilController::class, 'sejarah'])->name('sejarah');
    Route::get('/struktur-organisasi', [ProfilController::class, 'struktur'])->name('struktur');
    Route::get('/fasilitas', [ProfilController::class, 'fasilitas'])->name('fasilitas');
    Route::get('/mars-sekolah', [ProfilController::class, 'mars'])->name('mars');
    Route::get('/eskul', [ProfilController::class, 'eskul'])->name('eskul');
});

// ==============================================
// GURU ROUTES (Frontend)
// ==============================================
Route::get('/guru-karyawan', [GuruController::class, 'index'])->name('profil.guru');

// ==============================================
// PRESTASI ROUTES (Frontend)
// ==============================================
Route::get('/profil/prestasi', [PrestasiController::class, 'index'])->name('profil.prestasi');

// ==============================================
// ESKUL ROUTES (Frontend)
// ==============================================
Route::prefix('eskul')->name('eskul.')->group(function () {
    Route::get('/', [EskulController::class, 'index'])->name('index');
    Route::get('/{eskul:slug}', [EskulController::class, 'show'])->name('show');
});

// ==============================================
// FRONTEND ROUTES (PUBLIC)
// ==============================================
Route::get('/', [DashboardController::class, 'index'])->name('home');
Route::get('/tentang', [DashboardController::class, 'tentang'])->name('tentang');
Route::get('/kontak', [DashboardController::class, 'kontak'])->name('kontak');
Route::get('/daftar', function () {
    return redirect()->route('ppdb.index');
})->name('daftar');

// Jurusan Routes (Frontend)
Route::prefix('jurusan')->name('jurusan.')->group(function () {
    Route::get('/', [JurusanController::class, 'index'])->name('index');
    Route::get('/{jurusan:slug}', [JurusanController::class, 'show'])->name('show');
});

// Berita Routes (Frontend)
Route::prefix('berita')->name('berita.')->group(function () {
    Route::get('/', [BeritaController::class, 'index'])->name('index');
    Route::get('/{berita:slug}', [BeritaController::class, 'show'])->name('show');
});

// Galeri Routes (Frontend)
Route::prefix('galeri')->name('galeri.')->group(function () {
    Route::get('/', [GaleriController::class, 'index'])->name('index');
});

// Agenda Routes (Frontend)
Route::prefix('agenda')->name('agenda.')->group(function () {
    Route::get('/', [AgendaController::class, 'index'])->name('index');
});

// ==============================================
// AUTH ROUTES
// ==============================================
Route::middleware('guest')->group(function () {
    Route::get('login', function () {
        return view('auth.login');
    })->name('login');
    
    Route::get('register', function () {
        return view('auth.register');
    })->name('register');
});

require __DIR__.'/auth.php';

// ==============================================
// PROFILE ROUTES
// ==============================================
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
});

// ==============================================
// PPDB ROUTES (PUBLIC)
// ==============================================
Route::prefix('ppdb')->name('ppdb.')->group(function () {
    Route::get('/', [PPDBController::class, 'showForm'])->name('index');
    Route::post('/submit', [PPDBController::class, 'submit'])->name('submit');
    Route::get('/sukses/{kode}', [PPDBController::class, 'success'])->name('success');
});

// ==============================================
// ADMIN ROUTES
// ==============================================
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
    Route::get('/hero-slider', [App\Http\Controllers\Admin\HeroSliderController::class, 'index'])->name('hero-slider.index');
    Route::get('/hero-slider/create', [App\Http\Controllers\Admin\HeroSliderController::class, 'create'])->name('hero-slider.create');
    Route::post('/hero-slider', [App\Http\Controllers\Admin\HeroSliderController::class, 'store'])->name('hero-slider.store');
    Route::get('/hero-slider/{id}/edit', [App\Http\Controllers\Admin\HeroSliderController::class, 'edit'])->name('hero-slider.edit');
    Route::put('/hero-slider/{id}', [App\Http\Controllers\Admin\HeroSliderController::class, 'update'])->name('hero-slider.update');
    Route::delete('/hero-slider/{id}', [App\Http\Controllers\Admin\HeroSliderController::class, 'destroy'])->name('hero-slider.destroy');
    Route::patch('/hero-slider/{id}/status', [App\Http\Controllers\Admin\HeroSliderController::class, 'updateStatus'])->name('hero-slider.status');

    // Manajemen Jurusan
    Route::get('/jurusan', [JurusanController::class, 'adminIndex'])->name('jurusan.index');
    Route::get('/jurusan/create', [JurusanController::class, 'create'])->name('jurusan.create');
    Route::post('/jurusan', [JurusanController::class, 'store'])->name('jurusan.store');
    Route::get('/jurusan/{jurusan}/edit', [JurusanController::class, 'edit'])->name('jurusan.edit');
    Route::put('/jurusan/{jurusan}', [JurusanController::class, 'update'])->name('jurusan.update');
    Route::delete('/jurusan/{jurusan}', [JurusanController::class, 'destroy'])->name('jurusan.destroy');
    
    // Manajemen Berita
    Route::get('/berita', [BeritaController::class, 'adminIndex'])->name('berita.index');
    Route::get('/berita/create', [BeritaController::class, 'create'])->name('berita.create');
    Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');
    Route::get('/berita/{berita}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
    Route::put('/berita/{berita}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/berita/{berita}', [BeritaController::class, 'destroy'])->name('berita.destroy');
    
    // Manajemen Galeri
    Route::get('/galeri', [GaleriController::class, 'adminIndex'])->name('galeri.index');
    Route::get('/galeri/create', [GaleriController::class, 'create'])->name('galeri.create');
    Route::post('/galeri', [GaleriController::class, 'store'])->name('galeri.store');
    Route::get('/galeri/{galeri}/edit', [GaleriController::class, 'edit'])->name('galeri.edit');
    Route::put('/galeri/{galeri}', [GaleriController::class, 'update'])->name('galeri.update');
    Route::delete('/galeri/{galeri}', [GaleriController::class, 'destroy'])->name('galeri.destroy');
    
    // Manajemen Agenda
    Route::get('/agenda', [AgendaController::class, 'adminIndex'])->name('agenda.index');
    Route::get('/agenda/create', [AgendaController::class, 'create'])->name('agenda.create');
    Route::post('/agenda', [AgendaController::class, 'store'])->name('agenda.store');
    Route::get('/agenda/{agenda}/edit', [AgendaController::class, 'edit'])->name('agenda.edit');
    Route::put('/agenda/{agenda}', [AgendaController::class, 'update'])->name('agenda.update');
    Route::delete('/agenda/{agenda}', [AgendaController::class, 'destroy'])->name('agenda.destroy');
    
    // Manajemen Guru
    Route::get('/guru', [GuruController::class, 'adminIndex'])->name('guru.index');
    Route::get('/guru/create', [GuruController::class, 'create'])->name('guru.create');
    Route::post('/guru', [GuruController::class, 'store'])->name('guru.store');
    Route::get('/guru/{guru}/edit', [GuruController::class, 'edit'])->name('guru.edit');
    Route::put('/guru/{guru}', [GuruController::class, 'update'])->name('guru.update');
    Route::delete('/guru/{guru}', [GuruController::class, 'destroy'])->name('guru.destroy');
    
    // Manajemen Prestasi
    Route::get('/prestasi', [PrestasiController::class, 'adminIndex'])->name('prestasi.index');
    Route::get('/prestasi/create', [PrestasiController::class, 'create'])->name('prestasi.create');
    Route::post('/prestasi', [PrestasiController::class, 'store'])->name('prestasi.store');
    Route::get('/prestasi/{prestasi}/edit', [PrestasiController::class, 'edit'])->name('prestasi.edit');
    Route::put('/prestasi/{prestasi}', [PrestasiController::class, 'update'])->name('prestasi.update');
    Route::delete('/prestasi/{prestasi}', [PrestasiController::class, 'destroy'])->name('prestasi.destroy');
    
    // Manajemen Ekstrakurikuler
    Route::get('/eskul', [EskulController::class, 'adminIndex'])->name('eskul.index');
    Route::get('/eskul/create', [EskulController::class, 'create'])->name('eskul.create');
    Route::post('/eskul', [EskulController::class, 'store'])->name('eskul.store');
    Route::get('/eskul/{eskul}/edit', [EskulController::class, 'edit'])->name('eskul.edit');
    Route::put('/eskul/{eskul}', [EskulController::class, 'update'])->name('eskul.update');
    Route::delete('/eskul/{eskul}', [EskulController::class, 'destroy'])->name('eskul.destroy');
    
    // Manajemen Statistik
    Route::get('/statistik/edit', [DashboardController::class, 'editStatistik'])->name('statistik.edit');
    Route::put('/statistik', [DashboardController::class, 'updateStatistik'])->name('statistik.update');
    
    // Manajemen Pendaftaran PPDB (Admin)
    Route::get('/pendaftaran', [PPDBController::class, 'adminIndex'])->name('pendaftaran.index');
    Route::get('/pendaftaran/{id}', [PPDBController::class, 'adminDetail'])->name('pendaftaran.detail');
    Route::put('/pendaftaran/{id}/status', [PPDBController::class, 'adminUpdateStatus'])->name('pendaftaran.update-status');
    Route::delete('/pendaftaran/{id}', [PPDBController::class, 'adminDestroy'])->name('pendaftaran.destroy');
// Di dalam group admin, tambahkan route ini
Route::post('/pendaftaran/bulk-delete', [PPDBController::class, 'adminBulkDestroy'])->name('pendaftaran.bulk-delete');
});

// ==============================================
// SUPERADMIN ROUTES
// ==============================================
Route::middleware(['auth', 'verified'])->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/users', [DashboardController::class, 'manageUsers'])->name('users.index');
    Route::post('/users', [DashboardController::class, 'storeUser'])->name('users.store');
    Route::put('/users/{user}', [DashboardController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}', [DashboardController::class, 'destroyUser'])->name('users.destroy');
});

// ==============================================
// FALLBACK ROUTE
// ==============================================
Route::fallback(function () {
    return view('errors.404');
});