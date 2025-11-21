<?php

namespace Database\Seeders\demo;

use App\Models\Contact;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoContactSeeder extends Seeder
{
    public function run(): void
    {
        // Get all patients that do NOT have any contacts
        $availablePatientIds = Patient::doesntHave('contacts')
            ->pluck('id')
            ->toArray();

        User::factory()
            ->count(20)
            ->create()
            ->each(function ($user) use (&$availablePatientIds) {

                if (empty($availablePatientIds)) {
                    return; // no patients left without contacts
                }

                // Pick a random patient ID
                $patientId = $availablePatientIds[array_rand($availablePatientIds)];

                // Create the contact for that patient
                Contact::factory()->create([
                    'user_id'    => $user->id,
                    'patient_id' => $patientId,
                ]);

                // Remove that patient so we don't reuse it
                $availablePatientIds = array_values(
                    array_diff($availablePatientIds, [$patientId])
                );
            });
    }
}
