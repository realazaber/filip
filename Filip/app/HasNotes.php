<?php

namespace App;

use App\Models\Note;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasNotes
{
    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }
}
