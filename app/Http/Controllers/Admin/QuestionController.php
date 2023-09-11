<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;

class QuestionController extends Controller
{
    public function index()
    {   
        try{
            //$tests = Question::all();
            return view('admin.question');
        }catch(Exception $e){
            // dd($e);
        }
        
    }
}
