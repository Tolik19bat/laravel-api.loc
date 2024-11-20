<?php

namespace App\Http\Resources\V1;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'categoryId' => $this->category_id,
            'content' => $this->content,
            'created'=> Carbon::parse($this->created_at)->format('d-m-Y H:i:s'),
            'updated'=> Carbon::parse($this->updated_at)->format('d-m-Y H:i:s'),
       
        ];
    }
}
