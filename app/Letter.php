<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'status'
    ];

    public function status(){
    	return $this->status == 'off' ? 'Nonaktif' : 'Aktif';
    }
}
