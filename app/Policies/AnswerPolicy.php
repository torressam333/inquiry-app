<?php

namespace App\Policies;

use App\Answer;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AnswerPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can update the answer.
     *
     * @param User $user
     * @param Answer $answer
     * @return mixed
     */
    public function update(User $user, Answer $answer)
    {
        return $user->id === $answer->user_id
            ? Response::allow()
            : Response::deny('You are note authorized to edit this answer');
    }

    public function accept(User $user, Answer $answer)
    {
        return $user->id === $answer->question->user_id
            ? Response::allow()
            : Response::deny('You cannot accept an answer on someone else question');
    }

    /**
     * Determine whether the user can delete the answer.
     *
     * @param User $user
     * @param Answer $answer
     * @return mixed
     */
    public function delete(User $user, Answer $answer)
    {
        return $user->id === $answer->user_id
            ? Response::allow()
            : Response::deny('You are not authorized to delete this answer');
    }
}

