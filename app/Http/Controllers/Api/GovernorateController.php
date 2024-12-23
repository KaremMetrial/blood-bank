<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GovernorateResource;
use App\Models\Governorate;
use App\Traits\ApiResponse;

class GovernorateController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /// Get all governorates
        $governorates = Governorate::all();
        // Check if there are any governorates
        if ($governorates->isEmpty()) {
            return $this->errorResponse('No governorates found', 404);
        }
        // Return the governorates as a resource collection
        return $this->successResponse(GovernorateResource::collection($governorates), 'Governorates retrieved successfully');
    }

}
