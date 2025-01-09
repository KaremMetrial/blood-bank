<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateNotificationSettingRequest;
use App\Http\Resources\BloodTypeResource;
use App\Http\Resources\GovernorateResource;
use App\Http\Resources\NotificationResource;
use App\Models\Setting;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    use ApiResponse;

    /**
     * Get user notification settings
     *
     * @return JsonResponse
     */

    public function index()
    {
        $notifications = auth('api')->user()
        ->notifications()
        ->latest()
        ->take(3)
        ->get();

        return $this->successResponse(
            NotificationResource::collection($notifications),
            'Notifications retrieved successfully'
        );
        }

    public function getNotificationSetting(): JsonResponse
    {
        // Get the authenticated user
        $user = auth('api')->user();
        // Prepare the data to be returned
        $data = [
            'bloodTypes' => BloodTypeResource::collection($user->bloodTypes),
            'governorates' => GovernorateResource::collection($user->governorates),
            'textNotification' => Setting::value('notification_setting_text'),
        ];

        // Return a successful response
        return $this->successResponse($data, 'Notification settings retrieved successfully');
    }

    public function updateNotificationSetting(UpdateNotificationSettingRequest $request): JsonResponse
    {
        try {
            // Validate the request data
            $validated = $request->validated();
            // Get the authenticated user
            $user = auth('api')->user();

            // Update the user's notification settings
            $user->governorates()->sync([$validated['governorate_id']]);
            $user->bloodTypes()->sync([$validated['blood_type_id']]);

            // Return a successful response
            return $this->successResponse([
                'status' => true,
            ], 'Notification settings updated successfully');
        } catch (\Exception $e) {
            // Return an error response
            return $this->errorResponse('Notification settings updated failed', 500);
        }
    }
}
