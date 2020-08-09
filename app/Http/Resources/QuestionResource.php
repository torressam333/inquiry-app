<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'votes_count' => $this->votes_count,
            'answers_count' => $this->answers_count,
            'views' => $this->views,
            'status' => $this->status,
            'excerpt' => $this->excerpt,
            'created_date' => $this->created_date,
            'updated_date' => $this->updated_date,
            //Transform individual user model resource
            'user' => new UserResource($this->user),
        ];
    }
}
