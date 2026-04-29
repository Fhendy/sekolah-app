<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pendaftaran')->unique();
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->date('tanggal_lahir');
            $table->string('kota_kabupaten');
            $table->string('asal_sekolah');
            $table->string('no_wa_siswa');
            $table->string('no_wa_ortu');
            $table->string('jurusan');
            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->datetime('tanggal_daftar');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pendaftaran');
    }
};