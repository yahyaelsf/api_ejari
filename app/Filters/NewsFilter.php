<?php

namespace App\Filters;

use App\QueryFilters;

class NewsFilter extends ParentFilter
{

    public function type($type = null)
    {
        return $this->builder->when($type, function ($query) use ($type) {
            return $query->where('e_type', strtoupper($type));
        });
    }

}
