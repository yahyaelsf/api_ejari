<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class WalkthroughResource extends JsonResource
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
            's_title' => $this->s_title,
            's_description' => $this->s_description,
            's_image' => $this->s_cover ? asset($this->s_cover) : '',
            'dt_created_date' => $this->dt_created_date?->toDateTimeString(),
            'dt_modified_date' => $this->dt_modified_date?->toDateTimeString(),
            'dt_deleted_date' => $this->dt_deleted_date?->toDateTimeString(),
        ];
    }
}
