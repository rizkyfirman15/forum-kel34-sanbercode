<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // blacklist
    protected $guarded = [];

    // user
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // answer
    public function answer()
    {
        return $this->belongsTo('App\Answer');
    }
}
