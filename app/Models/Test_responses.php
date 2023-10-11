<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Test;

class Test_responses extends Model
{
    protected $fillable = ['student', 'test_id', 'attempt', 'score', 'details'];

    public static function getTestData($name){
        $data = Test_responses::where('student', $name)->get();
        return $data;
    }

    public static function getStudentCountByTestId($test_id){
        $data = Test_responses::where('test_id', $test_id)->count();
        return $data;
    }

    public static function getTestDataById($id){
        $data = Test_responses::with('test')->find($id);
        return $data;
    }
    public static function getAllTest(){
        $data = Test_responses::all();
        return $data;
    }
    public function getTestNameAttribute()
    {
        return $this->test->name;
    }
    public function test()
    {
        return $this->belongsTo(Test::class, 'test_id'); // Assuming the foreign key is 'test_id'
    }
}
