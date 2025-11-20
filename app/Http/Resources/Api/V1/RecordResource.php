<?php

namespace App\Http\Resources\Api\V1;

use App\Http\Resources\Api\V1\ExerciseResource;
use Illuminate\Http\Resources\Json\JsonResource;

class RecordResource extends JsonResource
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
            'pk_i_id' => $this->pk_i_id ?? '',
            'dt_record_date' => $this->dt_record_date ?? '',
            'exercises' =>$this->whenLoaded('exercises', function () {
                return ExerciseResource::collection($this->exercises)??[];
            }),
            'dt_created_date' => $this->dt_created_date?->toDateTimeString(),
            'dt_modified_date' => $this->dt_modified_date?->toDateTimeString(),
            'dt_deleted_date' => $this->dt_deleted_date?->toDateTimeString(),
        ];
    }
}
