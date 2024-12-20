<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\ClientResource;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use ApiResponse;
    public function show()
    {
        $client = auth('api')->user();
        return $this->successResponse(new ClientResource($client), 'Client profile');

    }
    public function update(UpdateProfileRequest $request)
    {
        $validated = $request->validated();

        $client = auth('api')->user();

        $client->update($validated);
        
        return $this->successResponse(new ClientResource($client), 'Client profile updated');
    }
}
