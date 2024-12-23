<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class FavoriteRequest extends BaseApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'post_id' => 'required|exists:posts,id',
        ];
    }
    public function messages()
    {
        return [
            'post_id.required' => 'The post id field is required.',
            'post_id.exists' => 'The selected post id is invalid.',
            'client_id.required' => 'The client id field is required.',
            'client_id.exists' => 'The selected client id is invalid.',
        ];
    }
}
