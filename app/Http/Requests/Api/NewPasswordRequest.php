<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class NewPasswordRequest extends BaseApiRequest
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
            'phone' => ['required', 'exists:clients,phone'],
            'pin_code' => ['required', 'digits:6'],
            'password' => [
                'required',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            ],
        ];

    }
    public function messages(): array
    {
        return [
            'phone.required' => 'يرجى إدخال رقم الهاتف',
            'phone.exists' => 'رقم الهاتف غير موجود',
            'pin_code.required' => 'يرجى إدخال كود التحقق',
            'pin_code.digits' => 'كود التحقق يجب أن يتكون من 6 أرقام',
            'password.required' => 'يرجى إدخال كلمة المرور',
            'password.regex' => 'يجب أن تحتوي كلمة المرور على حرف كبير واحد على الأقل، وحرف صغير واحد، ورقم واحد، وحرف خاص واحد',
            'password.min' => 'يجب أن تتكون كلمة المرور من 8 أحرف على الأقل',
            'password.confirmed' => 'كلمة المرور غير متطابقة',
        ];

    }

}
