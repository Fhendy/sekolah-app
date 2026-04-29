<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistik extends Model
{
    use HasFactory;

    protected $fillable = [
        'jumlah_siswa',
        'jumlah_alumni',
        'jumlah_guru',
        'tahun_berdiri'
    ];
}