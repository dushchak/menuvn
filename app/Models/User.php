<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Places;
use App\Models\Coins;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /*V*/
    const ROLE_USER = 1;
    const ROLE_CLIENT = 5;
    const ROLE_ADMIN = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
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
        'password' => 'hashed',
    ];

    public function places(){
        return $this->hasMany(Places::class); // звязок "один -> багато"
    }

    public function coins(){
        return $this->hasMany(Coins::class); // звязок "один -> багато"
    }

    public function isAdmin(): bool{
        return $this->role === self::ROLE_ADMIN;
    }
}
