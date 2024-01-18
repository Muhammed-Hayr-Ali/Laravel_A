<?php

namespace App\Http\Controllers\API\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\BaseValidator;
use App\Traits\ImageUploader;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    use BaseValidator;
    use ImageUploader;


    //Store a newly created resource in storage.
    public function store(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:255',
                'status' => 'required|max:255',
                'description' => 'required',
                'price' => 'required|max:255',

            ],
            [
                'name.required' => 'Please enter Product name',
                'status.required' => 'Please enter Product status',
                'description.required' => 'Please enter Product description',
                'price.required' => 'Please enter Product price',
            ]
        );


        if ($validator->fails()) {
            return $this->sendError("error",$validator->errors()->first(), 400);
        }

        $input = $request->all();
        $product =  Product::create($input);
        if (!$product) {
            return $this->sendError("error",'Unable to create Product');
        }


     
        if ($request->hasFile('images')) {
            $this->saveMultipleImages($request, 'images', 'product/images', $product->id);
        }

        
        



        return $this->sendResponses("Success",'The Product has been created successfully', $product);
    }
    
}
