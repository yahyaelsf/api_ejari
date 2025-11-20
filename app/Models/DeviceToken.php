<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceToken extends Model
{
    use HasFactory;
    protected $fillable = ['user_id' , 'token' , 'device'];
     public function user(){
        return $this->belongsTo(TUser::class , 'fk_i_user_id', 'pk_i_id');
     }
}
