<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = [];

    public function question()
    {
        return $this->belongsToMany(Question::class);
    }
}
