<?php

namespace Database\Seeders\demo;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoPatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::factory()->count(50)->create()->each(function ($user) {
            Patient::factory()->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
