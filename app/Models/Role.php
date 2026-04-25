<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function getBadgeClass()
    {
        return match ($this->name) {
            'admin' => 'bg-danger',
            'moderator' => 'bg-warning text-dark',
            'user' => 'bg-primary',
            default => 'bg-secondary',
        };
    }
    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'role_permissions');
    }
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
