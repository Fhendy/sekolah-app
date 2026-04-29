<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru';
    
    protected $fillable = [
        'nama',
        'nip',
        'jabatan',
        'bidang',
        'foto',
        'email',
        'no_hp',
        'status',
        'urutan'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}