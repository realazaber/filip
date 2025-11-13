<?php

namespace App\Models;

use App\IsProfile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    /** @use HasFactory<\Database\Factories\ContactFactory> */
    use HasFactory, IsProfile;

    protected $guarded = [''];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
