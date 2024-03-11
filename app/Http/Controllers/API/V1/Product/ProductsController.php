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

    public function getPrimiumProducts()
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

            return $this->json(true, 'Get Primium Products Success', $products, 200);
        } catch (\Throwable $ex) {
            return $this->json(false, $ex, null, 500);
        }
    }




    public function getAllProducts()
    {
        try {
            $products = Product::where('level_id','<>', 1)
                ->with('category', 'rating')
                ->orderBy('id', 'desc')
                ->select(['id', 'productName', 'thumbnailImage', 'price', 'category_id'])
                ->Paginate(10);

            if ($products->isEmpty()) {
                return $this->json(false, 'No products found', null, 404);
            }

            // $data = ['total' => $products->lastPage(), 'items' => $products->total(), 'data' => $products->items()];

            return $this->json(true, 'Get All Products Success', $products, 200);
        } catch (\Throwable $ex) {
            return $this->json(false, $ex, null, 500);
        }
    }

}
