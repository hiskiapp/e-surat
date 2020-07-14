<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Letter extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name', 'content', 'data', 'status'
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
