git<?php


namespace App\LaravelChannels;


use Illuminate\Notifications\Notification;
use Illuminate\Support\Arr;
use Kreait\Firebase\Exception\MessagingException;
use Kreait\Firebase\Messaging\Message;
use NotificationChannels\Fcm\Exceptions\CouldNotSendNotification;
use NotificationChannels\Fcm\FcmChannel;

class CustomFcmChannel extends FcmChannel
{
    public function send($notifiable, Notification $notification)
    {
        $responses = [];
        $token = $notifiable->routeNotificationFor('fcm', $notification);

        if (empty($token)) {
            return [];
        }


        if (Arr::isAssoc($token)) {
            foreach ($token as $key => $value) {
                $responses[] = $this->prepareForNotification($notification, $notifiable, $value, $key);
            }
        } else {
            $responses[] = $this->prepareForNotification($notification, $notifiable, $token);
        }


        return $responses;
    }


    public function prepareForNotification($notification, $notifiable, $token, $lang = 'ar')
    {
        if (empty($token)) {
            return [];
        }
        // Get the message from the notification class
        $fcmMessage = $notification->toFcm($notifiable, $lang);

        if (!$fcmMessage instanceof Message) {
            throw CouldNotSendNotification::invalidMessage();
        }

        $this->fcmProject = null;
        if (method_exists($notification, 'fcmProject')) {
            $this->fcmProject = $notification->fcmProject($notifiable, $fcmMessage);
        }

        $responses = [];

        try {
            if (is_array($token)) {
                // Use multicast when there are multiple recipients
                $partialTokens = array_chunk($token, self::MAX_TOKEN_PER_REQUEST, false);
                foreach ($partialTokens as $tokens) {
                    $responses[] = $this->sendToFcmMulticast($fcmMessage, $tokens);
                }
            } else {
                $responses[] = $this->sendToFcm($fcmMessage, $token);
            }
        } catch (MessagingException $exception) {
            $this->failedNotification($notifiable, $notification, $exception);
            throw CouldNotSendNotification::serviceRespondedWithAnError($exception);
        }


        return $responses;

    }


    protected function sendToFcmMulticast($fcmMessage, array $tokens)
    {
        $tokens =  array_unique($tokens);
        return $this->messaging()->sendMulticast($fcmMessage, $tokens);
    }

}
