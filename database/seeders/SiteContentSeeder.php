<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteContent;

class SiteContentSeeder extends Seeder
{
    public function run(): void
    {
        $contents = [
            // Hero Section
            ['key' => 'hero_headline', 'value' => 'Wujudkan Kesehatan Mental Siswa untuk Masa Depan yang Lebih Baik', 'group' => 'hero'],
            ['key' => 'hero_subheadline', 'value' => 'MindSpace Edu menjembatani komunikasi antara siswa dan unit BK secara anonim, aman, dan berbasis data — tanpa stigma, tanpa rasa takut.', 'group' => 'hero'],
            ['key' => 'hero_badge', 'value' => 'Platform SaaS Kesehatan Mental Siswa', 'group' => 'hero'],

            // Stats Section
            ['key' => 'stat1_number', 'value' => '60%', 'group' => 'stats'],
            ['key' => 'stat1_desc', 'value' => 'Remaja enggan ke ruang BK karena stigma sosial', 'group' => 'stats'],
            ['key' => 'stat2_number', 'value' => '3x', 'group' => 'stats'],
            ['key' => 'stat2_desc', 'value' => 'Lebih efisien dibanding pencatatan rekam medis manual', 'group' => 'stats'],
            ['key' => 'stat3_number', 'value' => '100%', 'group' => 'stats'],
            ['key' => 'stat3_desc', 'value' => 'Data siswa terenkripsi end-to-end, privasi terjamin', 'group' => 'stats'],
            ['key' => 'stat4_number', 'value' => '0', 'group' => 'stats'],
            ['key' => 'stat4_desc', 'value' => 'Instalasi server diperlukan — langsung pakai via cloud', 'group' => 'stats'],

            // CTA Section
            ['key' => 'cta_headline', 'value' => 'Siap wujudkan sekolah yang peduli kesehatan mental?', 'group' => 'cta'],
            ['key' => 'cta_subheadline', 'value' => 'Bergabunglah dengan institusi pendidikan yang sudah mempercayakan kesehatan mental siswanya kepada MindSpace Edu.', 'group' => 'cta'],
            ['key' => 'cta_note', 'value' => 'Gratis 30 hari · Tanpa kartu kredit · Setup dalam 1 hari', 'group' => 'cta'],
        ];

        foreach ($contents as $content) {
            SiteContent::updateOrCreate(
                ['key' => $content['key']],
                ['value' => $content['value'], 'group' => $content['group']]
            );
        }
    }
}