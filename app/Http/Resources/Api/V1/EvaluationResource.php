<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class EvaluationResource extends JsonResource
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
            'b_enabled' => (bool)$this->b_enabled,
            'dt_created_date' => $this->dt_created_date?->toDateTimeString(),
            'dt_modified_date' => $this->dt_modified_date?->toDateTimeString(),
            'dt_deleted_date' => $this->dt_deleted_date?->toDateTimeString(),
        ];
    }
}
