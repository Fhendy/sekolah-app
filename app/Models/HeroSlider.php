<?php
// app/Models/HeroSlider.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSlider extends Model
{
    protected $table = 'hero_sliders';
    
    protected $fillable = [
        'gambar',
        'gambar_mobile',
        'link',
        'urutan',
        'aktif'
    ];
    
    protected $casts = [
        'aktif' => 'boolean'
    ];
}
?>