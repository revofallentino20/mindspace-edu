<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('screenings', function (Blueprint $table) {
            // PHQ-9 columns (depresi)
            $table->integer('phq1')->default(0);
            $table->integer('phq2')->default(0);
            $table->integer('phq3')->default(0);
            $table->integer('phq4')->default(0);
            $table->integer('phq5')->default(0);
            $table->integer('phq6')->default(0);
            $table->integer('phq7')->default(0);
            $table->integer('phq8')->default(0);
            $table->integer('phq9')->default(0);
            $table->integer('skor_phq')->default(0);

            // GAD-7 columns (kecemasan)
            $table->integer('gad1')->default(0);
            $table->integer('gad2')->default(0);
            $table->integer('gad3')->default(0);
            $table->integer('gad4')->default(0);
            $table->integer('gad5')->default(0);
            $table->integer('gad6')->default(0);
            $table->integer('gad7')->default(0);
            $table->integer('skor_gad')->default(0);

            // Update status enum
            $table->string('kategori_phq')->default('minimal');
            $table->string('kategori_gad')->default('minimal');
        });
    }

    public function down(): void
    {
        Schema::table('screenings', function (Blueprint $table) {
            $table->dropColumn([
                'phq1','phq2','phq3','phq4','phq5','phq6','phq7','phq8','phq9','skor_phq',
                'gad1','gad2','gad3','gad4','gad5','gad6','gad7','skor_gad',
                'kategori_phq','kategori_gad'
            ]);
        });
    }
};