<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komen_Tanya extends Model
{
    protected $table = "komen_tanya";
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
