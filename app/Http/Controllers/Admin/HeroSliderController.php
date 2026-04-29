<?php
// app/Http/Controllers/Admin/HeroSliderController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSliderController extends Controller
{
    public function index()
    {
        $heroSliders = HeroSlider::orderBy('urutan', 'asc')->get();
        return view('admin.hero-slider.index', compact('heroSliders'));
    }

    public function create()
    {
        return view('admin.hero-slider.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gambar_mobile' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'link' => 'nullable|url',
            'urutan' => 'required|integer|min:0',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('hero-slider', 'public');
        }

        if ($request->hasFile('gambar_mobile')) {
            $data['gambar_mobile'] = $request->file('gambar_mobile')->store('hero-slider', 'public');
        }

        $data['aktif'] = $request->has('aktif');

        HeroSlider::create($data);

        return redirect()->route('admin.hero-slider.index')
            ->with('success', 'Hero slider berhasil ditambahkan');
    }

    public function edit($id)
    {
        $heroSlider = HeroSlider::findOrFail($id);
        return view('admin.hero-slider.edit', compact('heroSlider'));
    }

    public function update(Request $request, $id)
    {
        $heroSlider = HeroSlider::findOrFail($id);

        $request->validate([
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gambar_mobile' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'link' => 'nullable|url',
            'urutan' => 'required|integer|min:0',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($heroSlider->gambar && Storage::disk('public')->exists($heroSlider->gambar)) {
                Storage::disk('public')->delete($heroSlider->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('hero-slider', 'public');
        }

        if ($request->hasFile('gambar_mobile')) {
            if ($heroSlider->gambar_mobile && Storage::disk('public')->exists($heroSlider->gambar_mobile)) {
                Storage::disk('public')->delete($heroSlider->gambar_mobile);
            }
            $data['gambar_mobile'] = $request->file('gambar_mobile')->store('hero-slider', 'public');
        }

        $data['aktif'] = $request->has('aktif');

        $heroSlider->update($data);

        return redirect()->route('admin.hero-slider.index')
            ->with('success', 'Hero slider berhasil diupdate');
    }

    public function destroy($id)
    {
        $heroSlider = HeroSlider::findOrFail($id);

        if ($heroSlider->gambar && Storage::disk('public')->exists($heroSlider->gambar)) {
            Storage::disk('public')->delete($heroSlider->gambar);
        }
        if ($heroSlider->gambar_mobile && Storage::disk('public')->exists($heroSlider->gambar_mobile)) {
            Storage::disk('public')->delete($heroSlider->gambar_mobile);
        }

        $heroSlider->delete();

        return redirect()->route('admin.hero-slider.index')
            ->with('success', 'Hero slider berhasil dihapus');
    }

    public function updateStatus($id)
    {
        $heroSlider = HeroSlider::findOrFail($id);
        $heroSlider->aktif = !$heroSlider->aktif;
        $heroSlider->save();

        $status = $heroSlider->aktif ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()->with('success', "Hero slider berhasil {$status}");
    }
}
?>