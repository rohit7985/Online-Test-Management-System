<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use App\Models\Test;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try{
        $gUser = Socialite::driver('google')->user();
        $existingUser = Student::where('email', $gUser->getEmail())->first();
        if ($existingUser && $gUser->getId() == $existingUser->googleId) {
            Auth::guard('web')->login($existingUser);
            // Authentication successful, do something
        }
         else {
            $userData = [
            'name' => $gUser->name,
            'googleId' => $gUser->id,
            'email' => $gUser->email,
            'mobile_number' => '5463456463',
            'password' => bcrypt($this->generateRandomPassword()),
            ];
            $user = Student::create($userData);
        }

        Session::put('currentUserData', $user ?? $existingUser);
        // $tests = Test::all();
        // return view('student.dashboard',compact('user','tests')); 
        return redirect()->route('student.dashboard');
        }catch(Exception $e){
            dd($e);
        }
    }

    public function generateRandomPassword() {
        $uppercase = Str::random(1, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        $lowercase = Str::random(3, 'abcdefghijklmnopqrstuvwxyz');
        $digits = Str::random(2, '0123456789');
        $specialChars = Str::random(2, '!@#$%^&*()-_=+[]{}|;:,<>.?');
    
        $password = $uppercase . $lowercase . $digits . $specialChars;
        $password = str_shuffle($password);
    
        return $password;
    }
}
