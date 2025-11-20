<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class MeResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'pk_i_id' => $this->getKey(),
            'dt_birth_date' => $this->dt_birth_date ?? $this->dt_created_date?->toDateTimeString(),
            'i_length' => $this->i_length ?? 150,
            'i_weight' => $this->i_weight ?? 70,
            'e_level' => $this->e_level ?? 'BEGINNER',
            'e_gender' => $this->e_gender ?? 'Male',
            'b_enabled' => (bool) $this->b_enabled,
            'dt_created_date' => $this->dt_created_date?->toDateTimeString(),
            'dt_modified_date' => $this->dt_modified_date?->toDateTimeString(),
            'dt_deleted_date' => $this->dt_deleted_date?->toDateTimeString()
        ];
    }
}
