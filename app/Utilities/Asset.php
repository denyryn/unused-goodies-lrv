<?php

namespace App\Utilities;

class Asset
{
    private string $asset;

    public function __construct(string $asset)
    {
        $this->asset = $asset;
    }

    public static function getFromStorage(?string $asset)
    {
        return asset('storage/' . $asset);
    }

    public static function getFromAssets(?string $asset)
    {
        return asset('assets/' . $asset);
    }
}