<?php

namespace App\Http\Controllers;

use App\Http\Requests\adminLoginRequest;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Student;
use App\Models\Test;
use App\Models\Test_responses;
use Illuminate\Support\Facades\Auth;
use Exception;

class adminController extends Controller
{
    public function dashboard(){
        try{
            if(Session::has('email')){
                $user =  Student::where('email', Session::get('email'))->first();
                $students = Student::all()->count();
                $tests = Test::all()->count();
                $questions = Question::all()->count();

                $testData = Test::all();
                $data = [];
                foreach($testData as $test){
                    $numberOfUsers = Test_responses::getStudentCountByTestId($test->id);
                    $data[$test->name] = $numberOfUsers;
                }
                // dd($data);
                return view('admin.dashboard',compact('user','students','tests','questions','data'));
            }else{
                $tests = Test::orderBy('created_at', 'desc')->take(6)->get();
                return view('index', compact('tests'));
            }
        }catch(Exception $e){
            dd($e);
        }
    }

    public function adminLogin(adminLoginRequest $request)
    {
        try{
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                if($user->user_type =='A'){
                    Session::put('email', $user->email);
                    Session::put('username', $user->name);
                    return redirect()->route('admin.dashboard');
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

    public function adminLoginPage(){
        try{
            return view('admin-login');
        }catch(Exception $e){
            dd($e);
        }
    }

    public function student(){
        try{
            $students = Student::all();
            
            return view('admin.student', compact('students'));
        }catch(Exception $e){
            dd($e);
        }
    }

    public function deleteStudent($id)
    {
        try {
            // Find the test by ID and delete it
            $student = Student::findOrFail($id);
            $student->delete();
    
            return response()->json(['success' => true]);
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function editStudent($id)
    {
        try {
            // Find the test by ID and delete it
            $student = Student::findOrFail($id);
            return response()->json($student);
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function updateStudent(Request $request, $id)
    {
        try{
            $student = Student::findOrFail($id);
            $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'user_type' => $request->user_type,
        ]);

        return redirect()->route('admin.students')->with('success', 'Test updated successfully.');

        }catch(Exception $e){
            dd($e);
        } 
    }

    // try{
        
    // }catch(Exception $e){
    //     dd($e);
    // }
}
