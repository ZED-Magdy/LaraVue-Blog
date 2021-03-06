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
            'time' => $this->created_at->diffForHumans(),
            'user' => new UserResource($this->whenLoaded('User')),
            'category' => new CategoryResource($this->whenLoaded('Category')),
            'thumbnail' => new ImageResource($this->thumbnail),
            'images' => ImageResource::collection($this->whenLoaded('Images')),
        ];
    }
}
