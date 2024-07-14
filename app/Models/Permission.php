<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts   = ['created_at', 'updated_at' => 'date:Y-m-d'];

    protected $appends = ['create_since'];

    public function getCreateSinceAttribute()
    {
        return $this->created_at?->diffForHumans();
    }
}
