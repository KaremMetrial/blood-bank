<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Models\City;
use App\Traits\ApiResponse;

class CityController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::with('governorate')->get();

        if ($cities->isEmpty()) {
            return $this->errorResponse('No cities found', 404);
        }
        return $this->successResponse(CityResource::collection($cities), 'Cities retrieved successfully');
    }

}
