<?php

namespace App\Filters;

use App\QueryFilters;
use Carbon\Carbon;

class ParentFilter extends QueryFilters
{
    public function enabled($status = null)
    {
        return strlen($status) ? $this->builder->where('b_enabled', $status) : $this->builder;
    }

    public function dt_from_date($startDate = null)
    {
        if ($startDate) {
            $startDate = request()->get('dt_from_date') . ' 00:00:00';
            return $this->builder->where('dt_created_date', '>=', $startDate);
        }

        return $this->builder;
    }

    public function dt_to_date($endDate = null)
    {
        if ($endDate) {
            $endDate = request()->get('dt_to_date') . ' 23:59:59';
            return $this->builder->where('dt_created_date', '<=', $endDate);
        }

        return $this->builder;
    }

}
