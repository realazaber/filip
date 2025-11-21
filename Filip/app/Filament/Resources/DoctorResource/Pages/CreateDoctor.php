<?php

namespace App\Filament\Resources\DoctorResource\Pages;

use App\Filament\Resources\DoctorResource;
use App\Filament\Traits\UserMutateCreateRecord;
use Filament\Resources\Pages\CreateRecord;

class CreateDoctor extends CreateRecord
{

    use UserMutateCreateRecord;
    protected static string $resource = DoctorResource::class;
}
