<?php

namespace App\Imports;

use App\Models\Question;
use Maatwebsite\Excel\Concerns\ToModel;


class QuestionsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (count($row) < 6) {
            return null; // Skip this row
        }

        // Create a new Question model with the data from the row
        return new Question([
            'question' => $row[0],
            'option1' => $row[1],
            'option2' => $row[2],
            'option3' => $row[3],
            'option4' => $row[4],
            'correct_option' => $row[5],
            'time' => 15,
        ]);
    }
}
