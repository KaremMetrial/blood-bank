<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BloodTypeResource;
use App\Models\BloodType;
use App\Traits\ApiResponse;

class BloodTypeController extends Controller
{
    use ApiResponse;

    public function index()
    {
        // Retrieve all blood types from the database
        $bloodTypes = BloodType::all();
        // Check if any blood types were found
        if ($bloodTypes->isEmpty()) {
            // Return an error response if no blood types were found
            return $this->errorResponse('No blood types found', 404);
        }
        // Return a success response with the blood types
        return $this->successResponse(
            BloodTypeResource::collection($bloodTypes),
            'Blood types retrieved successfully'
        );
    }

}
