<?php

namespace App\Http\Requests;

use App\Http\Requests\Api\BaseApiRequest;

class UpdateNotificationSettingRequest extends BaseApiRequest
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
            'blood_type_id' => 'required|exists:blood_types,id',
            'governorate_id' => 'required|exists:governorates,id',
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'blood_type_id.required' => 'The blood type field is required.',
            'blood_type_id.exists' => 'The selected blood type is invalid.',
            'governorate_id.required' => 'The governorate field is required.',
            'governorate_id.exists' => 'The selected governorate is invalid.',
        ];
    }
}
