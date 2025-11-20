<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyScheduleResource extends JsonResource
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
            'id' => $this->getKey(),
            'property_reference_number' => $this->property->s_reference_number,
            'date' => $this->date,
            'from_time' => $this->from_time,
            'to_time' => $this->to_time,
            'type' => $this->type,
            'created_date' => $this->dt_created_date?->toDateTimeString(),
            'modified_date' => $this->dt_modified_date?->toDateTimeString(),
        ];
    }
}
