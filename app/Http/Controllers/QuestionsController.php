<?php

namespace App\Http\Controllers;

use App\Http\Requests\AskQuestionRequest;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class QuestionsController extends Controller
{
    public function __construct()
    {
        //Redirects to login if user is not signed in
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $questions = Question::with('user')->latest()->paginate(5);
        return view('questions.index', compact('questions'));
    }

    public function create()
    {
        $question = new Question();
        return view('questions.create', compact('question'));
    }

    public function store(AskQuestionRequest $request)
    {
        //Adds user id value to the questions model upon question creation
        $request->user()->question()->create($request->only('title', 'body'));
        return redirect()->route('questions.index')->with('success', 'Question successfully submitted');
    }

    public function show(Question $question)
    {
        //Increments the views count
        $question->increment('views');
        return view('questions.show', compact('question'));
    }

    public function edit(Question $question)
    {
        Gate::authorize('update-question', $question);
        return view('questions.edit', compact('question'));
    }

    public function update(AskQuestionRequest $request, Question $question)
    {
        Gate::authorize('update-question', $question);
        $question->update($request->only('title', 'body'));

        if ($request->expectsJson())
        {
            return response()->json([
                'message' => "Your question has been updated.",
                'body_html' => $question->body_html
            ]);
        }

        return redirect('/questions')->with('success', 'Question successfully updated');
    }

    public function destroy(Question $question)
    {
        $this->authorize("delete", $question);
        $question->delete();

        if (request()->expectsJson())
        {
            return response()->json([
                'message' => "Your question has been deleted."
            ]);
        }

        return redirect('/questions')->with('success', 'Question successfully deleted');
    }
}
