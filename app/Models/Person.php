<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Person extends Model
{

    protected $table = 'persons';

    protected $fillable = [
        'name',
        'eng_name',
        'profession',
        'photo_url',
    ];

    public function movies():belongsToMany
    {
        return $this->belongsToMany(Movie::class);
    }
}
