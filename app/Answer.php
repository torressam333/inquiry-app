<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Parsedown;

class Answer extends Model
{
    use VoteableTrait;

    protected $fillable = ['body', 'user_id'];

    protected $appends = ['created_date', 'body_html'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function getBodyHtmlAttribute()
    {
        return clean(Parsedown::instance()->text($this->body));
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getUpdatedDateAttribute()
    {
        return $this->updated_at->since();
    }

    public function getStatusAttribute()
    {
        return $this->isBest() ? 'vote-accepted' : "";
    }

    public function getIsBestAttribute()
    {
        return $this->isBest();
    }

    public function isBest()
    {
        return $this->id === $this->question->best_answer_id;
    }

    public static function boot()
    {
        parent::boot();

        static::created(function($answer){
            $answer->question->increment('answers_count');
        });

        static::deleted(function ($answer){
            $question = $answer->question;
            $question->decrement('answers_count');

            //Match best answer id in question model with id in answer model
            if ($question->best_answer_id === $answer->id) {
                $question->best_answer_id = null;
                $question->save();
            }
        });
    }
}
