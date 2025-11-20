<?php

namespace App\Traits;


trait Resourceable
{
    public function resources()
    {
        return $this->morphMany(
            'App\Models\TResource',
            'resourceable',
            's_resourceable_type',
            'fk_i_resourceable_id',
            'pk_i_id'
        );
    }
}
