<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function admins()
    {
        return $this->belongsToMany(Admin::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function abilities()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function allowTo($ability)
    {
        return $this->abilities()->save($ability);
    }

    public function disallowTo($ability)
    {
        return $this->abilities()->detach($ability);
    }
}
