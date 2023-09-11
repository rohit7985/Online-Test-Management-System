<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Test;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Models\Question;


class TestController extends Controller
{
    public function store(Request $request)
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
            return redirect()->back()->with('sucess', 'Test added');
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function index()
    {
        try {
            $tests = Test::all();

            return view('admin.test', compact('tests'));
        } catch (Exception $e) {
            // Handle the exception, you can uncomment the `dd($e);` line for debugging
        }
    }
    public function testInstruction()
    {
        try {
            return view('student.testInfo');
        } catch (Exception $e) {
            // Handle the exception, you can uncomment the `dd($e);` line for debugging
        }
    }

    public function showImg($filename)
    {
        try {
            dd('bdgfgs');
            $path = storage_path('app/public/images' . $filename);
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
            $questions = Question::all();
            $test = Test::findOrFail($id);
            return view('admin.addQna', compact('questions', 'test'));
        } catch (Exception $e) {
            // Handle the exception, you can uncomment the `dd($e);` line for debugging
        }
    }
    public function addQnaToTest(Request $request)
    {
        try {
            $ids = $request->input('ids');
            $testId = $request->input('testId');
            $test = Test::findOrFail($testId);

            $qidsAsString = implode(',', $ids);
            $test->update([
                'qids' => $qidsAsString,
            ]);
            return response()->json($test);
        } catch (Exception $e) {
            // Handle the exception, you can uncomment the `dd($e);` line for debugging
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
