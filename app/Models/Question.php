<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Question extends Model
{

    protected $fillable = [
        'question',
        'option1',
        'option2',
        'option3',
        'option4',
        'correct_option',
    ];

    public function tests()
    {
        return $this->belongsToMany('App\Models\Test', 'test_questions')->withPivot('id');
    }
}
