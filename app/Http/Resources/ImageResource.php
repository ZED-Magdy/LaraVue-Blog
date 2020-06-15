<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Config;

class ImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //Config::get('app.url')."/storage/".
        return [
            'id' => $this->id,
            'user' => new UserResource($this->whenLoaded('User')),
            'url' => $this->url,
            'time' => $this->created_at->diffForHumans()
        ];
    }
}
