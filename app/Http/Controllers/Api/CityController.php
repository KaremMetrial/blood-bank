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
        // Retrieve all cities with their associated governorate
        $cities = City::with('governorate')->get();
        // Check if any cities were found
        if ($cities->isEmpty()) {
            return $this->errorResponse('No cities found', 404);
        }
        // Return the cities as a resource collection
        return $this->successResponse(CityResource::collection($cities), 'Cities retrieved successfully');
    }

}
