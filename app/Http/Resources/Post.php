<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User as UserResource;

class Post extends JsonResource
{
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id'    => $this->id,
            'body'  => $this->body,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
            'user' => $this->user,
            'like_count' => $this->likes->count(),
            'users_like' => UserResource::collection($this->likes->pluck('user'))
        ];
    }
}
