<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    // Frontend: index berita
    public function index(Request $request)
    {
        $query = Berita::query();
        
        if ($request->has('search') && $request->search != '') {
            $query->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('konten', 'like', '%' . $request->search . '%');
        }
        
        $beritas = $query->orderBy('tanggal', 'desc')->paginate(9);
        
        return view('berita.index', compact('beritas'));
    }
    
    // Frontend: show detail berita
    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        return view('berita.show', compact('berita'));
    }
    
    // Admin: index berita
    public function adminIndex()
    {
        $beritas = Berita::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.berita.index', compact('beritas'));
    }
    
    // Admin: form create
    public function create()
    {
        return view('admin.berita.create');
    }
    
    // Admin: store berita
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'penulis' => 'nullable|string|max:100',
        ]);
        
        $data = $request->all();
        
        // Handle slug
        if (empty($request->slug)) {
            $data['slug'] = Str::slug($request->judul);
        } else {
            $data['slug'] = Str::slug($request->slug);
        }
        
        // Cek slug duplicate
        $count = Berita::where('slug', $data['slug'])->count();
        if ($count > 0) {
            $data['slug'] = $data['slug'] . '-' . ($count + 1);
        }
        
        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . Str::slug($request->judul) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('berita', $filename, 'public');
            $data['gambar'] = $path;
        }
        
        // Set penulis default jika kosong
        if (empty($data['penulis'])) {
            $data['penulis'] = auth()->user()->name ?? 'Admin';
        }
        
        Berita::create($data);
        
        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan');
    }
    
    // Admin: form edit
    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }
    
    // Admin: update berita
    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);
        
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'penulis' => 'nullable|string|max:100',
        ]);
        
        $data = $request->all();
        
        // Handle slug
        if (empty($request->slug)) {
            $data['slug'] = Str::slug($request->judul);
        } else {
            $data['slug'] = Str::slug($request->slug);
        }
        
        // Cek slug duplicate kecuali dirinya sendiri
        $count = Berita::where('slug', $data['slug'])->where('id', '!=', $id)->count();
        if ($count > 0) {
            $data['slug'] = $data['slug'] . '-' . ($count + 1);
        }
        
        // Handle hapus gambar (checkbox)
        if ($request->has('hapus_gambar') && $request->hapus_gambar == '1') {
            if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $data['gambar'] = null;
        }
        
        // Handle upload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
                Storage::disk('public')->delete($berita->gambar);
            }
            
            $file = $request->file('gambar');
            $filename = time() . '_' . Str::slug($request->judul) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('berita', $filename, 'public');
            $data['gambar'] = $path;
        }
        
        // Set penulis default jika kosong
        if (empty($data['penulis'])) {
            $data['penulis'] = auth()->user()->name ?? 'Admin';
        }
        
        $berita->update($data);
        
        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui');
    }
    
    // Admin: delete berita
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        
        // Hapus gambar jika ada
        if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
            Storage::disk('public')->delete($berita->gambar);
        }
        
        $berita->delete();
        
        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus');
    }
}