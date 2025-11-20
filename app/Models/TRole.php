<?php

namespace App\Models;

use DateTimeInterface;
use Spatie\Permission\Models\Role;

class TRole extends Role
{
    protected $fillable = ['name', 'guard_name', 'display_name'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
