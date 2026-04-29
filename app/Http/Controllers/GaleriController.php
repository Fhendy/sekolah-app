<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::latest()->paginate(12);
        return view('galeri.index', compact('galeris'));
    }
    
    // Admin Methods
    public function adminIndex()
    {
        $galeris = Galeri::latest()->paginate(10);
        return view('admin.galeri.index', compact('galeris'));
    }
    
    public function create()
    {
        return view('admin.galeri.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:200',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'nullable|string',
            'kategori' => 'nullable|string|max:50',
        ]);
        
        $path = $request->file('gambar')->store('galeri', 'public');
        
        Galeri::create([
            'judul' => $request->judul,
            'gambar' => $path,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
        ]);
        
        return redirect()->route('admin.galeri.index')
                        ->with('success', 'Galeri berhasil ditambahkan');
    }
    
    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.edit', compact('galeri'));
    }
    
    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'judul' => 'required|string|max:200',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'nullable|string',
            'kategori' => 'nullable|string|max:50',
        ]);
        
        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
        ];
        
        if ($request->hasFile('gambar')) {
            if ($galeri->gambar) {
                Storage::disk('public')->delete($galeri->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('galeri', 'public');
        }
        
        $galeri->update($data);
        
        return redirect()->route('admin.galeri.index')
                        ->with('success', 'Galeri berhasil diupdate');
    }
    
    public function destroy(Galeri $galeri)
    {
        if ($galeri->gambar) {
            Storage::disk('public')->delete($galeri->gambar);
        }
        $galeri->delete();
        
        return redirect()->route('admin.galeri.index')
                        ->with('success', 'Galeri berhasil dihapus');
    }
}