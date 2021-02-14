<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['title', 'capabilities'];

    function getCapabilitiesAttribute($value)
    {
        return json_decode($value);
    }

    function users()
    {
        return $this->hasMany(User::class);
    }
}
