// database/migrations/2024_01_01_000002_create_jurusans_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jurusans', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 10)->unique(); // RPL, PBS, TKR, PHT
            $table->string('nama');
            $table->text('deskripsi');
            $table->string('ikon')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jurusans');
    }
};