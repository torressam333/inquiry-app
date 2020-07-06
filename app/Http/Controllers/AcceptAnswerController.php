<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Answer;

class AcceptAnswerController extends Controller
{
    public function __invoke(Answer $answer)
    {
        //Auth logic in AnswerPolicy
        $this->authorize('accept', $answer);

        //Accept answer as best answer
        $answer->question->acceptBestAnswer($answer);

        if (request()->expectsJson()) {
            return response()->json([
               'message' => "You have accepted this answer as best answer"
            ]);
        }
        return back();
    }
}
