<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('zonasi')) {
            Schema::create('zonasi', function (Blueprint $table) {
                $table->id();
                $table->string('zona', 100);
                $table->string('nomor_lorong', 50);
                $table->string('kode_rak', 50);
                $table->integer('kapasitas');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('zonasi');
    }
};
