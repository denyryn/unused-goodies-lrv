<?php

namespace App\Enums;

enum AddressTypeEnum: string
{
    case HOME = 'home';
    case OFFICE = 'office';

    public function label(): string
    {
        return match ($this) {
            self::HOME => 'Home',
            self::OFFICE => 'office',
        };
    }
}