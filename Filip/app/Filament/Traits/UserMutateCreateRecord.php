<?php

namespace App\Filament\Traits;

use App\Models\User;

trait UserMutateCreateRecord
{
    //Override the create record to create user first and properly link it to profile (Patient/Doctor/Contact)
    protected function mutateFormDataBeforeCreate(array $data): array
    {


        $userData = [];

        // dd($data, $this, $userData);
        if (!array_key_exists('first_name', $data)) {

            $userData = $this->data['user'];
        } else {
            $userData = $data;
        }


        $userData['name'] = ($userData['first_name'] ?? '') . ($userData['last_name'] ?? '');

        $user = User::create($userData);

        $data['user_id'] = $user->id;

        unset($data['user']);

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $userData = $data['user'] ?? [];

        if ($this->record->user) {
            $this->record->user->update($userData);
        }

        unset($data['user']);

        return $data;
    }
}
