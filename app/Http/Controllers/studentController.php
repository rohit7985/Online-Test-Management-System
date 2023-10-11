<?php

namespace App\Http\Controllers;

use App\Http\Requests\studentLoginRequest;
use App\Models\Student;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Requests\StudentStoreRequest;
use App\Models\Test;
use App\Models\Test_responses;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class studentController extends Controller
{

    public function index(){ 
        try{
            if(Session::has('email')){
                $email = Session::get('email');
                $user = Student::getUserDataByEmail($email);
            }
            $tests = Test::getTestNameById();
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
                    Session::put('currentUserData', $user);
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

    public function profile(){
        try{
            $user = Session::get('currentUserData');
            $testData = Test_responses::getTestData($user->name);
            return view('student.profile',compact('testData','user'));
        }catch(Exception $e){
            dd($e);
        }
    }

    public function changePassword(Request $request)
    {
        try {
            $user = Session::get('currentUserData');
            $oldPassword = $request->input('old_password');
            $newPassword = $request->input('new_password');
            $confirmPassword = $request->input('confirm_password');

            // Check if old password is correct
            if (Hash::check($oldPassword, $user->password)) {
                // Check if new password matches confirmation
                if ($newPassword === $confirmPassword) {
                    // Update the password
                    $user->password = Hash::make($newPassword);
                    $user->save();

                    return redirect()->back()->with('success', 'Password changed successfully.');
                } else {
                    return redirect()->back()->with('error', 'New password and confirmation do not match.');
                }
            } else {
                return redirect()->back()->with('error', 'Incorrect old password.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while changing the password. Please try again.');
        }
    }


    public function store(StudentStoreRequest $request)
    {   
        
        $request->validated();
        $hashedPassword = bcrypt($request->password);
        $data = [
            'name' => $request->name,
            'googleId' => '',
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
