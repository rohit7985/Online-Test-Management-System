<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\QuestionsImport;


class ExcelController extends Controller
{
    public function import(Request $request)
    {
        try{
            $request->validate([
                'excel_file' => 'required|mimes:xlsx,xls'
            ]);
            $test_id = $request->input('test_id');
            Excel::import(new QuestionsImport($test_id), $request->file('excel_file'));
            return redirect()->back()->with('success', 'Excel file imported successfully');
        }catch(\Exception $e){
            dd($e);
        }
    }
}
