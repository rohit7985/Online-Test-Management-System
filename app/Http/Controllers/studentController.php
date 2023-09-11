<?php

namespace App\Http\Controllers;

use App\Http\Requests\studentLoginRequest;
use App\Models\Student;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Requests\StudentStoreRequest;
use App\Models\Test;
use Exception;
use Illuminate\Support\Facades\Auth;


class studentController extends Controller
{
    public function index(){ 
        try{
            if(Session::has('email')){
                $user = Student::where('email', Session::get('email'))->first();
            }
            $tests = Test::all();
            return view('student.dashboard',compact('user','tests'));
        }catch(Exception $e){
            dd($e);
        }
            
    }

    public function login(studentLoginRequest $request)
    {
        try{
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                if($user->user_type =='A'){
                    return back()->with('error', 'Invalid Credential');
                }else{
                    return redirect()->route('student.dashboard');
                }
            }else{
                return back()->with('error', 'Invalid Credential');
            }
        }catch(Exception $e){
            dd($e);
        }
       
    }

    public function logout(){
        try{
            Session::flush();
            return redirect('/');
        }catch(Exception $e){
            dd($e);
        }
    }

    public function store(StudentStoreRequest $request)
    {   
        
        $request->validated();
        $hashedPassword = bcrypt($request->password);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'password' => $hashedPassword,
        ];
        $user = Student::create($data);
        if($request->registerVia == 'Admin'){
            return $user;
        }
        if($user){
            Session::put('email',$request['email']);
            return redirect()->route('student.dashboard');
        }else{
            return redirect()->route('login')->with('error', 'Registration Failed');
        }
        
    }

}
