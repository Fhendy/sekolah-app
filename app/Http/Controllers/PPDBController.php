<?php
// app/Http/Controllers/PPDBController.php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PPDBController extends Controller
{
    // ==============================================
    // PUBLIC METHODS (Frontend)
    // ==============================================
    
    public function showForm()
    {
        $jurusans = Jurusan::all();
        
        return view('ppdb.index', compact('jurusans'));
    }

    public function submit(Request $request)
    {
        // 1. Rate limiting per IP (maksimal 3 percobaan per 10 menit)
        $ipAddress = $request->ip();
        $rateLimitKey = 'ppdb_attempt_' . $ipAddress;
        
        if (Cache::has($rateLimitKey)) {
            $attempts = Cache::get($rateLimitKey);
            if ($attempts >= 3) {
                return back()->withInput()->withErrors([
                    'error' => 'Terlalu banyak percobaan pendaftaran. Silakan coba lagi setelah 10 menit.'
                ]);
            }
        }

        // 2. Validasi data
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:100|regex:/^[a-zA-Z\s\.,\-]+$/',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date|before:today|after:2000-01-01',
            'kota_kabupaten' => 'required|string|max:100',
            'asal_sekolah' => 'required|string|max:150',
            'no_wa_siswa' => 'required|string|max:15|regex:/^[0-9]{10,13}$/',
            'no_wa_ortu' => 'required|string|max:15|regex:/^[0-9]{10,13}$/',
            'jurusan' => 'required|string|max:100',
        ]);

        // 3. Cek duplikasi Nama + Tanggal Lahir
        $existingByNameDate = Pendaftaran::where('nama_lengkap', $validated['nama_lengkap'])
            ->where('tanggal_lahir', $validated['tanggal_lahir'])
            ->first();

        if ($existingByNameDate) {
            return back()->withInput()->withErrors([
                'nama_lengkap' => 'Pendaftar dengan nama dan tanggal lahir ini sudah terdaftar sebelumnya.'
            ]);
        }

        // 4. Cek duplikasi No WhatsApp Siswa
        $existingByWa = Pendaftaran::where('no_wa_siswa', $validated['no_wa_siswa'])->first();
        if ($existingByWa) {
            return back()->withInput()->withErrors([
                'no_wa_siswa' => 'Nomor WhatsApp siswa sudah digunakan untuk pendaftaran sebelumnya.'
            ]);
        }

        // 5. Cek duplikasi No WhatsApp Orang Tua
        $existingByWaOrtu = Pendaftaran::where('no_wa_ortu', $validated['no_wa_ortu'])->first();
        if ($existingByWaOrtu) {
            return back()->withInput()->withErrors([
                'no_wa_ortu' => 'Nomor WhatsApp orang tua sudah digunakan untuk pendaftaran sebelumnya.'
            ]);
        }

        // 6. Generate kode pendaftaran unik
        $kodePendaftaran = $this->generateUniqueCode();

        // 7. Simpan ke database dengan transaction
        try {
            DB::beginTransaction();
            
            $pendaftaran = Pendaftaran::create([
                'kode_pendaftaran' => $kodePendaftaran,
                'nama_lengkap' => $validated['nama_lengkap'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'kota_kabupaten' => $validated['kota_kabupaten'],
                'asal_sekolah' => $validated['asal_sekolah'],
                'no_wa_siswa' => $validated['no_wa_siswa'],
                'no_wa_ortu' => $validated['no_wa_ortu'],
                'jurusan' => $validated['jurusan'],
                'tanggal_daftar' => now(),
                'status' => 'pending',
            ]);
            
            DB::commit();
            
            // 8. Update rate limit
            if (Cache::has($rateLimitKey)) {
                Cache::increment($rateLimitKey);
            } else {
                Cache::put($rateLimitKey, 1, 600); // 10 menit
            }
            
            // 9. Redirect ke halaman sukses
            return redirect()->route('ppdb.success', ['kode' => $kodePendaftaran])
                ->with('success', 'Pendaftaran berhasil!');
            
        } catch (\Illuminate\Database\UniqueConstraintViolationException $e) {
            DB::rollBack();
            
            if (str_contains($e->getMessage(), 'unique_nama_tanggal')) {
                return back()->withInput()->withErrors([
                    'nama_lengkap' => 'Pendaftar dengan nama dan tanggal lahir ini sudah terdaftar.'
                ]);
            }
            if (str_contains($e->getMessage(), 'unique_no_wa_siswa')) {
                return back()->withInput()->withErrors([
                    'no_wa_siswa' => 'Nomor WhatsApp siswa sudah terdaftar.'
                ]);
            }
            if (str_contains($e->getMessage(), 'unique_no_wa_ortu')) {
                return back()->withInput()->withErrors([
                    'no_wa_ortu' => 'Nomor WhatsApp orang tua sudah terdaftar.'
                ]);
            }
            
            return back()->withInput()->withErrors([
                'error' => 'Data sudah terdaftar. Silakan gunakan data yang berbeda.'
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors([
                'error' => 'Terjadi kesalahan sistem. Silakan coba lagi.'
            ]);
        }
    }
    
    private function generateUniqueCode()
    {
        $tahun = date('Y');
        $bulan = date('m');
        $random = strtoupper(Str::random(4));
        $code = "PPDB-{$tahun}{$bulan}-{$random}";
        
        while (Pendaftaran::where('kode_pendaftaran', $code)->exists()) {
            $random = strtoupper(Str::random(4));
            $code = "PPDB-{$tahun}{$bulan}-{$random}";
        }
        
        return $code;
    }
    
    public function success($kode)
    {
        $pendaftaran = Pendaftaran::where('kode_pendaftaran', $kode)->firstOrFail();
        return view('ppdb.success', compact('pendaftaran'));
    }

    // ==============================================
    // ADMIN METHODS
    // ==============================================
    
    public function adminIndex(Request $request)
    {
        $query = Pendaftaran::query();
        
        // Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('kode_pendaftaran', 'like', "%{$search}%")
                  ->orWhere('jurusan', 'like', "%{$search}%")
                  ->orWhere('no_wa_siswa', 'like', "%{$search}%");
            });
        }
        
        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter tanggal
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        $pendaftarans = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('admin.pendaftaran.index', compact('pendaftarans'));
    }

    public function adminDetail($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        return view('admin.pendaftaran.detail', compact('pendaftaran'));
    }

    public function adminUpdateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,verified,rejected'
        ]);
        
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->status = $validated['status'];
        $pendaftaran->save();
        
        return redirect()->back()->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

    public function adminDestroy($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->delete();
        
        return redirect()->route('admin.pendaftaran.index')->with('success', 'Data pendaftaran berhasil dihapus.');
    }

   public function adminBulkDestroy(Request $request)
{
    $ids = $request->input('ids');
    
    if (empty($ids)) {
        return redirect()->back()->with('error', 'Tidak ada data yang dipilih.');
    }
    
    $deleted = Pendaftaran::whereIn('id', $ids)->delete();
    
    return redirect()->route('admin.pendaftaran.index')
        ->with('success', $deleted . ' data pendaftaran berhasil dihapus.');
}
}