<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ShortPropertyResource extends JsonResource
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
            's_cover' => $this->property->s_cover ? asset($this->property->s_cover) : '',
            'address' => $this->property->s_address,
            'category' => $this->property->category->s_name,
            'price' => $this->property->n_price,
            'enabled' => (bool)$this->property->b_enabled,
            'created_date' => $this->property->dt_created_date?->toDateTimeString(),
        ];
    }
}
