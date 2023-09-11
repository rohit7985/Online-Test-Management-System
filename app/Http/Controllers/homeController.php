<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Exception;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index()
    {   
        try{
            $tests = Test::take(6)->get();
            return view('index', compact('tests'));
        }catch(Exception $e){
            // dd($e);
        }
        
    }
}
