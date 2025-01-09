<?php

namespace App\Http\Requests;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends BaseApiRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:clients,email,' . auth('api')->id()],
            'phone' => ['required', 'string', 'unique:clients,phone,' . auth('api')->id()],
            'd_o_b' => ['required', 'date'],
            'blood_type_id' => ['required', 'exists:blood_types,id'],
            'last_donation_date' => ['required', 'date'],
            'city_id' => ['required', 'exists:cities,id'],
            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
            ],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'name.string' => 'الاسم يجب أن يكون نصا',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.unique' => 'البريد الإلكتروني مستخدم من قبل',
            'phone.required' => 'رقم الهاتف مطلوب',
            'phone.unique' => 'رقم الهاتف مستخدم من قبل',
            'd_o_b.required' => 'تاريخ الميلاد مطلوب',
            'd_o_b.date' => 'تاريخ ميلاد غير صالح',
            'blood_type_id.required' => 'فصيلة الدم مطلوبة',
            'blood_type_id.exists' => 'فصيلة الدم غير موجودة',
            'last_donation_date.required' => 'تاريخ آخر تبرع مطلوب',
            'city_id.required' => 'المدينة مطلوبة',
            'password.min' => 'يجب ألا تقل كلمة المرور عن 8 أحرف',
            'password.confirmed' => 'تأكيد كلمة المرور غير متطابق',
            'password.regex' => 'يجب أن تحتوي كلمة المرور على حرف كبير واحد على الأقل، وحرف صغير واحد، ورقم واحد، وحرف خاص واحد'
        ];
    }
}
