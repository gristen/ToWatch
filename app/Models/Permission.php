<?php

namespace App\Models;
use Illuminate\Support\Facades\Lang;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name',
    ];
    /*аксесор*/
    public function getNameAttribute($value)
    {

        $key = 'permissions.' . $value;

        return Lang::has($key) ? __($key) : $value;
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class,'role_permissions');
    }
}
