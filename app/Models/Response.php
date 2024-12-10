<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $table = 'responses';
    protected $fillable = ['user_id', 'survey_id', 'question_id', 'question_text', 'answer'];

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
