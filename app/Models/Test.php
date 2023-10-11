<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable = [
        'name',
        'start_at',
        'test_duration', 
        'images'
    ];


    public static function getTestNameById(){
        $testIds = Question::pluck('test_id')->unique();
        $tests = Test::whereIn('id', $testIds)->get(['id', 'name', 'images']);
        return $tests;
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'test_id', 'id');
    }
}
