<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('baddebs', function (Blueprint $table) {
            //
            $table->string('nama_pelanggan',255)->change();
            $table->string('id_pln',255)->change();
            $table->string('nik',255)->change();
            $table->string('telp',255)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('baddebs', function (Blueprint $table) {
            //
        });
    }
};
