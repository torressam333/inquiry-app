<?php

namespace App\Http\Controllers\Api;

use App\Answer;
use App\Question;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\AnswerResource;

class AnswersController extends Controller
{
    public function index(Question $question)
    {
        /*
         * Eager load user model because when we show answers we also show user info
         * hence the ->with('user)
         * Bring back answers belonging to questions
         * Show 3 answers at a time
         * */
        $answers = $question->answers()->with('user')->simplePaginate(4);

        return AnswerResource::collection($answers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Question $question
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Question $question, Request $request)
    {
        $request->validate([
            'body' => 'required|min:2'
        ]);

        $answer = $question->answers()->create(['body' => $request->body, 'user_id' => Auth::id()]);

        return response()->json([
            'message' => "Your answer has been submitted successfully",
            //Eager load user relationship
            'answer' => new AnswerResource($answer->load('user')),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Question $question
     * @param Answer $answer
     * @param Request $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(Request $request, Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);
        $answer->update($request->validate([
            'body' => 'required|min:2'
        ]));

        //Return json response based off Answer vue component
        return response()->json([
            //Send data to client
            'message' => 'Answer has been updated',
            'body_html' => $answer->body_html
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Question $question
     * @param Answer $answer
     * @throws AuthorizationException
     * @throws Exception
     */
    public function destroy(Question $question, Answer $answer)
    {
        $this->authorize("delete", $answer);
        $answer->delete();

        return response()->json([
            'message' => 'Answer has been deleted'
        ]);
    }
}
