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
        $governorates = Governorate::all();

        if ($governorates->isEmpty()) {
            return $this->errorResponse('No governorates found', 404);
        }

        return $this->successResponse(GovernorateResource::collection($governorates), 'Governorates retrieved successfully');
    }

}
