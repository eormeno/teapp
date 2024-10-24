<?php

namespace App\Utils;

use Illuminate\Support\Facades\Http;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageUtils
{
    public static function downloadImage(int $width, int $height): ?array
    {
        try {
            $response = Http::get("https://picsum.photos/{$width}/{$height}");
            return self::base64Images($response->body());
        } catch (\Exception $e) {
            return null;
        }
    }

    public static function base64Images($source): array
    {
        $manager = new ImageManager(new Driver());
        $image = $manager->read($source);
        // resize the image to a width of 64 and constrain aspect ratio (auto height)
        $thumbnail = $image->resize(48, 48);
        //$thumbnail = $image->resize(width: 64, height: 64);
        $originalBase64 = base64_encode($image->toJpeg(90));
        $thumbnailBase64 = base64_encode($thumbnail->toJpeg(90));
        return [
            'original' => $originalBase64,
            'thumbnail' => $thumbnailBase64
        ];
    }

}
