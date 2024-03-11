<?php

namespace App\Http\Controllers\Dashboard\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\Category;
use App\Models\Level;
use App\Models\Image;
use App\Models\Brand;
use App\Models\Unit;
use App\Models\Status;
use App\Traits\ImageUploader;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Exports\ExportProducts;
use PDF;
use Excel;

class ProductController extends Controller
{
    use ImageUploader;

    // INDEX OK!!
    public function index()
    {
        $products = Product::all();
        return view('dashboard.Product.index', compact('products'));
    }

    // CREATE OK!!
    public function create()
    {
        $categories = Category::all();
        $levels = Level::all();
        $units = Unit::all();
        $statuses = Status::all();

        return view('dashboard.Product.create', compact('categories', 'levels', 'units', 'statuses'));
    }

    // STORE OK!!
    public function store(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'productName' => 'required|max:255',
                    'code' => 'required',
                    'description' => 'required',
                    'category_id' => 'integer',
                    'level_id' => 'required|integer',
                    'price' => 'required',
                    'unit_id' => 'required|integer',
                    'availableQuantity' => 'required',
                    'minimumQuantity' => 'required',
                    'status_id' => 'required|integer',

                    'thumbnailImage' => 'required',
                ],
                [
                    'productName.required' => 'Enter the product name',
                    'productName.max' => 'Maximum length is 255 characters',
                    'code.required' => 'Enter the product code',
                    'description.required' => 'Enter the product description',
                    'category_id.integer' => 'Select the product category',
                    'level_id.integer' => 'Select the product level',
                    'price.required' => 'Enter the product price',
                    'unit_id.integer' => 'Select the product unit',
                    'availableQuantity.required' => 'Enter the product quantity',
                    'minimumQuantity.required' => 'Enter the product minimum quantity',
                    'status_id.integer' => 'Select the product status',

                    'thumbnailImage.required' => 'At least one image is required',
                ],
            );

            if ($validator->fails()) {
                $errorField = $validator->errors()->keys()[0];
                return $this->sendError($errorField, __('validators.' . $validator->errors()->first()), 400);
            }

            $input = $request->all();

            $user_id = Auth::id();
            $input['user_id'] = $user_id;
            if ($request->hasFile('thumbnailImage')) {
                $images = $request->file('thumbnailImage');
                $input['thumbnailImage'] = $this->saveImage($images, 'products', $request->productName);
            }
            $product = Product::create($input);

            if ($product) {
                if ($request->hasFile('images')) {
                    $images = $request->file('images');
                    $this->saveMultipleImages($images, 'products', 'product_id', $product->id);
                }
            }
            return $this->sendResponses('Success', __('responses.The product has been added successfully'));
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage(), 500);
        }
    }

    // SHOW OK!!
    public function show(string $id)
    {
        $product = Product::with('images')->find($id);
        if (!$product) {
            return redirect()->route('Product.index')->with('error', __('responses.Product not found'));
        }
        $qrCode = QrCode::format('svg')
            ->size(100)
            ->generate($product->code);

        return view('dashboard.Product.show', compact('product'))->with('qrcode', $qrCode);
    }

    //Delete OK!!
    public function destroy(string $id)
    {
        try {
            $product = Product::find($id);
            if (!$product) {
                return $this->sendError('Error', __('responses.Product not found'), 404);
            }

            $images = $product->images;
            if ($images && $images->count() > 0) {
                foreach ($images as $image) {
                    $path = $image->url;
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
            }

            $product->delete();
            return $this->sendResponses('Success', __('responses.Product deleted successfully'), 200);
        } catch (\Exception $e) {
            return $this->sendError('Error', $e->getMessage(), 500);
        }
    }

    // EDIT OK!!
    public function edit(string $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return back()->with('error', __('responses.Product not found'));
        }

        $categories = Category::all();
        $levels = Level::all();
        $units = Unit::all();
        $statuses = Status::all();
        return view('dashboard.Product.edit', compact('product', 'categories', 'levels', 'units', 'statuses'));
    }

    // UPDATE OK!!
    public function update(Request $request)
    {
        $id = $request->id;
        $product = Product::findOrFail($id);
        if (!$product) {
            return $this->sendError('error', __('responses. product not found'), 404);
        }

        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'productName' => 'required|max:255',
                    'code' => 'required',
                    'description' => 'required',
                    'category_id' => 'integer',
                    'level_id' => 'required|integer',
                    'price' => 'required',
                    'unit_id' => 'required|integer',
                    'availableQuantity' => 'required',
                    'minimumQuantity' => 'required',
                    'status_id' => 'required|integer',
                ],
                [
                    'productName.required' => 'Enter the product name',
                    'productName.max' => 'Maximum length is 255 characters',
                    'code.required' => 'Enter the product code',
                    'description.required' => 'Enter the product description',
                    'category_id.integer' => 'Select the product category',
                    'level_id.integer' => 'Select the product level',
                    'price.required' => 'Enter the product price',
                    'unit_id.integer' => 'Select the product unit',
                    'availableQuantity.required' => 'Enter the product quantity',
                    'minimumQuantity.required' => 'Enter the product minimum quantity',
                    'status_id.integer' => 'Select the product status',
                ],
            );

            if ($validator->fails()) {
                $errorField = $validator->errors()->keys()[0];
                return $this->sendError($errorField, __('validators.' . $validator->errors()->first()), 400);
            }

            $input = $request->all();

            $user_id = Auth::id();
            $input['user_id'] = $user_id;


            if ($product->thumbnailImage == null) {
                $validator = Validator::make(
                    $request->all(),
                    [
                    'thumbnailImage' => 'required',
                    ],
                    [
                    'thumbnailImage.required' => 'At least one image is required',
                    ],
                );

                if ($validator->fails()) {
                    $errorField = $validator->errors()->keys()[0];
                    return $this->sendError($errorField, __('validators.' . $validator->errors()->first()), 400);
                }
            }
            if ($request->hasFile('thumbnailImage')) {
                $images = $request->file('thumbnailImage');
                $input['thumbnailImage'] = $this->saveImage($images, 'products', $request->productName);
            }
            $product->update($input);



            return $this->sendResponses('Success', __('responses.The product has been Updated successfully'));
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage(), 500);
        }
    }

    //GetImages OK!!
    public function getImages(Request $request)
    {
        $id = $request->id;
        $product = Product::find($id);
        $thumbnailImage = $product->thumbnailImage;
        $images = Image::where('product_id', $id)->get();
        return view('dashboard.Product.components.images', compact('images', 'thumbnailImage'));
    }

    //Delete Image OK!!
    public function deleteImage(Request $request)
    {
        try {
            $id = $request->id;
            $image = Image::find($id);
            if (!$image) {
                return $this->sendError('Error', __('responses.Image not found'), 404);
            }

            $path = $image->url;
            if (file_exists($path)) {
                unlink($path);
            }

            $image->delete();
            return $this->sendResponses('Success', __('responses.Image deleted successfully'), 200);
        } catch (\Exception $e) {
            return $this->sendError('Error', $e->getMessage(), 500);
        }
    }

    //Filters OK!!
    public function filters(Request $request)
    {
        $category = $request->category;
        $level = $request->level;
        $unit = $request->unit;
        $status = $request->status;
        $hasFilters = true;

        $products = Product::query();
        if ($category !== 'null') {
            $products->where('category_id', $category);
        }
        if ($level !== 'null') {
            $products->where('level_id', $level);
        }
        if ($unit !== 'null') {
            $products->where('unit_id', $unit);
        }
        if ($status !== 'null') {
            $products->where('status_id', $status);
        }

        if ($category == 'null' && $level == 'null' && $unit == 'null' && $status == 'null') {
            $products = Product::all();
            $hasFilters = false;
        } else {
            $products = $products->get();
        }
        return view('dashboard.Product.index', compact('products', 'hasFilters'));
    }

    //Export OK!!
    public function exportPdf()
    {
        $products = Product::all();

        $pdf = Pdf::loadView('dashboard.Product.products_export', compact('products'));
        return $pdf->download('product_List.pdf');
    }

    //Print All Products OK!!
    public function printAllProducts()
    {
        $products = Product::all();

        return view('dashboard.Product.products_export', compact('products'));
    }

    //Export Excel OK!!
    public function exportExcel()
    {
        $fileName = 'Products.xlsx';

        return Excel::download(new ExportProducts(), $fileName);
    }

    //Print Product OK!!
    public function printProduct($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return $this->sendError('Error', __('responses.Product not found'), 404);
        }
        $qrCode = QrCode::format('svg')
            ->size(100)
            ->generate($product->code);

        return view('dashboard.Product.print_product', compact('product'))->with('qrcode', $qrCode);
    }
}
