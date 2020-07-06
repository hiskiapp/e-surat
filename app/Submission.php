<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function letter(){
        return $this->belongsTo('App\Letter');
    }

    public function admin(){
        return $this->belongsTo('App\Admin');
    }
}
