<?php

namespace App\Http\Controllers\API\V1\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Traits\JsonResponse;

class HomeScreenController extends Controller
{
    use JsonResponse;

    public function getCategory()
    {
        try {
            $category = Category::select(['id', 'name', 'description', 'image'])->get();
            if(!$category){
                return $this->json(false, 'No category found', null, 404);
            }
            return $this->json(true, 'Get All Products Success', $category, 200);
        } catch (\Throwable $ex) {
            return $this->json(false, $ex, null, 500);
        }
    }
}
