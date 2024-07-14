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
            'name' => $this->name,
            'email' => $this->email,
            'role' => ucfirst($this->role->name),
            'is_admin' => $this->role->name === 'admin',
            'phone' => $this->phone_number,
            'profile_photo_path' => $this->profile_photo_path,
            'description' => $this->description,
        ];
    }
}
