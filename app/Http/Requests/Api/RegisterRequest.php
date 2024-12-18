<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends BaseApiRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255', 'unique:clients'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:clients'],
            'password' => [
                'required',
                'string',
                'min:6',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            ],
            'd_o_b' => ['required', 'date'],
            'blood_type_id' => ['required', 'integer', 'exists:blood_types,id'],
            'last_donation_date' => ['required', 'date'],
            'city_id' => ['required', 'integer', 'exists:cities,id'],
        ];
    }

    public function messages(): array
    {

        return [
            'name.required' => 'الاسم مطلوب',
            'name.string' => 'الاسم يجب أن يكون نصا',
            'phone.required' => 'رقم الهاتف مطلوب',
            'phone.unique' => 'رقم الهاتف مستخدم من قبل',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.unique' => 'البريد الإلكتروني مستخدم من قبل',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.min' => 'يجب ألا تقل كلمة المرور عن 6 أحرف',
            'password.confirmed' => 'تأكيد كلمة المرور غير متطابق',
            'password.regex' => 'يجب أن تحتوي كلمة المرور على حرف كبير واحد على الأقل، وحرف صغير واحد، ورقم واحد، وحرف خاص واحد',
            'd_o_b.required' => 'تاريخ الميلاد مطلوب',
            'd_o_b.date' => 'تاريخ ميلاد غير صالح',
            'blood_type_id.required' => 'فصيلة الدم مطلوبة',
            'blood_type_id.exists' => 'فصيلة الدم غير موجودة',
            'last_donation_date.required' => 'تاريخ آخر تبرع مطلوب',
            'city_id.required' => 'المدينة مطلوبة',
        ];
    }

}
