<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ScreeningSeeder::class,
            AppointmentSeeder::class,
        ]);
    }
public function run(): void
    {
    $this->call([
        SchoolSeeder::class,
        ScreeningSeeder::class,
        AppointmentSeeder::class,
    ]);
    }
}