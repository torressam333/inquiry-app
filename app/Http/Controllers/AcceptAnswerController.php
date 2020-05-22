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
        try {
            $this->authorize('accept', $answer);
        } catch (AuthorizationException $e) {
            $e->getMessage();
        }

        //Accept answer as best answer
        $answer->question->acceptBestAnswer($answer);
        return back();
    }
}
