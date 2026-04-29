// database/migrations/2024_01_01_000006_create_statistiks_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('statistiks', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah_siswa')->default(0);
            $table->integer('jumlah_alumni')->default(0);
            $table->integer('jumlah_guru')->default(0);
            $table->year('tahun_berdiri')->default(2000);
            $table->timestamps();
        });
        
        // Insert default data
        DB::table('statistiks')->insert([
            'jumlah_siswa' => 1250,
            'jumlah_alumni' => 5800,
            'jumlah_guru' => 85,
            'tahun_berdiri' => 1998,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('statistiks');
    }
};