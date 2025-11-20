<?php


namespace App\Filters\Api;

use App\Filters\ParentFilter;
use App\Models\TActivity;
use App\Models\TReservation;

class NotificationFilter extends ParentFilter
{

    public function b_seen($seen = null)
    {
        $this->builder->when(strlen($seen), function ($query) use ($seen) {
            if ($seen) {
                $query->whereNotNull('dt_seen_date');
            } else {
                $query->whereNull('dt_seen_date');
            }
        });
    }

    public function i_interest_id($interestId = '')
    {
        $this->builder->when($interestId, function ($query) use ($interestId) {
            $query->where(function ($query) use ($interestId) {
                $query->whereHasMorph(
                    'targetable',
                    [TActivity::class],
                    function ($query) use ($interestId) {
                        $query->where('fk_i_interest_id', $interestId);
                    }
                )->orWhereHasMorph(
                    'targetable',
                    [TReservation::class],
                    function ($query) use ($interestId) {
                        $query->whereHas('activity', function ($query) use ($interestId) {
                            $query->where('fk_i_interest_id', $interestId);
                        });
                    }
                );
            });
        });
    }


    public function s_title($name = '')
    {
        $this->builder->when($name, function ($query) use ($name) {
            $query->whereHasMorph(
                'targetable',
                [TActivity::class],
                function ($query) use ($name) {
                    $query->where('s_title', $name);
                }
            )->orWhereHasMorph(
                'targetable',
                [TReservation::class],
                function ($query) use ($name) {
                    $query->whereHas('activity', function ($query) use ($name) {
                        $query->where('s_title', 'like', '%' . $name . '%');
                    });
                }
            );
        });
    }
}
