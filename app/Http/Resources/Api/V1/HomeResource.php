<?php

namespace App\Http\Resources\Api\V1;

use App\Http\Resources\Api\V1\UserDetialsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeResource extends JsonResource
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
            's_name' => $this->s_name,
            's_avatar' => asset($this->s_avatar),
            's_email' => $this->s_email,
            'b_enabled' => (bool)$this->b_enabled,
            'dt_created_date' => $this->dt_created_date?->toDateTimeString(),
            'dt_modified_date' => $this->dt_modified_date?->toDateTimeString(),
            'dt_deleted_date' => $this->dt_deleted_date?->toDateTimeString(),
        ];

    }
}
