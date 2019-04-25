<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => $this->user,
            'parent_id' => $this->parent_id,
            'reply_user' => $this->reply_user,
            'body' => $this->body,
            'commentable' => $this->whenLoaded('commentable'),
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
