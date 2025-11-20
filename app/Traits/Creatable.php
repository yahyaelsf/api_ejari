<?php
namespace App\Traits;

trait Creatable
{
    protected static function bootCreatable()
    {
        if (auth()->check()) {
            static::creating(function ($model) {
                $model->fk_i_creator_id = auth()->id();
            });
        }
    }
}
