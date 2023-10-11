<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class homeController extends Controller
{
    public function index()
    {   
        try{
            $tests = Test::orderBy('created_at', 'desc')->take(6)->get();
            // dd(Session::all());
            return view('index', compact('tests'));
        }catch(Exception $e){
            // dd($e);
        }
        
    }
}
