<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    // Frontend: index guru
    public function index()
    {
        $guruList = Guru::where('status', 'aktif')->orderBy('urutan', 'asc')->get();
        return view('profil.guru', compact('guruList'));
    }

    // Admin: index guru
    public function adminIndex()
    {
        $guru = Guru::orderBy('urutan', 'asc')->get();
        return view('admin.guru.index', compact('guru'));
    }

    // Admin: form create
    public function create()
    {
        return view('admin.guru.create');
    }

    // Admin: store guru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'bidang' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'no_hp' => 'nullable|string|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'nullable|in:aktif,nonaktif',
            'urutan' => 'nullable|integer',
        ]);

        $data = $request->all();

        // Handle foto upload
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9]/', '_', $request->nama) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('guru', $filename, 'public');
            $data['foto'] = $path;
        }

        Guru::create($data);

        return redirect()->route('admin.guru.index')
            ->with('success', 'Guru berhasil ditambahkan');
    }

    // Admin: form edit
    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        return view('admin.guru.edit', compact('guru'));
    }

    // Admin: update guru
    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'bidang' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'no_hp' => 'nullable|string|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'nullable|in:aktif,nonaktif',
            'urutan' => 'nullable|integer',
        ]);

        $data = $request->all();

        // Handle hapus foto
        if ($request->has('hapus_foto') && $request->hapus_foto == '1') {
            if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
                Storage::disk('public')->delete($guru->foto);
            }
            $data['foto'] = null;
        }

        // Handle upload foto baru
        if ($request->hasFile('foto')) {
            if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
                Storage::disk('public')->delete($guru->foto);
            }

            $file = $request->file('foto');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9]/', '_', $request->nama) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('guru', $filename, 'public');
            $data['foto'] = $path;
        }

        $guru->update($data);

        return redirect()->route('admin.guru.index')
            ->with('success', 'Guru berhasil diperbarui');
    }

    // Admin: delete guru
    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);

        if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
            Storage::disk('public')->delete($guru->foto);
        }

        $guru->delete();

        return redirect()->route('admin.guru.index')
            ->with('success', 'Guru berhasil dihapus');
    }
}