<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    protected $fillable = ['question', 'type', 'is_multiple', 'is_required', 'survey_id'];

    public function Survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function SubQuestions()
    {
        return $this->hasMany(SubQuestion::class);
    }

    public function Options()
    {
        return $this->hasMany(Option::class);
    }
}
