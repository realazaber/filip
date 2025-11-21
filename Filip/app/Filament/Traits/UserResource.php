<?php

namespace App\Filament\Traits;

use Illuminate\Database\Eloquent\Builder;

trait UserResource
{
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with('user');
    }
}
