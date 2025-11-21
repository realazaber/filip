<?php

namespace Database\Seeders;

use Database\Seeders\demo\DemoContactSeeder;
use Database\Seeders\demo\DemoDoctorSeeder;
use Database\Seeders\demo\DemoPatientSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (App::environment() == 'prod') {
        } else {
            $this->call([
                DemoDoctorSeeder::class,
                DemoPatientSeeder::class,
                DemoContactSeeder::class,
            ]);
        }
    }
}
