<?php

namespace App\Utilities;
use App\Enums\RoleEnum;

class Permission
{
    public static function isLoggedIn()
    {
        return auth()->check();
    }

    public static function isAdmin()
    {
        return self::isLoggedIn() && auth()->user()->role == RoleEnum::ADMIN;
    }
}