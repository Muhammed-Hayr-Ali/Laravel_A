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
                return $this->json(false, 'No product found', null, 404);
            }
            return $this->json(true, 'Get Product Details Success', $product, 200);
        } catch (\Throwable $ex) {
            return $this->json(false, $ex, null, 500);
        }
    }
}
