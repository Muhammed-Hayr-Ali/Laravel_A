<?php

namespace App\Http\Controllers\Dashboard\Product\Edit_Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;
use App\Models\Level;
use App\Models\Image;
use App\Models\Brand;
use App\Models\Unit;
use App\Models\Status;
use Illuminate\Support\Facades\Validator;
use App\Traits\BaseResponse;
use App\Traits\ImageUploader;
use Illuminate\Support\Facades\Storage;

class Edit_ProductConatroller extends Controller
{
    use BaseResponse;
    use ImageUploader;
    public function editProduct($id)
    {
        $categories = Category::all();
        $levels = Level::all();
        $brands = Brand::all();
        $units = Unit::all();
        $statuses = Status::all();

        $product = Product::where('id', $id)->first();

        return view('dashboard.Product.add_product.add_product', compact('product', 'categories', 'levels', 'brands', 'units', 'statuses'));
    }

    public function updateProduct(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required|max:255',
                    'category_id' => 'integer',
                    'level_id' => 'required|integer',
                    'unit_id' => 'required|integer',
                    'code' => 'required',
                    'minimum_Qty' => 'required',
                    'quantity' => 'required',
                    'description' => 'required',
                    'price' => 'required',
                    'status_id' => 'required|integer',
                ],
                [
                    'name.required' => 'Enter the product name',
                    'name.max' => 'Maximum length is 255 characters',
                    'category_id.integer' => 'Select the product category',
                    'level_id.integer' => 'Select the product level',
                    'unit_id.integer' => 'Select the product unit',
                    'status_id.integer' => 'Select the product status',
                    'code.required' => 'Enter the product code',
                    'quantity.required' => 'Enter the product quantity',
                    'minimum_Qty.required' => 'Enter the product minimum quantity',
                    'description.required' => 'Enter the product description',
                    'price.required' => 'Enter the product price',
                ],
            );

            if ($validator->fails()) {
                $errorField = $validator->errors()->keys()[0];
                return $this->sendError($errorField, __('validators.' . $validator->errors()->first()), 400);
            }

            $input = $request->all();

            $user_id = Auth::id();
            $input['user_id'] = $user_id;
            $product = Product::create($input);

            if ($product) {
                if ($request->hasFile('images')) {
                    $images = $request->file('images');
                    $this->saveMultipleImages($images, 'products', $product->id);

                    return $this->sendResponses('Success', __('addproduct.The product has been added successfully'));
                }
            }
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage(), 500);
        }
    }
}
