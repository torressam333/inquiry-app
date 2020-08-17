<?php

namespace App\Http\Controllers\Api;

use App\Question;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VoteQuestionController extends Controller
{
    public function __invoke(Question $question)
    {
        //Ensure vote is an integer
       $vote = (int) request()->vote;
       $votesCount = auth()->user()->voteQuestion($question, $vote);

        return response()->json([
            'message' => "Thanks for your feedback",
            'votesCount' => $votesCount
        ]);
    }
}
