<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait ImageUploader
{
    public function saveImage($image, $path, $name= null)
    {
        $filename = $name==null ? time() . '.' . $image->getClientOriginalExtension() : $name .'.' . $image->getClientOriginalExtension() ;
        $image->move('uploads/' . $path, $filename);
        $imagePath = 'uploads/' . $path . '/' . $filename;
        return $imagePath;
    }

    public function saveMultipleImages($images, $path, $column, $id)
    {
        $user_id = Auth::id();

        foreach ($images as $key => $image) {
            $filename = time() . $key . '.' . $image->getClientOriginalExtension();
            $image->move('uploads/' . $path, $filename);
            $imagePath = 'uploads/' . $path . '/' . $filename;
            $imageData = [
                'name' => $filename,
                'url' => $imagePath,
                $column => $id,
                'user_id' => $user_id,
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
