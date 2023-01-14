<?php

namespace App\Http\Resources;

use App\Enums\Friends\FriendStatusEnum;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class FriendResource extends JsonResource
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
            'user'      => new UserResource(User::find($this->id)),
            'status'    => $this->pivot->status,
            'statusText'=> FriendStatusEnum::from($this->pivot->status)->name
        ];
    }
}
