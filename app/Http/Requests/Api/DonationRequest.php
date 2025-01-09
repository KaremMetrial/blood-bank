<?php

namespace App\Http\Requests\Api;

class DonationRequest extends BaseApiRequest
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
            'patient_name' => 'required|string|max:255',
            'patient_phone' => 'required|string|max:20',
            'city_id' => 'required|exists:cities,id',
            'hospital_name' => 'required|string|max:255',
            'blood_type_id' => 'required|exists:blood_types,id',
            'patient_age' => 'required|integer|min:1',
            'bags_num' => 'required|integer|min:1',
            'hospital_address' => 'required|string|max:255',
            'details' => 'nullable|string',
            'latitude' => 'required|numeric',
            'longtitude' => 'required|numeric',
        ];
    }
    public function messages(): array
    {
        return [
            'patient_name.required' => 'The patient name field is required.',
            'patient_name.string' => 'The patient name must be a string.',
            'patient_name.max' => 'The patient name may not be greater than 255 characters.',
            'patient_phone.required' => 'The patient phone field is required.',
            'patient_phone.string' => 'The patient phone must be a string.',
            'patient_phone.max' => 'The patient phone may not be greater than 20 characters.',
            'city_id.required' => 'The city field is required.',
            'city_id.exists' => 'The selected city is invalid.',
            'hospital_name.required' => 'The hospital name field is required.',
            'hospital_name.string' => 'The hospital name must be a string.',
            'hospital_name.max' => 'The hospital name may not be greater than 255 characters.',
            'blood_type_id.required' => 'The blood type field is required.',
            'blood_type_id.exists' => 'The selected blood type is invalid.',
        ];
    }
}
