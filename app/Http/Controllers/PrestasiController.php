<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    // Frontend: index prestasi
    public function index()
    {
        $prestasi = Prestasi::where('status', 'aktif')->orderBy('urutan', 'asc')->get();
        return view('profil.prestasi', compact('prestasi'));
    }

    // Admin: index prestasi
    public function adminIndex()
    {
        $prestasi = Prestasi::orderBy('urutan', 'asc')->get();
        return view('admin.prestasi.index', compact('prestasi'));
    }

    // Admin: form create
    public function create()
    {
        return view('admin.prestasi.create');
    }

    // Admin: store prestasi
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'nullable|string|max:100',
            'tingkat' => 'nullable|string|max:100',
            'tahun' => 'nullable|string|max:10',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'nullable|in:aktif,nonaktif',
            'urutan' => 'nullable|integer',
        ]);

        $data = $request->all();

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9]/', '_', $request->judul) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('prestasi', $filename, 'public');
            $data['gambar'] = $path;
        }

        Prestasi::create($data);

        return redirect()->route('admin.prestasi.index')
            ->with('success', 'Prestasi berhasil ditambahkan');
    }

    // Admin: form edit
    public function edit($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        return view('admin.prestasi.edit', compact('prestasi'));
    }

    // Admin: update prestasi
    public function update(Request $request, $id)
    {
        $prestasi = Prestasi::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'nullable|string|max:100',
            'tingkat' => 'nullable|string|max:100',
            'tahun' => 'nullable|string|max:10',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'nullable|in:aktif,nonaktif',
            'urutan' => 'nullable|integer',
        ]);

        $data = $request->all();

        // Handle hapus gambar
        if ($request->has('hapus_gambar') && $request->hapus_gambar == '1') {
            if ($prestasi->gambar && Storage::disk('public')->exists($prestasi->gambar)) {
                Storage::disk('public')->delete($prestasi->gambar);
            }
            $data['gambar'] = null;
        }

        // Handle upload gambar baru
        if ($request->hasFile('gambar')) {
            if ($prestasi->gambar && Storage::disk('public')->exists($prestasi->gambar)) {
                Storage::disk('public')->delete($prestasi->gambar);
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9]/', '_', $request->judul) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('prestasi', $filename, 'public');
            $data['gambar'] = $path;
        }

        $prestasi->update($data);

        return redirect()->route('admin.prestasi.index')
            ->with('success', 'Prestasi berhasil diperbarui');
    }

    // Admin: delete prestasi
    public function destroy($id)
    {
        $prestasi = Prestasi::findOrFail($id);

        if ($prestasi->gambar && Storage::disk('public')->exists($prestasi->gambar)) {
            Storage::disk('public')->delete($prestasi->gambar);
        }

        $prestasi->delete();

        return redirect()->route('admin.prestasi.index')
            ->with('success', 'Prestasi berhasil dihapus');
    }
}