<?php

namespace App\Http\Controllers;

use App\Http\Requests\AskQuestionRequest;
use App\Question;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function index()
    {
        $questions = Question::with('user')->latest()->paginate(10);
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
        //
    }

    public function edit(Question $question)
    {
        return view('questions.edit', compact('question'));
    }

    public function update(AskQuestionRequest $request, Question $question)
    {
        $question->update($request->only('title', 'body'));
        return redirect('/questions')->with('success', 'Question successfully updated');
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return redirect('/questions')->with('success', 'Question successfully deleted');
    }
}
