<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Answer;

class AcceptAnswerController extends Controller
{
    public function __invoke(Answer $answer)
    {
        //Auth logic in AnswerPolicy
        $this->authorize('accept', $answer);

        //Accept answer as best answer
        $answer->question->acceptBestAnswer($answer);

        return response()->json([
           'message' => "You have accepted this answer as best answer"
        ]);
    }
}
