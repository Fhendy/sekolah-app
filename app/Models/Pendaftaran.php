<?php
// app/Models/Pendaftaran.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = 'pendaftarans';
    
    protected $fillable = [
        'kode_pendaftaran',
        'nama_lengkap',
        'jenis_kelamin',
        'tanggal_lahir',
        'kota_kabupaten',
        'asal_sekolah',
        'no_wa_siswa',
        'no_wa_ortu',
        'jurusan',
        'tanggal_daftar',
        'status',
    ];
    
    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_daftar' => 'datetime',
    ];
}
?>