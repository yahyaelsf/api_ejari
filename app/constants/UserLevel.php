<?php


namespace App\Constants;


use ReflectionClass;

class UserLevel
{
    const BEGINNER = "BEGINNER";
    const MIDDLE = "MIDDLE";
    const ADVANCED = "ADVANCED";
    public static function options()
    {
        return (new ReflectionClass(get_called_class()))->getConstants();
    }
}
