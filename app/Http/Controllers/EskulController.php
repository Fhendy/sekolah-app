<?php

namespace App\Http\Controllers;

use App\Models\Eskul;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EskulController extends Controller
{
    // Frontend: index eskul
    public function index()
    {
        $eskuls = Eskul::where('status', 'aktif')->orderBy('nama', 'asc')->paginate(9);
        return view('eskul.index', compact('eskuls'));
    }

    // Frontend: show detail eskul
    public function show($slug)
    {
        $eskul = Eskul::where('slug', $slug)->firstOrFail();
        $eskulLain = Eskul::where('status', 'aktif')->where('id', '!=', $eskul->id)->limit(4)->get();
        return view('eskul.show', compact('eskul', 'eskulLain'));
    }

    // Admin: index eskul
    public function adminIndex()
    {
        $eskuls = Eskul::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.eskul.index', compact('eskuls'));
    }

    // Admin: form create
    public function create()
    {
        return view('admin.eskul.create');
    }

    // Admin: store eskul
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'pembina' => 'nullable|string|max:255',
            'jadwal' => 'nullable|string|max:255',
            'tempat' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|in:aktif,nonaktif',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->nama);

        // Cek slug duplicate
        $count = Eskul::where('slug', $data['slug'])->count();
        if ($count > 0) {
            $data['slug'] = $data['slug'] . '-' . ($count + 1);
        }

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . Str::slug($request->nama) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('eskul', $filename, 'public');
            $data['gambar'] = $path;
        }

        Eskul::create($data);

        return redirect()->route('admin.eskul.index')
            ->with('success', 'Ekstrakurikuler berhasil ditambahkan');
    }

    // Admin: form edit
    public function edit($id)
    {
        $eskul = Eskul::findOrFail($id);
        return view('admin.eskul.edit', compact('eskul'));
    }

    // Admin: update eskul
    public function update(Request $request, $id)
    {
        $eskul = Eskul::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'pembina' => 'nullable|string|max:255',
            'jadwal' => 'nullable|string|max:255',
            'tempat' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|in:aktif,nonaktif',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->nama);

        // Cek slug duplicate kecuali dirinya sendiri
        $count = Eskul::where('slug', $data['slug'])->where('id', '!=', $id)->count();
        if ($count > 0) {
            $data['slug'] = $data['slug'] . '-' . ($count + 1);
        }

        // Handle hapus gambar
        if ($request->has('hapus_gambar') && $request->hapus_gambar == '1') {
            if ($eskul->gambar && Storage::disk('public')->exists($eskul->gambar)) {
                Storage::disk('public')->delete($eskul->gambar);
            }
            $data['gambar'] = null;
        }

        // Handle upload gambar baru
        if ($request->hasFile('gambar')) {
            if ($eskul->gambar && Storage::disk('public')->exists($eskul->gambar)) {
                Storage::disk('public')->delete($eskul->gambar);
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . Str::slug($request->nama) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('eskul', $filename, 'public');
            $data['gambar'] = $path;
        }

        $eskul->update($data);

        return redirect()->route('admin.eskul.index')
            ->with('success', 'Ekstrakurikuler berhasil diperbarui');
    }

    // Admin: delete eskul
    public function destroy($id)
    {
        $eskul = Eskul::findOrFail($id);

        if ($eskul->gambar && Storage::disk('public')->exists($eskul->gambar)) {
            Storage::disk('public')->delete($eskul->gambar);
        }

        $eskul->delete();

        return redirect()->route('admin.eskul.index')
            ->with('success', 'Ekstrakurikuler berhasil dihapus');
    }
}