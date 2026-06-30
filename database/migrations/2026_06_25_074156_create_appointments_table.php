<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('nama_siswa');
            $table->string('kelas');
            $table->string('kontak')->nullable();
            $table->date('tanggal');
            $table->time('jam');
            $table->enum('jenis', ['tatap_muka', 'daring'])->default('tatap_muka');
            $table->enum('status', ['pending', 'dikonfirmasi', 'selesai'])->default('pending');
            $table->text('keluhan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};