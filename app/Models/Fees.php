<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fees extends Model
{
    protected $table = 'feesses';

    protected $fillable = [
        'name',
        'value',
    ];


    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }
}
