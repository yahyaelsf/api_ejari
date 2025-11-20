<?php

namespace App\Filters;


class ContactUsFilters extends ParentFilter
{
    public function seen($seen = null)
    {
        $this->builder->when(strlen($seen), function ($query) use ($seen) {
            $query->where('b_seen', $seen);
        });
    }

    public function type($type = null)
    {
        $this->builder->when(strlen($type), function ($query) use ($type) {
            $query->where('e_type', $type);
        });
    }
}
