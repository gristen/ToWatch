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
    protected $fillable = [
        'kinopoisk_id',
        'name',
        'slug',
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
        'kp_id',
        'tmdb_id',
        'imdb_id',
        'kp_rating',
        'imdb_rating',
        'film_critics_rating',
    ];

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

    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }

    public function fees(): HasMany
    {
        return $this->hasMany(Fees::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function watchability(): HasMany
    {
        return $this->hasMany(Watchability::class);
    }

    public function actors(): BelongsToMany
    {
        return $this->belongsToMany(Person::class)
            ->where('profession','=','актеры');
    }

    public function artists(): BelongsToMany
    {
        return $this->belongsToMany(Person::class)
            ->where('profession','=','художники');
    }

    public function directors(): BelongsToMany
    {
        return $this->belongsToMany(Person::class)
            ->where('profession','=','режиссеры');
    }



}
