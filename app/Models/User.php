<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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
                'following_user_id'
            );

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
