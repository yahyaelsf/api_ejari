<?php

namespace App\Http\Controllers;

use App\Filters\Api\NotificationFilter;
use App\Http\Controllers\Api\V1\ApiBaseController;
use App\Http\Resources\Api\V1\NotifiactionResource;
use App\Http\Resources\Api\V1\UserResource;
use Illuminate\Http\Request;
use App\Http\Resources\Api\V1\NotificationResource;
use Carbon\Carbon;

class NotificationController extends ApiBaseController
{
    public function index(NotificationFilter $filter)
    {
        $notificationBuilder = auth()->user()->notifications();

        if (request()->get('b_just_read', 0)) {
            $notificationCount = $notificationBuilder->newQuery()->whereNull('dt_seen_date')->count();
            return $this->setSuccess()
                ->addResponseField('i_unread_notifications', $notificationCount)
                ->getResponse();
        }

        $notifications = $notificationBuilder->with('sender')->filter($filter)->paginate();
        $notificationBuilder->update(['dt_seen_date' => Carbon::now()]);


        return $this->setSuccess()
            ->addResource(NotifiactionResource::collection($notifications), 'notifications')
            ->getResponse();
    }


    public function count(Request $request)
    {

        $userNotifications = auth()->user()->notifications()->whereNull('dt_seen_date');
        $count = $userNotifications->count();

        return $this->setSuccess("")
            ->addResponseField('count', $count)
            ->getResponse();
    }

}
