<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function question()
    {
        return $this->hasMany(Question::class);
    }

    public function getUrlAttribute()
    {
        return '#';
    }

    public function getAvatarAttribute()
    {
        //SOURCE: https://en.gravatar.com/site/implement/images/php/

        $email = $this->email;
        $size = 30;
        return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?s=" . $size;
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Question::class, 'favorites')->withTimestamps();
    }

    public function voteQuestions()
    {
        return $this->morphedByMany(Question::class, 'voteable');
    }

    public function voteAnswers()
    {
        return $this->morphedByMany(Answer::class, 'voteable');
    }

    public function voteQuestion(Question $question, $vote)
    {
        //Make sure user has not already voted for the same question
        $voteQuestions = $this->voteQuestions();
        if ($voteQuestions->where('voteable_id', $question->id)->exists()) {
            $voteQuestions->updateExistingPivot($question, ['vote' => $vote]);
        }else{
            $voteQuestions->attach($question, ['vote' => $vote]);
        }

        //Recount total number of votes when user votes for a question
        /*https://laravel.com/docs/7.x/eloquent-relationships#lazy-eager-loading*/
        $question->load('votes');
        $downVotes = (int) $question->downVotes()->sum('vote');
        $upVotes = (int) $question->upVotes()->sum('vote');
        $question->votes_count = $upVotes + $downVotes;
        $question->save();
    }
}
