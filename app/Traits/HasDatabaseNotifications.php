<?php


namespace App\Traits;


use App\Models\TNotification;

trait HasDatabaseNotifications
{

    public function notifications()
    {
        return $this->morphMany(TNotification::class, 'notifiable')->latest();
    }


    public function readNotifications()
    {
        return $this->notifications()->read();
    }


    public function unreadNotifications()
    {
        return $this->notifications()->unread();
    }
}
