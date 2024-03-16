<?php

namespace App\Http\Controllers\API\V1\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Traits\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductsController extends Controller
{
    use JsonResponse;

    public function getPremiumProducts()
    {
        try {
            $products = Product::where('level_id', 1)
                ->with('category', 'rating')
                ->orderBy('id', 'desc')
                ->select(['id', 'productName', 'thumbnailImage', 'price', 'category_id'])
                ->get();

            if ($products->isEmpty()) {
                return $this->json(false, 'No products found', null, 404);
            }

            // $data = ['total' => $products->lastPage(), 'items' => $products->total(), 'data' => $products->items()];

            return $this->json(true, 'Premium Products retrieved successfully', $products, 200);
        } catch (\Throwable $ex) {
            return $this->json(false, 'Unknown Error', $ex, 500);
        }
    }

    public function getAllProducts()
    {
        try {
            $products = Product::where('level_id', '<>', 1)
                ->with('category', 'rating')
                ->orderBy('id', 'desc')
                ->select(['id', 'productName', 'thumbnailImage', 'price', 'category_id'])
                ->Paginate(10);

            if ($products->isEmpty()) {
                return $this->json(false, 'No products found', null, 404);
            }

            // $data = ['total' => $products->lastPage(), 'items' => $products->total(), 'data' => $products->items()];

            return $this->json(true, 'All Products retrieved successfully', $products, 200);
        } catch (\Throwable $ex) {
            return $this->json(false, 'Unknown Error', $ex, 500);
        }
    }
}
