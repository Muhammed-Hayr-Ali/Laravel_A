<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Http\Request;

trait ImageUploader
{
    function saveImage(Request $request, $filename, $path)
    {
        $image = $request->file($filename);
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $image->move('uploads/' . $path, $filename);
        $imagePath = 'uploads/' . $path . '/' . $filename;
        return $imagePath;
    }

    public function saveMultipleImages($images, $path, $product_id)
    {
        foreach ($images as $key => $image) {
            $filename = time() . $key . '.' . $image->getClientOriginalExtension();
            $image->move('uploads/' . $path, $filename);
            $imagePath = 'uploads/' . $path . '/' . $filename;
            $imageData = [
                'name' => $filename,
                'url' => $imagePath,
                'product_id' => $product_id,
            ];

            Image::create($imageData);
        }
    }

    public function deleteImage($images)
    {
        foreach ($images as $image) {
            $path = $image->url;
            if (file_exists($path)) {
                unlink($path);
            }
        }
    }
}
