<?php

namespace App\Http\Controllers\API\V1\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Traits\JsonResponse;

class GetProductDetailsController extends Controller
{
    use JsonResponse;
    public function getProductDetails($id)
    {
        try {
            $product = Product::with('images', 'category', 'level', 'status', 'brand', 'unit', 'user')->where('id', $id)->first();
            if (!$product) {
                return $this->json(false, 'The product was not found', null, 404);
            }
            return $this->json(true, 'Product Details retrieved successfully', $product, 200);
        } catch (\Throwable $ex) {
            return $this->json(false, 'Unknown Error', $ex, 500);
        }
    }
}
