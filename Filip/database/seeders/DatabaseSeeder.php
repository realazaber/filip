<?php

namespace Database\Seeders;

use App\Models\Patient;
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
                UserSeeder::class,
                PatientSeeder::class,
                //DoctorSeeder::class,
                //ContactSeeder::class,
            ]);
        }
    }
}
