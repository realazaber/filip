<?php

namespace App\Filament\Traits;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

trait UserCreateForm
{
    public static function get(): array
    {

        return [
            TextInput::make('first_name')
                ->required()
                ->maxLength(255),
            TextInput::make('last_name')
                ->required()
                ->maxLength(255),
            DatePicker::make('date_of_birth'),
            TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),
            TextInput::make('phone')
                //->tel()
                ->required()
                ->maxLength(255),
            // Forms\Components\DateTimePicker::make('email_verified_at'),
            Select::make('gender')
                ->options(['Male', 'Female'])
                ->hiddenOn(operations: 'edit')
                ->required(),
            TextInput::make('password')
                ->password()
                ->hiddenOn(operations: 'edit')
                ->required()
                ->maxLength(255),
        ];
    }
}
