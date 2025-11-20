<?php


namespace App\Constants;


use ReflectionClass;

class UserGender
{
    const MALE = "MALE";
    const FEMALE = "FEMALE";

    public static function options()
    {
        return (new ReflectionClass(get_called_class()))->getConstants();
    }
}
