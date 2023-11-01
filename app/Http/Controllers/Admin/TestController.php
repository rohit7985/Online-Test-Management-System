<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestRequest;
use Illuminate\Http\Request;
use App\Models\Test;
use Exception;
use App\Models\Question;
use App\Models\Test_responses;
use Illuminate\Support\Facades\Session;

class TestController extends Controller
{
    public function store(TestRequest $request)
    {
        try {
            $getImage = $request['images'];
            $imageName = $getImage->getClientOriginalName();
            $getImage->storeAs('images', $imageName, 'public');
            $data = [
                'name' => $request->name,
                'start_at' => $request->start_at,
                'test_duration' => $request->test_duration,
                'images' => $imageName,
            ];
            $test = Test::create($data);
            if($test){
                return redirect()->back()->with('success', 'Test added');
            }else{
                return redirect()->back()->with('error', 'Something went Wrong');

            }
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function index()
    {
        try {
            $tests = Test::paginate(10);
            return view('admin.test', compact('tests'));
        } catch (Exception $e) {
            // Handle the exception, you can uncomment the `dd($e);` line for debugging
        }
    }

    public function editTestResponse($id)
    {
        try {
            // Find the test by ID and delete it
            $data = Test_responses::getTestDataById($id);
            return response()->json($data);
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function deleteTestResponse($ids)
    {
        try {
            $idsArray = explode(',', $ids);
            foreach ($idsArray as $id) {
                $data = Test_responses::findOrFail($id);
                $data->delete();
            }
            return response()->json(['success' => true]);
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function testResult()
    {
        try {
            $tests = Test_responses::getAllTest();
            // dd($tests);
            return view('admin.test-result', compact('tests'));
        } catch (Exception $e) {
            // Handle the exception, you can uncomment the `dd($e);` line for debugging
        }
    }
    public function testInstruction($testId)
    {
        try {
            return view('student.testInfo',compact('testId'));
        } catch (Exception $e) {
        }
    }

    public function attemptTest(Request $request)
    {
        try {
            $testId = $request->testId;
            $test = Test::where('id', $testId)->get();;
            $test_duration = $test[0]->test_duration;
            $questions = Question::where('test_id', $testId)->get();
            if(count($questions) == 0){
                return redirect('student-dashboard')->with('error', 'Sorry, Questions are not available');
            }else{
                return view('attempt-test',compact('questions','testId','test_duration'));
            }
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function submitTest(Request $request)
    {
        try {
            $data = $request->all();
            $user = Session::get('currentUserData');
            $testId = $data['testId'];
            $score = 0;
            if(isset($data['responses'])){
                foreach($data['responses'] as $key=>$value){
                    $question = Question::where('id', $key)->get();
                    $crrctOption = $question[0]->correct_option;
                    if($crrctOption == $value){
                        $score++;
                    }
                }
            } 
            $testData = [
                'student' => $user->name,
                'test_id' => $testId,
                'attempt' => 1,
                'score' => $score,
                'details' => json_encode($data),
            ];
            $res = Test_responses::create($testData);
            if($res){
                return redirect('student-dashboard')->with('success', 'Thank You for giving the Test');
            }else{
                return redirect('student-dashboard')->with('error', 'Something went Wrong');
            }

        } catch (Exception $e) {
            dd($e);
        }
    }

    public function showImg($filename)
    {
        try {
            $path = storage_path('app/public/images/' . $filename);
            if (file_exists($path)) {
                return response()->file($path);
            } else {
                abort(404);
            }
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function addQna($id)
    {
        try {
            $test = Test::find($id);
            $questions = $test->questions;
            return view('admin.addQna', compact('questions', 'test'));
        } catch (Exception $e) {
            dd($e);
        }
    }


    public function addQnaToTest(Request $request)
    {
        try {
            $testId = $request->input('testId');
            Session::put('testId', $testId);
            return response()->json($testId);
        } catch (Exception $e) {
        }
    }


    public function editTest($id)
    {
        try {
            // Find the test by ID and delete it
            $test = Test::findOrFail($id);
            return response()->json($test);
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $test = Test::findOrFail($id);
            $test->update([
                'name' => $request->name,
                'start_at' => $request->start_at,
                'test_duration' => $request->test_duration,
            ]);

            return redirect()->route('test')->with('success', 'Test updated successfully.');
        } catch (Exception $e) {
            dd($e);
        }
    }


    public function deleteTest($id)
    {
        try {
            // Find the test by ID and delete it
            $test = Test::findOrFail($id);
            $test->delete();
            return response()->json(['success' => true]);
        } catch (Exception $e) {
            dd($e);
        }
    }
}
