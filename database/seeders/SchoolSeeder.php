<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\School;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SchoolSeeder extends Seeder
{
    public function run(): void
    {
        // Buat sekolah-sekolah
        $schools = [
            [
                'nama'    => 'SMA Negeri 1 Yogyakarta',
                'kode'    => 'SMAN1YK',
                'alamat'  => 'Jl. HOS Cokroaminoto No.10',
                'kota'    => 'Yogyakarta',
                'kontak'  => '0274-513969',
                'email'   => 'info@sman1yk.sch.id',
                'jenjang' => 'SMA',
                'aktif'   => true,
            ],
            [
                'nama'    => 'SMA Negeri 2 Semarang',
                'kode'    => 'SMAN2SMG',
                'alamat'  => 'Jl. Sendangguwo Baru No.1',
                'kota'    => 'Semarang',
                'kontak'  => '024-6702404',
                'email'   => 'info@sman2smg.sch.id',
                'jenjang' => 'SMA',
                'aktif'   => true,
            ],
            [
                'nama'    => 'SMK Negeri 1 Jakarta',
                'kode'    => 'SMKN1JKT',
                'alamat'  => 'Jl. Bungur Besar Raya No.3',
                'kota'    => 'Jakarta',
                'kontak'  => '021-4224768',
                'email'   => 'info@smkn1jkt.sch.id',
                'jenjang' => 'SMK',
                'aktif'   => true,
            ],
        ];

        foreach ($schools as $schoolData) {
            School::create($schoolData);
        }

        // Update user pertama jadi superadmin
        $superadmin = User::first();
        if ($superadmin) {
            $superadmin->update([
                'role' => 'superadmin',
                'school_id' => null,
            ]);
        }

        // Buat admin per sekolah
        $school1 = School::where('kode', 'SMAN1YK')->first();
        User::create([
            'name'      => 'Admin BK SMAN 1 Yogyakarta',
            'email'     => 'bk@sman1yk.sch.id',
            'password'  => Hash::make('password123'),
            'role'      => 'admin',
            'school_id' => $school1->id,
        ]);

        $school2 = School::where('kode', 'SMAN2SMG')->first();
        User::create([
            'name'      => 'Admin BK SMAN 2 Semarang',
            'email'     => 'bk@sman2smg.sch.id',
            'password'  => Hash::make('password123'),
            'role'      => 'admin',
            'school_id' => $school2->id,
        ]);
    }
}