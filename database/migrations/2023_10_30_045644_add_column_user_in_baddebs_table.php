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
            $table->integer('user_id')->nullable();
            $table->string('keterangan',255)->nullable();
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
