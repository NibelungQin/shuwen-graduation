<?php

namespace App\Http\Resources;

use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'title' => $this->title,
            'content' => $this->content,
            'image' => $this->image,
            'description' => $this->description,
            'user_id' => $this->user_id,
            'is_original' => $this->is_original,
            'published_at' => $this->published_at,
            'last_user_id' => $this->last_user_id,
            'comments_count' => $this->comments_count,
            'followers_count' => $this->followers_count,
            'view_count' => $this->view_count,
            'close_comment' => $this->close_comment,
            'is_hidden' => $this->is_hidden,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
            'user' => $this->user,
            'topics' => $this->topics,
        ];
    }
}
