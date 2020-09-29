<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'photo', 'name', 'username', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
