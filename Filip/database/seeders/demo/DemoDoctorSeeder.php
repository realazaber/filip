<?php

namespace Database\Seeders\demo;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DemoDoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'azaber',
            'first_name' => 'Alex',
            'last_name' => 'Zab',
            'date_of_birth' => '2000-06-08',
            'phone' => '1234567890',
            'filament_user' => true,
            'email' => 'contact@azaber.com',
            'password' => bcrypt('password'),
        ]);
        $docProfile = Doctor::create([
            'user_id' => $user->id,
            'specialisation' => 'General Practitioner',
        ]);
        $user->doctor()->save($docProfile);

        User::factory()->count(10)->create()->each(function ($user) {
            Doctor::factory()->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
