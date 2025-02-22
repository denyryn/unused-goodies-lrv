<?php

namespace App\Utilities;
use App\Enums\RoleEnum;

class Permission
{
    public static function isUserLoggedIn()
    {
        return auth()->check();
    }

    public static function isAdmin()
    {
        return auth()->user()->role == RoleEnum::ADMIN;
    }
}