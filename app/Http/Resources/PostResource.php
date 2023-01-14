<?php

namespace App\Http\Resources;

use App\Enums\Posts\PostTypeEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'content'   => $this->content,
            'type'    => PostTypeEnum::from($this->type)->name,
            'updated_at' => $this->updated_at->format('j M y \a\t H:i'),
            'user'      => new UserResource($this->user),
        ];
    }
}
