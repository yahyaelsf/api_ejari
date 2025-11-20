<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            's_id_image' => asset($this->s_id_image) ?? '',
            's_email' => $this->s_email,
            'b_enabled' => (bool)$this->b_enabled,
            'dt_created_date' => $this->dt_created_date?->toDateTimeString(),

        ];
    }
}
