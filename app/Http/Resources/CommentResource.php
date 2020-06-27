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
            'body' => $this->body,
            'post_id' => $this->commentable_id,
            'time' => $this->created_at->diffForHumans(),
            'parent' => new PostResource($this->whenLoaded('commentable')),
            'user' => new UserResource($this->whenLoaded('user')),
            'likes_count' => $this->likes_count,
            'likers' => UserResource::collection($this->whenLoaded('likers')),
        ];
    }
}
