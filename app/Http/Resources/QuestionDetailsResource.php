<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionDetailsResource extends JsonResource
{
    /**
     * Created separate Question Resource
     * for viewing questions without authorization
     * needed since questions themselves are for
     * public viewing
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'votes_count' => $this->votes_count,
            'answers_count' => $this->answers_count,
            'is_favorited'    => $this->is_favorited,
            'favorites_count' => $this->favorites_count,
            'body' => $this->body,
            'body_html' => $this->body_html,
            'created_date' => $this->created_date,
            'updated_date' => $this->updated_date,
            //Returns user info for question being returned
            'user' => new UserResource($this->user),
        ];
    }
}
