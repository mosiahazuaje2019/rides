<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'full_name' => $this->name.' '.$this->last_name,
            'name' => $this->name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'profile' => $this->profile,
            'email' => $this->email,
            'profile_photo_url' => $this->profile_photo_url
        ];
    }
}
