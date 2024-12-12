<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubQuestion extends Model
{
    protected $table = 'sub_questions';
    protected $fillable = ['question', 'question_id', 'type'];

    public function Question()
    {
        return $this->belongsTo(Question::class);
    }

    public function Options()
    {
        return $this->hasMany(Option::class);
    }
}
