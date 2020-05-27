<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AnswersController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param Question $question
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Question $question, Request $request)
    {
        $request->validate([
           'body' => 'required|min:2'
        ]);

        $question->answers()->create(['body' => $request->body, 'user_id'=> Auth::id()]);

        return back()->with('success', "Your answer has been submitted successfully");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Question $question
     * @param Answer $answer
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function edit(Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);
        return view('answers._edit', compact('question','answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Question $question
     * @param Answer $answer
     * @param Request $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(Request $request, Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);
        $answer->update($request->validate([
            'body' => 'required|min:2'
        ]));

        return redirect()
            ->route('questions.show', $question->slug)
            ->with('success', 'Answer has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Question $question
     * @param Answer $answer
     * @return RedirectResponse
     * @throws AuthorizationException
     * @throws Exception
     */
    public function destroy(Question $question, Answer $answer)
    {
        $this->authorize("delete", $answer);
        $answer->delete();

        return redirect()
            ->route('questions.show', $question->slug)
            ->with('success', 'Answer has been deleted');
    }
}