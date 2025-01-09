<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'notification_setting_text' => $this->notification_setting_text,
            'about_app' => $this->about_app,
            'phone' => $this->phone,
            'email' => $this->email,
            'f_link' => $this->f_link,
            'ins_link' => $this->ins_link,
            'y_link' => $this->y_link,
            't_link' => $this->t_link,
        ];
    }
}
