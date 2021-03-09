<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'data' => [
                'type' => 'posts',
                'attributes' => [
                    'id' => $this->id,
                    'author' => $this->user->name,
                    'body' => $this->body,
                ]
            ],
            'links' => [
                'self' => route('posts.show', $this->id)
            ]
        ];
    }
}
