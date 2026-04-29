<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class JurusanController extends Controller
{
    // Frontend: index jurusan
    public function index()
    {
        $jurusans = Jurusan::all();
        return view('jurusan.index', compact('jurusans'));
    }
    
    // Frontend: show detail jurusan
    public function show($slug)
    {
        $jurusan = Jurusan::where('slug', $slug)->firstOrFail();
        return view('jurusan.show', compact('jurusan'));
    }
    
    // Admin: index jurusan
    public function adminIndex()
    {
        $jurusans = Jurusan::orderBy('kode', 'asc')->paginate(10);
        return view('admin.jurusan.index', compact('jurusans'));
    }
    
    // Admin: form create
    public function create()
    {
        return view('admin.jurusan.create');
    }
    
    // Admin: store jurusan
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:10|unique:jurusans,kode',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'ikon' => 'nullable|string|max:50',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'brosur' => 'nullable|file|mimes:pdf|max:5120',
        ]);
        
        $data = $request->all();
        
        // Handle slug
        if (empty($request->slug)) {
            $data['slug'] = Str::slug($request->nama);
        } else {
            $data['slug'] = Str::slug($request->slug);
        }
        
        // Cek slug duplicate
        $count = Jurusan::where('slug', $data['slug'])->count();
        if ($count > 0) {
            $data['slug'] = $data['slug'] . '-' . ($count + 1);
        }
        
        // Upload logo
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_logo_' . Str::slug($request->nama) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('jurusan/logo', $filename, 'public');
            $data['logo'] = $path;
        }
        
        // Upload brosur
        if ($request->hasFile('brosur')) {
            $file = $request->file('brosur');
            $filename = time() . '_brosur_' . Str::slug($request->nama) . '.pdf';
            $path = $file->storeAs('jurusan/brosur', $filename, 'public');
            $data['brosur'] = $path;
        }
        
        Jurusan::create($data);
        
        return redirect()->route('admin.jurusan.index')
            ->with('success', 'Jurusan berhasil ditambahkan');
    }
    
    // Admin: form edit
    public function edit($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        return view('admin.jurusan.edit', compact('jurusan'));
    }
    
    // Admin: update jurusan
    public function update(Request $request, $id)
    {
        $jurusan = Jurusan::findOrFail($id);
        
        $request->validate([
            'kode' => 'required|string|max:10|unique:jurusans,kode,' . $id,
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'ikon' => 'nullable|string|max:50',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'brosur' => 'nullable|file|mimes:pdf|max:5120',
        ]);
        
        $data = $request->all();
        
        // Handle slug
        if (empty($request->slug)) {
            $data['slug'] = Str::slug($request->nama);
        } else {
            $data['slug'] = Str::slug($request->slug);
        }
        
        // Cek slug duplicate kecuali dirinya sendiri
        $count = Jurusan::where('slug', $data['slug'])->where('id', '!=', $id)->count();
        if ($count > 0) {
            $data['slug'] = $data['slug'] . '-' . ($count + 1);
        }
        
        // Handle hapus logo
        if ($request->has('hapus_logo') && $request->hapus_logo == '1') {
            if ($jurusan->logo && Storage::disk('public')->exists($jurusan->logo)) {
                Storage::disk('public')->delete($jurusan->logo);
            }
            $data['logo'] = null;
        }
        
        // Upload logo baru
        if ($request->hasFile('logo')) {
            if ($jurusan->logo && Storage::disk('public')->exists($jurusan->logo)) {
                Storage::disk('public')->delete($jurusan->logo);
            }
            $file = $request->file('logo');
            $filename = time() . '_logo_' . Str::slug($request->nama) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('jurusan/logo', $filename, 'public');
            $data['logo'] = $path;
        }
        
        // Handle hapus brosur
        if ($request->has('hapus_brosur') && $request->hapus_brosur == '1') {
            if ($jurusan->brosur && Storage::disk('public')->exists($jurusan->brosur)) {
                Storage::disk('public')->delete($jurusan->brosur);
            }
            $data['brosur'] = null;
        }
        
        // Upload brosur baru
        if ($request->hasFile('brosur')) {
            if ($jurusan->brosur && Storage::disk('public')->exists($jurusan->brosur)) {
                Storage::disk('public')->delete($jurusan->brosur);
            }
            $file = $request->file('brosur');
            $filename = time() . '_brosur_' . Str::slug($request->nama) . '.pdf';
            $path = $file->storeAs('jurusan/brosur', $filename, 'public');
            $data['brosur'] = $path;
        }
        
        $jurusan->update($data);
        
        return redirect()->route('admin.jurusan.index')
            ->with('success', 'Jurusan berhasil diperbarui');
    }
    
    // Admin: delete jurusan
    public function destroy($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        
        // Hapus logo jika ada
        if ($jurusan->logo && Storage::disk('public')->exists($jurusan->logo)) {
            Storage::disk('public')->delete($jurusan->logo);
        }
        
        // Hapus brosur jika ada
        if ($jurusan->brosur && Storage::disk('public')->exists($jurusan->brosur)) {
            Storage::disk('public')->delete($jurusan->brosur);
        }
        
        $jurusan->delete();
        
        return redirect()->route('admin.jurusan.index')
            ->with('success', 'Jurusan berhasil dihapus');
    }
}