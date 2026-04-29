<?php
// database/migrations/xxxx_xx_xx_create_hero_sliders_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hero_sliders', function (Blueprint $table) {
            $table->id();
            $table->string('gambar')->nullable();
            $table->string('gambar_mobile')->nullable();
            $table->string('link')->nullable(); // optional: link jika diklik
            $table->integer('urutan')->default(0);
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hero_sliders');
    }
};
?>