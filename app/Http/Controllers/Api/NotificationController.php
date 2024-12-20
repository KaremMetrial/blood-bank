<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateNotificationSettingRequest;
use App\Http\Resources\BloodTypeResource;
use App\Http\Resources\GovernorateResource;
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
    public function getNotificationSetting(): JsonResponse
    {
        $user = auth('api')->user();

        $data = [
            'bloodTypes' => BloodTypeResource::collection($user->bloodTypes),
            'governorates' => GovernorateResource::collection($user->governorates),
            'textNotification' => Setting::value('notification_setting_text'),
        ];

        return $this->successResponse($data, 'Notification settings retrieved successfully');
    }

    public function updateNotificationSetting(UpdateNotificationSettingRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $user = auth('api')->user();

        $user->governorates()->syncWithoutDetaching([$validated['governorate_id']]);
        $user->bloodTypes()->syncWithoutDetaching([$validated['blood_type_id']]);

        $bloodTypes = $user->bloodTypes;
        $governorates = $user->governorates;

        $data = [
            'bloodTypes' => BloodTypeResource::collection($bloodTypes),
            'governorates' => GovernorateResource::collection($governorates),
        ];

        return $this->successResponse($data, 'Notification settings updated successfully');

    }
}
