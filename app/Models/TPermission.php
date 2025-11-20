<?php

namespace App\Models;

use Spatie\Permission\Models\Permission;

class TPermission extends Permission
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'parent_id',
        'guard_name',
        'display_name',
        'b_enabled'
    ];

    public function children()
    {
        return $this->hasMany('App\Models\TPermission', 'parent_id', 'id');
    }

}
