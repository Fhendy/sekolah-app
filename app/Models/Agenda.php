<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'tempat',
        'tipe'
    ];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];

    public function getStatusAttribute()
    {
        $now = now();
        if ($now < $this->tanggal_mulai) {
            return 'Akan Datang';
        } elseif ($now > $this->tanggal_selesai) {
            return 'Selesai';
        } else {
            return 'Berlangsung';
        }
    }
}