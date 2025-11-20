<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'name' => $this->s_name,
            // 's_cover' => $this->s_cover ? asset($this->s_cover) : '',
            'b_enabled' => (bool)$this->b_enabled,
            'created_date' => $this->dt_created_date?->toDateTimeString(),
            'modified_date' => $this->dt_modified_date?->toDateTimeString(),
            // 'dt_deleted_date' => $this->dt_deleted_date?->toDateTimeString(),
        ];
    }
}
