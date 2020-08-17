<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Answer;
use App\Http\Controllers\Controller;

class VoteAnswerController extends Controller
{
    public function __invoke(Answer $answer)
    {
        //Ensure vote is an integer
        $vote = (int) request()->vote;
        $votesCount = auth()->user()->voteAnswer($answer, $vote);

        return response()->json([
           'message' => "Thanks for your feedback",
            'votesCount' => $votesCount
        ]);
    }
}
