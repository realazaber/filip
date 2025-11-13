<?php

namespace App\Filament\Resources\ContactResource\Pages;

use App\Filament\Resources\ContactResource;
use App\Filament\Traits\UserMutateCreateRecord;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateContact extends CreateRecord
{
    use UserMutateCreateRecord;

    protected static string $resource = ContactResource::class;
}
