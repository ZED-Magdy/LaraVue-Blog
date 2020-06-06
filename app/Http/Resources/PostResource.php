<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'content' => $this->body,
            'slug' => $this->slug,
            'user' => $this->whenLoaded('User', new UserResource($this->user)),
            'category' => $this->whenLoaded('Category',new CategoryResource($this->category)),
            'time' => $this->created_at->diffForHumans()
        ];
    }
}
