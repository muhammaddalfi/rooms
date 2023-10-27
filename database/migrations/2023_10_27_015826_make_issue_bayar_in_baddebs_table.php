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
            $table->enum('issue_bayar',['kliring','error_flagging','tidak'])->nullable()->change();
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
