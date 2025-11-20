<?php

namespace App\Filters;


use App\Models\TUser;
use Illuminate\Database\Eloquent\Builder;

class NotificationFilters extends ParentFilter
{
    public function seen($seen = null)
    {
        $this->builder->when(strlen($seen), function ($query) use ($seen) {
            if ($seen) {
                $query->whereNotNull('dt_seen_date');
            } else {
                $query->whereNull('dt_seen_date');
            }
        });
    }


    public function user($user = null)
    {
        $this->builder->when($user, function ($query) use ($user) {
            $query->whereHasMorph(
                'notifiable',
                [TUser::class],
                function (Builder $query) use ($user) {
                    $query->where('pk_i_id', '=', $user);
                }
            );
        });
    }
}
