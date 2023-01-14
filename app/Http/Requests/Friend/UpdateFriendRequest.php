<?php

namespace App\Http\Requests\Friend;

use App\Enums\Friends\FriendStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateFriendRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
//            'friend_id'   => ['required', 'exists:friends,id'],
            'type'        => ['required', new Enum(FriendStatusEnum::class)]
        ];
    }
}
