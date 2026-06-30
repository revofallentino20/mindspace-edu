<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Screening;

class ScreeningSeeder extends Seeder
{
    public function run(): void
    {
        $kelas = ['X IPA 1', 'X IPA 2', 'XI IPA 1', 'XI IPS 1', 'XII IPA 1', 'XII IPS 2'];

        foreach ($kelas as $k) {
            for ($i = 0; $i < 5; $i++) {
                $stres   = rand(10, 90);
                $cemas   = rand(10, 90);
                $depresi = rand(10, 90);
                $rata    = ($stres + $cemas + $depresi) / 3;
                $status  = $rata >= 70 ? 'tinggi' : ($rata >= 40 ? 'sedang' : 'rendah');

                Screening::create([
                    'kelas'       => $k,
                    'skor_stres'  => $stres,
                    'skor_cemas'  => $cemas,
                    'skor_depresi'=> $depresi,
                    'status'      => $status,
                    'catatan'     => $status === 'tinggi' ? 'Perlu perhatian segera.' : null,
                ]);
            }
        }
    }
}