<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    public function definition()
    {
        $width = 255;
        $height = 255;
        $imageUrl = "https://picsum.photos/{$width}/{$height}";

        // Descargar la imagen
        $response = Http::get($imageUrl);

        if ($response->successful()) {
            // Convertir la imagen a base64
            $base64Image = base64_encode($response->body());
        } else {
            // Si falla la descarga, usar un placeholder base64
            $base64Image = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mN8/x8AAuMB8DtXNJsAAAAASUVORK5CYII=";
        }

        return [
            'name' => $this->faker->sentence(2),
            'description' => $this->faker->paragraph(),
            'image' => $base64Image
        ];
    }
}
