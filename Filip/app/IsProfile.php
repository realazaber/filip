<?php

namespace App;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait IsProfile
{
    //Delete connected user when profile is deleted
    public static function booted()
    {
        static::deleting(function ($entity) {
            // Delete the associated user
            $entity->user()->delete();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
