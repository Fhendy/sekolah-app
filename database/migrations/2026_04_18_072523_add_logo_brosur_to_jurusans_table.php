<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('jurusans', function (Blueprint $table) {
            $table->string('logo')->nullable()->after('ikon');
            $table->string('brosur')->nullable()->after('logo');
        });
    }

    public function down()
    {
        Schema::table('jurusans', function (Blueprint $table) {
            $table->dropColumn(['logo', 'brosur']);
        });
    }
};