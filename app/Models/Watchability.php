<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Watchability extends Model
{
    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    protected $fillable = [
        'movie_id',
        'name',
        'logo_url',
        'url',
    ];
}
