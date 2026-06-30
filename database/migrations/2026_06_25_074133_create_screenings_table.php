<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('screenings', function (Blueprint $table) {
            $table->id();
            $table->string('kelas');
            $table->integer('skor_stres')->default(0);
            $table->integer('skor_cemas')->default(0);
            $table->integer('skor_depresi')->default(0);
            $table->enum('status', ['rendah', 'sedang', 'tinggi'])->default('rendah');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('screenings');
    }
};