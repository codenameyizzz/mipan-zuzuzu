<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';
    protected $fillable = ['user_id', 'survey_id', 'question_id', 'sub_question_id', 'answer'];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function Survey()
    {
        return $this->belongsTo(Survey::class, 'survey_id', 'id');
    }

    public function Question()
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }
}
