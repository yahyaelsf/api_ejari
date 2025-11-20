<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TPackage extends BaseModel
{
    protected $table = 't_packages';
    protected $primaryKey = 'pk_i_id';
    protected $fillable = ['s_title', 's_description','i_price'];

}
