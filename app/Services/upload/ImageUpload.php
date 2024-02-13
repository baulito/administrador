<?php

namespace App\Services\upload;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class ImageUpload
{
    public static function uploadImage($name,Request $request)
    {
        ini_set('memory_limit','560M');
        $image = $request->file($name);
        // Define el nuevo tamaño y peso deseado
        $width = 1200;
        $height = 1200;
        $quality = 70; // Valor de calidad para la compresión de la imagen (0 a 100)
        // Nombre único para la imagen
        $imageName = $image->getClientOriginalName();
        $path ='images/' . $imageName;
        // Verifica si la imagen ya existe
        $counter = 1;

      
        
        while ( Storage::disk('public')->exists($path)) {
            $imageName = pathinfo($path, PATHINFO_FILENAME) . '_' . $counter . '.' . $image->getClientOriginalExtension();
            $path = 'images/' . $imageName;
            $counter++;
        }
        // Carga la imagen original
        $originalImage = Image::make($image->getRealPath());

        // Redimensiona la imagen
        $originalImage->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        // Guarda la imagen redimensionada en el sistema de archivos
        Storage::disk('public')->put($path, $originalImage->encode(), 'public');

        return  $path;
    }
}
