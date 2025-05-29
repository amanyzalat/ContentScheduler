<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
{
    public function __construct($resource, $token)
    {
        parent::__construct($resource);
        $this->token = $token;
    }


    public function toArray(Request $request): array
    {

            $data = [
                "id" => $this->id,
                "email" => $this->email,
                "name" => $this->name,
                'token' => $this->token ,
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at,
            ];
            return $data;

    }

}
