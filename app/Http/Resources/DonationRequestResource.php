<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DonationRequestResource extends JsonResource
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
            'patient_name' => $this->patient_name,
            'patient_phone' => $this->patient_phone,
            'hospital_name' => $this->hospital_name,
            'blood_type' => [
                'id' => $this->bloodType->id,
                'name' => $this->bloodType->name,
            ],
            'patient_age' => $this->patient_age,
            'bags_num' => $this->bags_num,
            'hospital_address' => $this->hospital_address,
            'details' => $this->details,
            'latitude' => $this->latitude,
            'longtitude' => $this->longtitude,
            'city' => [
                'id' => $this->city->id,
                'name' => $this->city->name,
            ],
            'client' => [
                'id' => $this->client->id,
                'name' => $this->client->name,
                'phone' => $this->client->phone,
                'email' => $this->client->email,
            ],
            'created_at' => $this->created_at,
        ];
    }
}
