<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'gambar',
        'penulis',
        'tanggal',
        'is_published'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'is_published' => 'boolean',
    ];

    public function getExcerptAttribute()
    {
        return strip_tags(substr($this->konten, 0, 150)) . '...';
    }
}