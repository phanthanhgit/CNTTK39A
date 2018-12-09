<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Avatar;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'email', 'password', 'username', 'avatar', 'level'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [
        'avatar_path'
    ];

    public function getAvatarPathAttribute()
    {
        if (empty($this->attributes['avatar'])) {
            return Avatar::create($this->attributes['name'])
                ->setDimension(90, 90)
                ->setFontSize(18)
                ->setShape('square')
                ->toBase64();
        }

        return $this->attributes['avatar']; 
    }
}
