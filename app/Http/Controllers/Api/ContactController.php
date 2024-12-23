<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ContactRequest;
use App\Models\Contact;
use App\Traits\ApiResponse;

class ContactController extends Controller
{
    use ApiResponse;
    public function contact(ContactRequest $request)
    {
        try {
            // Validate the request data
            $validated = $request->validated();
            // Add the authenticated user's ID to the validated data
            $validated['client_id'] = auth('api')->id();
            // Create the contact
            $contact = Contact::create($validated);
            // Return the contact as a JSON response
            return $this->successResponse(
                ['contact' => $contact],
                'تم ارسال الرسالة بنجاح',
                201
            );
        } catch (\Exception $e) {
            // Return an error response if the contact creation fails
            return $this->errorResponse(
                'حدث خطأ أثناء إنشاء الرسالة',
                500
            );
        }
    }
}
