<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
      return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'image_url' => $this->image_url,
            'scheduled_time' => $this->scheduled_time,
            'status' => $this->status,
             'user' => new UserMiniResource($this->whenLoaded('user')),
            'platforms' => PlatformResource::collection($this->whenLoaded('platforms')),
            'created_at' => $this->created_at,
        ];
    }
}
