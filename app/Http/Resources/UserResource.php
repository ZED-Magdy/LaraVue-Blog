<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'time' => $this->created_at->diffForHumans(),
            'avatar' => new ImageResource($this->thumbnail),
            'roles' => RoleResource::collection($this->whenLoaded('roles'))
        ];
    }
}
