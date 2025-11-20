<?php

namespace App\Notifications;

use App\LaravelChannels\CustomFcmChannel;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\ApnsConfig;
use NotificationChannels\Fcm\Resources\ApnsFcmOptions;


class BaseFcmNotification extends Notification
{
    protected $key;
    protected $title;
    protected $message;
    protected $params;
    protected $i_data_type;
    protected $target;

    public function __construct($title, $params = [], $message = '', $target = null)
    {
        $this->title = $title;
        $this->message = $message;
        $this->params = $params;
        $this->target = $target;
    }

    public function via($notifiable)
    {
        $this->saveToDataBase($notifiable);
        return [CustomFcmChannel::class];
    }


    public function getTranslatedTitle($locale)
    {
        return trans($this->title, $this->params, $locale);
    }

    public function getTranslatedMessage($locale)
    {
        return trans($this->message, $this->params, $locale);
    }


    public function saveToDataBase($notifiable)
    {
        try {
            $notifiable->notifications()->create([
                'e_type' => $this->key,
                's_title' => $this->title,
                's_message' => $this->message,
                'fk_i_sender_id' => auth()->id(),
                'targetable_type' => $this->target ? get_class($this->target) : null,
                'targetable_id' => optional($this->target)->getKey(),
                's_params' => serialize($this->params)
            ]);
        } catch (\Exception $exception) {
            info($exception->getMessage());
        }
    }


    public function getPayloadData($locale)
    {
        return [
            'e_type' => $this->key,
            's_title' => $this->getTranslatedTitle($locale),
            's_message' => $this->getTranslatedMessage($locale),
            'i_data_type' => (string)$this->i_data_type,
            'fk_i_sender_id' => (string)auth()->id(),
            'targetable_id' => (string)optional($this->target)->getKey()
        ];
    }


    public function toFcm($notifiable, $locale)
    {
        return FcmMessage::create()
            ->setData($this->getPayloadData($locale))
            ->setNotification(
                \NotificationChannels\Fcm\Resources\Notification::create()
                    ->setTitle($this->getTranslatedTitle($locale))
                    ->setBody($this->getTranslatedMessage($locale))
            )->setApns(
                ApnsConfig::create()
                    ->setFcmOptions(ApnsFcmOptions::create()->setAnalyticsLabel('analytics_ios'))
                    ->setPayload(['aps' => ['sound' => 'default']])
            );
    }
}
