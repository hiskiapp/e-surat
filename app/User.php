<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'photo', 'sin', 'name', 'password', 'birth_place', 'birth_date', 'gender', 'address', 'religion', 'marital_status', 'profession'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function getShortGender()
    {
        return substr($this->gender, 0, 1);
    }

    public function getPsb()
    {
        return $this->birth_place . ', ' . $this->birth_date->formatLocalized('%d %B %Y');
    }
}
