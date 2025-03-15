<?php

namespace App\Utilities;

class Asset
{
    private string $asset;
    private const DEFAULT_IMAGE = 'assets/Image/Default/default_no_picture.jpg';

    public function __construct(string $asset)
    {
        $this->asset = $asset;
        $this->default_image = 'assets/Image/Default/default_no_picture.jpg';
    }

    public static function getDefaultImage()
    {
        return asset(self::DEFAULT_IMAGE);
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