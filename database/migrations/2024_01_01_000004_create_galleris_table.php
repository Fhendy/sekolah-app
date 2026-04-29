// database/migrations/2024_01_01_000004_create_galleris_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('galeris', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('gambar');
            $table->text('deskripsi')->nullable();
            $table->string('kategori')->nullable(); // kegiatan, prestasi, dll
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('galeris');
    }
};