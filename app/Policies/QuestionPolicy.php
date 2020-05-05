<?php

namespace App\Policies;

use App\Question;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;


class QuestionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the question.
     *
     * @param  \App\User  $user
     * @param  \App\Question  $question
     * @return mixed
     */
    public function delete(User $user, Question $question)
    {
        return $user->id === $question->user_id && $question->answers < 1
            ? Response::allow()
            : Response::deny('Cannot delete this question');
    }

}
