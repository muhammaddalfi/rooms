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
            $table->string('nik')->nullable()->change();
            $table->string('telp')->nullable()->change();
            $table->string('alamat')->nullable()->change();
            $table->enum('layanan',['10','20','35','50','100'])->nullable()->change();
            $table->string('tagihan')->nullable()->change();

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
