<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $table = 'options';
    protected $fillable = ['value', 'text', 'question_id', 'sub_question_id'];

    public function Question()
    {
        return $this->belongsTo(Question::class);
    }

    public function SubQuestion()
    {
        return $this->belongsTo(SubQuestion::class);
    }
}
