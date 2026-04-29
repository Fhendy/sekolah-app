<?php
// database/migrations/2026_04_19_000001_create_pendaftarans_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pendaftaran')->unique();
            $table->string('nama_lengkap', 100);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->date('tanggal_lahir');
            $table->string('kota_kabupaten', 100);
            $table->string('asal_sekolah', 150);
            $table->string('no_wa_siswa', 15);
            $table->string('no_wa_ortu', 15);
            $table->string('jurusan', 100);
            $table->datetime('tanggal_daftar');
            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->timestamps();
            
            // Unique constraints
            $table->unique(['nama_lengkap', 'tanggal_lahir'], 'unique_nama_tanggal');
            $table->unique('no_wa_siswa', 'unique_no_wa_siswa');
            $table->unique('no_wa_ortu', 'unique_no_wa_ortu');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pendaftarans');
    }
};
?>