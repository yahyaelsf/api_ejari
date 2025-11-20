<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TCategory extends BaseModel
{
    protected $table = "t_categories";
    protected $fillable = ['s_name'];
    protected $appends = ['enabled_html'];
}
