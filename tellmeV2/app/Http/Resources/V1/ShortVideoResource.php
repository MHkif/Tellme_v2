<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShortVideoResource extends JsonResource
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
            'url' => $this->url,
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
            'createdAt' => $this->created_at->diffForHumans()
        ];
    }
}
