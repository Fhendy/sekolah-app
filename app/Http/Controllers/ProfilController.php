<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function identitas()
    {
        return view('profil.identitas');
    }

    public function visiMisi()
    {
        return view('profil.visi-misi');
    }

    public function sejarah()
    {
        return view('profil.sejarah');
    }

    public function struktur()
    {
        return view('profil.struktur');
    }

    public function fasilitas()
    {
        return view('profil.fasilitas');
    }

    public function prestasi()
    {
        return view('profil.prestasi');
    }

    public function mars()
    {
        return view('profil.mars');
    }

    public function eskul()
    {
        return view('profil.eskul');
    }
}