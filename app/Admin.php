<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $fillable = [
        'photo', 'name', 'username', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
