<?php

namespace App\Http\Resources\Api\V1;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class NotifiactionResource extends JsonResource
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
            'e_type' => $this->e_type,
            's_title' => $this->getTranslatedTitle() ?? '',
            's_message' => $this->getTranslatedMessage() ?? '',
            // 'sender' => $this->whenLoaded('sender', function () {
            //     return new ShortUserResource($this->sender);
            // }),
            'fk_i_data_id' => $this->targetable_id,
            'dt_seen_date' => Carbon::parse($this->dt_seen_date)?->toDateTimeString(),
            'dt_created_date' => $this->dt_created_date?->toDateTimeString(),
            'dt_modified_date' => $this->dt_modified_date?->toDateTimeString(),
            'dt_deleted_date' => $this->dt_deleted_date?->toDateTimeString(),
        ];
    }
    protected function getParams()
    {
        return $this->s_params ? unserialize($this->s_params) : [];
    }


    protected function getTranslatedTitle()
    {
        return $this->s_title ? trans($this->s_title, $this->getParams()) : '';
    }


    protected function getTranslatedMessage()
    {
        return $this->s_message ? trans($this->s_message, $this->getParams()) : '';
    }
}
