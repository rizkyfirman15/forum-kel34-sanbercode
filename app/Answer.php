<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    // blacklist
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
