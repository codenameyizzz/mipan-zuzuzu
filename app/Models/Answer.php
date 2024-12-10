<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';
    protected $fillable = ['user_id', 'survey_id', 'question_id', 'sub_question_id', 'answer'];
}
