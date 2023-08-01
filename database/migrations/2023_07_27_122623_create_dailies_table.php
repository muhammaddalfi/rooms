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
        Schema::create('dailies', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('lat',55);
            $table->string('lng',55);
            $table->enum('kategori_dinas',['Ya','Tidak']);
            $table->string('nama_olt',255);
            $table->integer('kegiatan_id');
            $table->string('catatan',255)->nullable();
            $table->string('gambar',100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dailies');
    }
};
