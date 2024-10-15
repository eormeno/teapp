<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Http;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    private function downloadImage(int $width, int $height) : ?string
    {
        $response = Http::get("https://picsum.photos/{$width}/{$height}");
        if ($response->successful()) {
            return base64_encode($response->body());
        }
        return null;
    }

    public function definition()
    {
        $base64Image = $this->downloadImage(255, 255);
        if ($base64Image === null) {
            $image = Image::canvas(255, 255, '#ccc');
            $base64Image = $image->encode('data-url');
        }

        return [
            'name' => $this->faker->sentence(2),
            'description' => $this->faker->paragraph(),
            'image' => $base64Image
        ];
    }
}
