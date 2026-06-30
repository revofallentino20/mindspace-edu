<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama_siswa' => 'Andi Pratama',    'kelas' => 'XII IPA 1', 'jenis' => 'tatap_muka', 'status' => 'dikonfirmasi'],
            ['nama_siswa' => 'Siti Rahayu',     'kelas' => 'XI IPS 1',  'jenis' => 'daring',     'status' => 'pending'],
            ['nama_siswa' => 'Budi Santoso',    'kelas' => 'X IPA 2',   'jenis' => 'tatap_muka', 'status' => 'selesai'],
            ['nama_siswa' => 'Dewi Lestari',    'kelas' => 'XII IPS 2', 'jenis' => 'daring',     'status' => 'pending'],
            ['nama_siswa' => 'Fajar Nugroho',   'kelas' => 'XI IPA 1',  'jenis' => 'tatap_muka', 'status' => 'dikonfirmasi'],
            ['nama_siswa' => 'Rina Marlina',    'kelas' => 'X IPA 1',   'jenis' => 'daring',     'status' => 'selesai'],
        ];

        foreach ($data as $d) {
            Appointment::create([
                'nama_siswa' => $d['nama_siswa'],
                'kelas'      => $d['kelas'],
                'kontak'     => '08' . rand(100000000, 999999999),
                'tanggal'    => now()->addDays(rand(-5, 10))->format('Y-m-d'),
                'jam'        => ['08:00', '09:00', '10:00', '13:00', '14:00'][rand(0,4)],
                'jenis'      => $d['jenis'],
                'status'     => $d['status'],
                'keluhan'    => 'Merasa cemas menjelang ujian akhir semester.',
            ]);
        }
    }
}