<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('agendas', function (Blueprint $table) {
            // Ubah panjang kolom tipe menjadi 50
            $table->string('tipe', 50)->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('agendas', function (Blueprint $table) {
            $table->string('tipe', 20)->nullable()->change();
        });
    }
};