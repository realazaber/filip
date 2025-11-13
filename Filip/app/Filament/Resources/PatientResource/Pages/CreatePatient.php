<?php

namespace App\Filament\Resources\PatientResource\Pages;

use App\Filament\Resources\PatientResource;
use App\Filament\Traits\UserMutateCreateRecord;
use Filament\Resources\Pages\CreateRecord;

class CreatePatient extends CreateRecord
{

    use UserMutateCreateRecord;
    protected static string $resource = PatientResource::class;
}
