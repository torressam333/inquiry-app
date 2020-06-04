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
        return back();
    }

    public function destroy(Question $question)
    {
        $question->favorites()->detach(auth()->id());
        return back();
    }
}
