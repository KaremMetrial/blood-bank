<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ContactRequest;
use App\Models\Contact;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    use ApiResponse;
    public function contact(ContactRequest $request)
    {

        $validated = $request->validated();
        $validated['client_id'] = auth('api')->id();

        $contact = Contact::create($validated);

        return $this->successResponse(
            ['contact' => $contact],
            'تم ارسال الرسالة بنجاح',
            201
        );

    }
}
