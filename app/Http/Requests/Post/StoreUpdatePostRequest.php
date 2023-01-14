<?php

namespace App\Http\Requests\Post;

use App\Enums\Posts\PostTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreUpdatePostRequest extends FormRequest
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
            'content'   => ['required', 'max:2000', 'min:10'],
            'type'      => ['required', new Enum(PostTypeEnum::class)],
        ];
    }

    public function validationData()
    {
        return $this->payload;
    }
}
