<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all user IDs except 1
        $userIds = User::where('id', '!=', 1)->pluck('id')->toArray();


        Patient::factory()->count(50)->make()->each(function ($patient) use ($userIds) {
            $patient->user_id = $userIds[array_rand($userIds)];
            $patient->save();
        });
    }
}
