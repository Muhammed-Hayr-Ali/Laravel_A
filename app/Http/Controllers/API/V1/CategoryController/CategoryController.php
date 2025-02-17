<?php

namespace App\Http\Controllers\API\V1\CategoryController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Traits\JsonResponse;

class CategoryController extends Controller
{
    use JsonResponse;

    public function getCategory()
    {
        try {
            $category = Category::select(['id', 'name', 'description', 'image'])->get();
            if (!$category) {
                return $this->json(false, 'No categories found', null, 404);
            }
            return $this->json(true, 'Categories retrieved successfully', $category, 200);
        } catch (\Throwable $ex) {
            return $this->json(false, 'Unknown Error', $ex, 500);
        }
    }
}
