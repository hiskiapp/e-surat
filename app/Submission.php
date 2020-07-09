<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'letter_id', 'data'
    ];

    protected $casts = [
        'approval_at' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function letter()
    {
        return $this->belongsTo('App\Letter');
    }

    public function admin()
    {
        return $this->belongsTo('App\Admin');
    }

    public function getStatus()
    {
        switch ($this->approval_status) {
            case 0:
                return 'Menunggu Persetujuan';
                break;
            case 1:
                return 'Disetujui';
                break;
            case 2:
                return 'Ditolak';
                break;

            default:
                return 'Tidak Diketahui';
                break;
        }
    }

    public function getData($name)
    {
        $json = json_decode($this->data);

        $data = [];
        foreach($json as $key => $val){
            $data[$key] = $val;
        }

        return $data[$name];
    }
}
