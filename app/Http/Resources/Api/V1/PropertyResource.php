<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
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
            's_cover' => $this->s_cover ? asset($this->s_cover) : '',
            'address' => $this->s_address,
            'conditions' => $this->s_conditions,
            'category' => $this->category->s_name,
            'description' => $this->s_description,
            'price' => $this->n_price,
            'area' => $this->s_area,
            'family_members' => $this->n_family_members,
            'rooms' => $this->n_rooms,
            'bathrooms' => $this->n_bathrooms,
            'lounges' => $this->n_lounges,
            'floors' => $this->s_floors,
            'furnished' => __('general.' . $this->e_furnished),
            'status' => __('general.' . $this->e_status),
            'finishing_quality' => __('general.' . $this->e_finishing_quality),
            'additional_features' => $this->s_additional_features,
            'surrounding_area' => $this->s_surrounding_area,
            'water_conservation' => __('general.' . $this->e_water_conservation),
            'reference_number' => $this->s_reference_number,
            'enabled' => (bool)$this->b_enabled,
            'created_date' => $this->dt_created_date?->toDateTimeString(),
            'modified_date' => $this->dt_modified_date?->toDateTimeString(),
        ];
    }
}
