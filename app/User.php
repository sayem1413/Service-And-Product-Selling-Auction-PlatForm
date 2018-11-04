<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function userAddress()
    {
        return $this->hasOne(UserAddress::class);
    }
    
    public function userInfo()
    {
        return $this->hasOne(UserInfo::class);
    }
    
    public function cardInfo()
    {
        return $this->hasOne(CardInfo::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    
}
