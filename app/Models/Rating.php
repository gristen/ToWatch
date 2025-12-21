<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    protected $table = "ratings";

    public function movies(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'movie_id',
        'user_id',
        'user_rating'
    ];
}
