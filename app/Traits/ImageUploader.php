<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Http\Request;

trait ImageUploader
{
    function saveImage(Request $request, $fileName, $path)
    {
        $image = $request->file($fileName);
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $image->move('uploads/' . $path, $filename);
        $imagePath = 'uploads/' . $path . '/' . $filename;
        return $imagePath;
    }

    public function saveMultipleImages(Request $request, $fieldName, $path, $product_id)
    {
        if ($request->hasFile($fieldName)) {
            $files = $request->file($fieldName);

            foreach ($files as $file) {
                $filename = time() . $file . '.' . $file->getClientOriginalExtension();
                $file->move($path, $filename);
                $imagePath = $path . '/' . $filename;
                $imageUrl = url($imagePath);

                $imageData = [
                    'name' => $filename,
                    'url' => $imageUrl,
                    'product_id' => $product_id,
                ];

                Image::create($imageData);
            }
        }
    }

    public function deleteImage($path)
    {
        if (file_exists($path)) {
            unlink($path);
        }
    }
}
