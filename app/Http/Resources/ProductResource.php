<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->whenNotNull($this->id),
            'title' => $this->whenNotNull($this->title),
            'description' => $this->whenNotNull($this->description),
            'price' => $this->whenNotNull($this->price),
            'users' => UserResource::collection($this->whenLoaded('users')),
        ];
    }
}
