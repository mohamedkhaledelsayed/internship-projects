<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\PasswordCodeResetNotification;
use App\Services\Classes\UserConfirmation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UserConfirmation;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'image',
        'email',
        'password',
        'phone',
        'point',
        'active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function activity_user()
    {
        return $this->belongsToMany(Activity::class, 'activity_user');
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordCodeResetNotification($token));
    }
    public function assignCategory($category)
    {
        return $this->categories()->save($category);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_user');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function regionsOrdersArray()
    {
        return $this->orders()->pluck('region_id')->toArray();
    }

    public function favoritRegions()
    {
        return $this->hasMany(FavoritRegion::class);
    }

    public function favoritRegionsIdsArray()
    {
        return $this->favoritRegions()->pluck('region_id')->toArray();
    }

    public function awards()
    {
        return $this->belongsToMany(Award::class);
    }
}
