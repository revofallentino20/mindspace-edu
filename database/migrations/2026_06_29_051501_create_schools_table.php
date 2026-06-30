<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kode')->unique();
            $table->string('alamat')->nullable();
            $table->string('kota')->nullable();
            $table->string('kontak')->nullable();
            $table->string('email')->nullable();
            $table->enum('jenjang', ['SMP', 'SMA', 'SMK', 'Perguruan Tinggi'])->default('SMA');
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};