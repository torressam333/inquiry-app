<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;

class AcceptAnswerController extends Controller
{
    public function __invoke(Answer $answer)
    {
        //Accept answer as best answer
        $answer->question->acceptBestAnswer($answer);
        return back();
    }
}
