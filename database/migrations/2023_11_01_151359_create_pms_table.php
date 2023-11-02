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
        Schema::create('pms', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tgl_mulai');
            $table->dateTime('tgl_selesai');
            $table->string('id_lokasi')->nullable();
            $table->string('user_id')->nullable();
            $table->string('latitude',55)->nullable();
            $table->string('longitude',55)->nullable();

            
            $table->string('is_olt')->nullable()->default(0);
            $table->string('dokumentasi_olt',100)->nullable();

            $table->enum('kondisi_modul_olt',['OK','NOK'])->nullable();
            $table->string('catatan_modul_olt',100)->nullable();

            $table->enum('kondisi_port_olt',['OK','NOK'])->nullable();
            $table->string('catatan_port_olt',100)->nullable();

            $table->enum('kondisi_all_sfp_olt',['OK','NOK'])->nullable();
            $table->string('catatan_all_sfp_olt',100)->nullable();

            $table->enum('kondisi_ps_olt',['OK','NOK'])->nullable();
            $table->string('catatan_ps_olt',100)->nullable();

            $table->enum('kondisi_bat_olt',['OK','NOK'])->nullable();
            $table->string('catatan_bat_olt',100)->nullable();

            $table->enum('kondisi_bat_bck_olt',['OK','NOK'])->nullable();
            $table->string('catatan_bat_bck_olt',100)->nullable();

            $table->enum('kondisi_suhu_kabinet',['OK','NOK'])->nullable();
            $table->string('catatan_suhu_kabinet',100)->nullable();

            $table->string('is_feeder')->nullable()->default(0);
            $table->string('dokumentasi_feeder',100)->nullable();

            $table->enum('kabel_jatuh',['YA','TIDAK'])->nullable();
            $table->string('catatan_kabel_jatuh',100)->nullable();

            $table->enum('kabel_andongan',['YA','TIDAK'])->nullable();
            $table->string('catatan_kabel_andongan',100)->nullable();

            $table->enum('kabel_putus',['YA','TIDAK'])->nullable();
            $table->string('catatan_kabel_putus',100)->nullable();

            $table->enum('kondisi_kabel',['YA','TIDAK'])->nullable();
            $table->string('catatan_kondisi_kabel',100)->nullable();

            $table->enum('kabel_acc',['YA','TIDAK'])->nullable();
            $table->string('catatan_kabel_acc',100)->nullable();

            $table->enum('kondisi_acc',['YA','TIDAK'])->nullable();
            $table->string('catatan_kondisi_acc',100)->nullable();

            $table->enum('jb',['YA','TIDAK'])->nullable();
            $table->string('catatan_jb',100)->nullable();

            $table->enum('kondisi_jb',['OK','NOK'])->nullable();
            $table->string('catatan_kondisi_jb',100)->nullable();

            $table->enum('core_jb',['YA','TIDAK'])->nullable();
            $table->string('catatan_core_jb',100)->nullable();

            $table->enum('posisi_jb',['YA','TIDAK'])->nullable();
            $table->string('catatan_posisi_jb',100)->nullable();
            

            $table->string('is_fdt')->nullable()->default(0);
            $table->string('dokumentasi_fdt',100)->nullable();

            $table->enum('box_fdt',['YA','TIDAK'])->nullable();
            $table->string('catatan_box_fdt',100)->nullable();

            $table->enum('kebersihan_fdt',['YA','TIDAK'])->nullable();
            $table->string('catatan_kebersihan_fdt',100)->nullable();

            $table->enum('all_port_fdt',['YA','TIDAK'])->nullable();
            $table->string('catatan_all_port_fdt',100)->nullable();

            $table->enum('port_fdt_redaman',['YA','TIDAK'])->nullable();
            $table->string('catatan_port_fdt_redaman',100)->nullable();

            $table->string('is_fat')->nullable()->default(0);
            $table->string('dokumentasi_fat',100)->nullable();

            $table->enum('box_fat',['YA','TIDAK'])->nullable();
            $table->string('catatan_box_fat',100)->nullable();

            $table->enum('kebersihan_fat',['YA','TIDAK'])->nullable();
            $table->string('catatan_kebersihan_fat',100)->nullable();

            $table->enum('all_port_fat',['YA','TIDAK'])->nullable();
            $table->string('catatan_all_port_fat',100)->nullable();

            $table->enum('port_fat_redaman',['YA','TIDAK'])->nullable();
            $table->string('catatan_port_fat_redaman',100)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pms');
    }
};
