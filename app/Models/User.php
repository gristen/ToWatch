<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\View\Components\stat;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */

    use HasFactory, Notifiable;


    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    protected static function booted()
    {
        static::deleting(function (User $user) {
            $user->activities()->delete();
        });
    }

    public function activities():HasMany
    {
        return $this->hasMany(Activity::class);
    }

    public function hasPermission($permission): bool
    {
        return $this->role->permissions()->pluck('name')->contains($permission);
    }

    public function likesMovies()
    {
        return $this->belongsToMany(
            Movie::class,
            'movie_likes',
            'user_id',
            'movie_id',
        );
    }
    public function favoriteGenres()
    {
        return $this->belongsToMany(
            Genre::class,
            'genres_user',
            'user_id',
            'genre_id',
        );
    }

    public function viewedMovies():BelongsToMany
    {
        return $this->belongsToMany(
            Movie::class,
            'movie_viewed',
            'user_id',
            'movie_id',
        );
    }
    public function isViewed(int $movieId): bool
    {
        return $this->viewedMovies()->where('movie_id', $movieId)->exists();
    }

    public function isLiked(int $movieId): bool
    {
        return $this->likesMovies()->where('movie_id', $movieId)->exists();
    }

    public function isWatched(int $movieId): bool
    {
      return $this->watchLater()->where('movie_id', '=', $movieId)->exists();
    }
    public function watchLater() :BelongsToMany
    {
        return $this->belongsToMany(
            Movie::class,
            'movie_watch_later',
            'user_id',
            'movie_id',
        );
    }

    public function favoritesMovies() :BelongsToMany
    {
        return $this->belongsToMany(
            Movie::class,
            'favorite_movie_user',
            'user_id',
            'movie_id',
        );
    }

    public function isFavorited(int $movieId): bool
    {
        return $this->favoritesMovies()->where('movie_id', $movieId)->exists();
    }


    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function following() :BelongsToMany // на кого я подписался
    {
        return
            $this->belongsToMany(
                User::class,
                'follows',
                'user_id',
                'followed_user_id'
            );

    }

    public function isStaff(): bool
    {
        return $this->role_id < 3;
    }

    public function followers() // кто на меня подписался
    {
        return
            $this->belongsToMany(
                User::class,
                'follows',
                'followed_user_id',
                'user_id'
            )->withTimestamps();
    }

    public function isFollowing(User $user): bool
    {
        return $this->following()
            ->where('followed_user_id', "=", $user->id)
            ->exists();
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public static function findByUsername(string $name): ?self
    {
        return static::query()->where('name', $name)->first();
    }


    public function movies(): HasMany
    {
        return $this->hasMany(Movie::class, 'user_published', 'id');
    }

    public function role(): belongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $fillable = [
        'name',
        'about',
        'email',
        'role_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
