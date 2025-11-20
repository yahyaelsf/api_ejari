<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TServiceRating extends BaseModel
{
     protected $table = 't_service_ratings';
    protected $primaryKey = 'pk_i_id';
    protected $fillable = ['fk_i_user_id', 'fk_i_property_id','rating','comment'];

    public function property()
    {
        return $this->belongsTo(TProperty::class, 'fk_i_property_id', 'pk_i_id');
    }

    public function user()
    {
        return $this->belongsTo(TUser::class, 'fk_i_user_id', 'pk_i_id');
    }
}
