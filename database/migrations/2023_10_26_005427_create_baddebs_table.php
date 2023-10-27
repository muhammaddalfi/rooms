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
        Schema::create('baddebs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelanggan',55);
            $table->string('id_pln',20);
            $table->string('nik',15);
            $table->string('telp',15);
            $table->string('alamat',255);
            $table->enum('layanan',['10','20','35','50','100']);
            $table->string('tagihan',10);
            $table->enum('follow_up',['chat','call','visit'])->nullable();
            $table->enum('is_minat',['ya','tidak','pending'])->nullable();
            $table->dateTime('waktu_bayar')->nullable();
            $table->integer('kategori_debt')->nullable();
            $table->string('gambar_bayar_pelanggan',100)->nullable();
            $table->string('gambar_bayar_icrm',100)->nullable();
            $table->enum('issue_bayar',['kliring','error_flagging'])->nullable();
            $table->enum('status_bayar',['close','pending','lose'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baddebs');
    }
};
