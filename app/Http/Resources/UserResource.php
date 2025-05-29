<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $profileImage = $this->getMedia('profile_images');
        return [
            'id' => $this->id,
            'username' => $this->username,
            'phone' => $this->phone,
        
            'email' => $this->email,
            'title' => $this->firstname,
            'image' => $profileImage ? MediaResource::collection($profileImage) : null,
            // 'is_verify'=> $this->is_verify ? true : false ,
            'is_verify'=> true ,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}