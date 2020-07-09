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
        'number', 'name', 'content', 'data', 'status'
    ];

    public function status()
    {
        return $this->status == 'On' ? 'Aktif' : 'Tidak Aktif';
    }

    public function getData()
    {
        return json_decode($this->data);
    }
}
