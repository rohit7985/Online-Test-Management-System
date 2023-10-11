<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactFormRequest;
use App\Models\ContactUsDetail;
use Exception;

class ContactUsController extends Controller
{
    public function store(ContactFormRequest $request)
    {
        $data = $request->validated();
        ContactUsDetail::create($data);
        return redirect()->back()->with('success', 'Message sent successfully!');
    }

    public function index(){ 
        try{
            $contacts = ContactUsDetail::all();
            return view('admin.contact',compact('contacts'));
        }catch(Exception $e){
            dd($e);
        }
            
    }

    public function deleteContact($id)
    {
        try {
            
                $question = ContactUsDetail::findOrFail($id);
                $question->delete();
            return response()->json(['success' => true]);
        } catch (Exception $e) {
            dd($e);
        }
    }
}
