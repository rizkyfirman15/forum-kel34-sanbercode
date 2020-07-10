<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerComment extends Model
{
    //
    protected $table = 'question_comments';
    // blacklist
    protected $guarded = [];

    // user
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function question(){
        return $this->belongsTo('App\Question');
    }
    // answer
    public function answer()
    {
        return $this->belongsTo('App\Answer');
    }
}
