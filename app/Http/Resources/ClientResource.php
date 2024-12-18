<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'd_o_b' => $this->d_o_b,
            'blood_type' => [
                'id' => $this->bloodType->id,
                'name' => $this->bloodType->name,
            ],
            'last_donation_date' => $this->last_donation_date->diffForHumans(),
            'cities' => [
                'id' => $this->city->id,
                'name' => $this->city->name,
            ],
            'pin_code' => $this->pin_code ?? null,
        ];
    }
}
