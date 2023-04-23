<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlayListResource extends JsonResource
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
            'name' => $this->name,
            // 'description' => $this->description,
            // 'url' => $this->url,
            // 'category_id' => $this->category_id,
            // 'cover' => $this->cover,
            'createdAt' => $this->created_at->diffForHumans()
        ];
    }
}
