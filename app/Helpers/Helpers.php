<?php

use League\Glide\Urls\UrlBuilderFactory;


if (!function_exists('currentSectionData')) {
    function currentSectionData()
    {
        return 'admin.' . request()->segment(2) . '.data';
    }
}


if (!function_exists('formatNotificationCount')) {
    function formatNotificationCount($notificationCount)
    {
        if ($notificationCount > 100) {
            return '99+';
        }
        return $notificationCount;
    }
}


if (!function_exists('glideAsset')) {
    function glideAsset($path, $options = [])
    {
        $signKey = config('services.glide.key');
        $urlBuilder = UrlBuilderFactory::create('/img/', $signKey);
        return $urlBuilder->getUrl($path, $options);
    }
}
