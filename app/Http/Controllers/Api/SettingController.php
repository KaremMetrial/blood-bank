<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SettingResource;
use App\Models\Setting;
use App\Traits\ApiResponse;

class SettingController extends Controller
{
    use ApiResponse;
    public function index()
    {
        // Get all settings
        $settings = Setting::all();
        // Check if settings are empty
        if ($settings->isEmpty()) {
            // Return error response
            return $this->errorResponse('No settings found', 404);
        }
        $data = SettingResource::collection($settings);
        // Return success response with data
        return $this->successResponse($data, 'Settings retrieved successfully');
    }
}
