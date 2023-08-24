<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'ID' => $this->id,
            'name' => $this->name,
            'count_books' => $this->loadCount('books')->books_count,
            'books' => BookResource::collection($this->whenLoaded('books')),
        ];
    }
}
