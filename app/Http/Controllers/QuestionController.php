<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use Exception;

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
                'time' => $request->time
            ];
            $question = Question::create($data);
            return $question;
        } catch (Exception $e) {
        }
    }

    public function index()
    {
        try {
            $questions = Question::paginate(4);
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
                'time' => $request->time
            ]);

            return redirect()->route('admin.question')->with('success', 'Question updated successfully.');
        } catch (Exception $e) {
            dd($e);
        }
    }
}
