<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Question;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\QuestionResource;
use Illuminate\Support\Facades\Gate;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        //Return all questions as JSON
        $questions = Question::with('user')->latest()->paginate(4);

        //Transform collection into JSON structure
        return QuestionResource::collection($questions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AskQuestionRequest $request
     * @return JsonResponse
     */
    public function store(AskQuestionRequest $request)
    {
        //Adds user id value to the questions model upon question creation
        $question = $request->user()->question()->create($request->only('title', 'body'));

        //return a json response containing a message that we can grab from the view.
        return response()->json([
            'message' => 'Your question has been submitted',
            'question' => new QuestionResource($question),
        ]);
    }

    /**
     * Display the specified api resource.
     *
     * @param Question $question
     * @return JsonResponse
     */
    public function show(Question $question)
    {
        return \response()->json([
            'title' => $question->title,
            'body' => $question->body,
            'body_html' => $question->body_html
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Question $question
     * @return JsonResponse
     */
    public function update(Request $request, Question $question)
    {
        Gate::authorize('update-question', $question);
        $question->update($request->only('title', 'body'));

        return response()->json([
            'message' => "Your question has been updated.",
            'body_html' => $question->body_html
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Question $question
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Question $question)
    {
        $this->authorize("delete", $question);

        $question->delete();

        return response()->json([
            'message' => "Your question has been deleted."
        ]);
    }
}
