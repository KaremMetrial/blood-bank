<?php

namespace App\Http\Requests\Api;

class ContactRequest extends BaseApiRequest
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
            'subject' => 'required|string',
            'message' => 'required|string',
        ];
    }
    public function messages(): array
    {
        return [
            'subject.required' => 'الموضوع مطلوب.',
            'subject.string' => 'الموضوع يجب أن يكون نصًا.',
            'message.required' => 'الرسالة مطلوبة.',
            'message.string' => 'الرسالة يجب أن تكون نصًا.',
        ];
    }
}
