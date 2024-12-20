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
        $bloodTypes = BloodType::all();

        if ($bloodTypes->isEmpty()) {
            return $this->errorResponse('No blood types found', 404);
        }
        return $this->successResponse(
            BloodTypeResource::collection($bloodTypes),
            'Blood types retrieved successfully'
        );
    }

}
