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
        return [
            'name'              => $this->name,
            'username'          => $this->username,
            'created_at'        => $this->created_at,
            'following'         => FollowingResource::collection($this->following),
            'followers'         => FollowersResource::collection($this->followers),
        ];
    }
}
