<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Agenda;
use App\Models\Statistik;
use App\Models\User;
use App\Models\HeroSlider;
use App\Models\Pendaftaran;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    // Frontend Methods
public function index()
{
    $heroSliders = HeroSlider::where('aktif', true)->orderBy('urutan', 'asc')->get();
    $jurusans = Jurusan::all();
    $beritas = Berita::orderBy('created_at', 'desc')->take(3)->get();
    $statistik = Statistik::first();
    $agendas = Agenda::where('tanggal_mulai', '>=', now())
                    ->orderBy('tanggal_mulai', 'asc')
                    ->take(5)
                    ->get();
    $prestasiHome = Prestasi::where('status', 'aktif')->orderBy('urutan', 'asc')->limit(3)->get();
    
    return view('home', compact('heroSliders', 'jurusans', 'beritas', 'statistik', 'agendas', 'prestasiHome'));
}
    
    public function tentang()
    {
        return view('tentang');
    }
    
    public function kontak()
    {
        return view('kontak');
    }
    
    public function daftar()
    {
        $jurusans = Jurusan::all();
        return view('daftar', compact('jurusans'));
    }
    
    // Admin Dashboard
    public function adminDashboard()
    {
        $totalBerita = Berita::count();
        $totalJurusan = Jurusan::count();
        $totalGaleri = Galeri::count();
        $totalAgenda = Agenda::count();
        $totalUsers = User::count();
        $recentBerita = Berita::latest()->take(5)->get();
        $upcomingAgenda = Agenda::where('tanggal_mulai', '>=', now())
                               ->orderBy('tanggal_mulai', 'asc')
                               ->take(5)
                               ->get();
        
        return view('admin.dashboard', compact(
            'totalBerita', 'totalJurusan', 'totalGaleri', 
            'totalAgenda', 'totalUsers', 'recentBerita', 'upcomingAgenda'
        ));
    }
    
    // Statistik Management
    public function editStatistik()
    {
        $statistik = Statistik::first();
        if (!$statistik) {
            $statistik = Statistik::create([
                'jumlah_siswa' => 0,
                'jumlah_alumni' => 0,
                'jumlah_guru' => 0,
                'tahun_berdiri' => date('Y'),
            ]);
        }
        return view('admin.statistik.edit', compact('statistik'));
    }
    
    public function updateStatistik(Request $request)
    {
        $validated = $request->validate([
            'jumlah_siswa' => 'required|integer|min:0',
            'jumlah_alumni' => 'required|integer|min:0',
            'jumlah_guru' => 'required|integer|min:0',
            'tahun_berdiri' => 'required|integer|min:1900|max:' . date('Y'),
        ]);
        
        $statistik = Statistik::first();
        if (!$statistik) {
            $statistik = new Statistik();
        }
        
        foreach ($validated as $key => $value) {
            $statistik->$key = $value;
        }
        $statistik->save();
        
        return redirect()->route('admin.dashboard')
                        ->with('success', 'Statistik berhasil diupdate');
    }
    
    // User Management (Superadmin)
    public function manageUsers()
    {
        $users = User::all();
        return view('superadmin.users', compact('users'));
    }
    
    public function storeUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:superadmin,admin,user',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal menambahkan user. Periksa kembali data Anda.');
        }
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        
        return redirect()->back()->with('success', 'User berhasil ditambahkan');
    }
    
    public function updateUser(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:superadmin,admin,user',
            'password' => 'nullable|min:6',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal mengupdate user. Periksa kembali data Anda.');
        }
        
        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];
        
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }
        
        $user->update($updateData);
        
        return redirect()->back()->with('success', 'User berhasil diupdate');
    }
    
    public function destroyUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Tidak bisa menghapus akun sendiri');
        }
        
        $user->delete();
        return redirect()->back()->with('success', 'User berhasil dihapus');
    }
    
}