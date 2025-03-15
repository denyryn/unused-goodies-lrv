<?php

namespace App\Utilities;

class Format
{
    public static function price($price)
    {
        return 'IDR ' . number_format($price, 2, ',', '.');
    }
}