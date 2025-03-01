<?php

namespace App\Utilities;
use App\Enums\RoleEnum;

class Permission
{
    public static function isLoggedIn()
    {
        return auth()->check();
    }

    public function isAdmin()
    {
        return $this->isLoggedIn() && auth()->user()->role == RoleEnum::ADMIN;
    }
}