<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use Exception;
use Illuminate\Support\Facades\Session;
use App\Models\Test;


class QuestionController extends Controller
{
    public function store(Request $request)
    {
        try {
            $data = [
                'question' => $request->question,
                'option1' => $request->option1,
                'option2' => $request->option2,
                'option3' => $request->option3,
                'option4' => $request->option4,
                'correct_option' => $request->correct_option,
            ];
            $question = Question::create($data);
            return $question;
        } catch (Exception $e) {
        }
    }

    public function index()
    {
        try {
            if(Session::get('testId') == null){
                Session::forget('testId');
            }
            $questions = Question::paginate(10);
            return view('admin.question', compact('questions'));
        } catch (Exception $e) {
            // dd($e);
        }
    }

    public function deleteQuestion($ids)
    {
        try {
            $idsArray = explode(',', $ids);
            foreach ($idsArray as $id) {
                $question = Question::findOrFail($id);
                $question->delete();
            }
            return response()->json(['success' => true]);
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function addQuestion($ids)
    {
        try {
            $idsArray = explode(',', $ids);
            $testId = Session::get('testId');
            $test = Test::find($testId);
            $questions = Question::whereIn('id', $idsArray)->get();
            $test->questions()->sync($questions);
            Session::forget('testId');
            return response()->json(['success' => true]);
        } catch (Exception $e) {
            dd($e);
        }
    }


    public function editQuestion($id)
    {
        try {
            // Find the test by ID and delete it
            $question = Question::findOrFail($id);
            return response()->json($question);
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function updateQuestion(Request $request, $id)
    {
        try {
            $student = Question::findOrFail($id);
            $student->update([
                'question' => $request->question,
                'option1' => $request->option1,
                'option2' => $request->option2,
                'option3' => $request->option3,
                'option4' => $request->option4,
                'correct_option' => $request->correct_option,
            ]);

            return redirect()->route('admin.question')->with('success', 'Question updated successfully.');
        } catch (Exception $e) {
            dd($e);
        }
    }
}
