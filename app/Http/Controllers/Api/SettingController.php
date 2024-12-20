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
        $settings = Setting::all();

        if ($settings->isEmpty()) {
            return $this->errorResponse('No settings found', 404);
        }
        $data = SettingResource::collection($settings);

        return $this->successResponse($data, 'Settings retrieved successfully');
    }
}
