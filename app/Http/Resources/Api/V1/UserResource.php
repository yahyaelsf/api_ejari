<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;
class UserResource extends JsonResource
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
            's_id_number' => $this->s_id_number,
            's_mobile' => $this->s_mobile,
            's_mobile_whats' => $this->s_mobile_whats,
            's_avatar' => asset($this->s_avatar) ?? '',
            's_email' => $this->s_email,
            'b_enabled' => (bool)$this->b_enabled,
            $this->mergeWhen($this->s_access_token, function () {
                return ['s_access_token' => 'Bearer ' . $this->s_access_token];
            }),
            'dt_created_date' => $this->dt_created_date?->toDateTimeString(),
            // 'dt_modified_date' => $this->dt_modified_date?->toDateTimeString(),
            // 'dt_deleted_date' => $this->dt_deleted_date?->toDateTimeString(),
        ];
    }
}
