<?php

namespace App\Models;

use App\HasNotes;
use App\IsProfile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    /** @use HasFactory<\Database\Factories\PatientFactory> */
    use HasFactory, IsProfile, HasNotes;

    protected $guarded = [''];

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }
}
