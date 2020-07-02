<?php

namespace App\Http\Controllers;

use App\Question;

class FavoritesController extends Controller
{
    public function __construct()
    {
        //Auth middleware to ensure the user favoriting the question has signed in
        $this->middleware('auth');
    }

    public function store(Question $question)
    {
        $question->favorites()->attach(auth()->id());

        if (request()->expectsJson()) {
            return response()->json(null, 204);
        }

        return back();
    }

    public function destroy(Question $question)
    {
        $question->favorites()->detach(auth()->id());

        if (request()->expectsJson()) {
            return response()->json(null, 204);
        }

        return back();
    }
}
