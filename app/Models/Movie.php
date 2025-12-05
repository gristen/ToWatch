<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory;

    protected $table = "movies";


    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
    public function persons(): BelongsToMany
    {
        return $this->belongsToMany(Person::class);
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    public function countries(): belongsToMany
    {
        return $this->belongsToMany(Country::class);
    }

    public function publisher(): BelongsTo
    {
       return $this->belongsTo(User::class,'user_published');
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function fees()
    {
        return $this->hasMany(Fees::class);
    }

    public function watchability(): HasMany
    {
        return $this->hasMany(Watchability::class);
    }

    protected $fillable = [
        'kinopoisk_id',
        'name',
        'eng_name',
        'type',
        'movieLength',
        'route_to_film',
        'age_rating',
        'preview_url',
        'genres_id',
        'user_published',
        'description',
        'preview',
        'year',
        'shortDescription',
    ];
}
