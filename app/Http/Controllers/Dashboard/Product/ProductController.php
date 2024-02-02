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
        $perPage = request()->get('perPage', 10);
        $products = Product::latest()->paginate($perPage);
        return view('dashboard.Product.index', compact('products'));
    }

    // CREATE OK!!
    public function create()
    {
        $categories = Category::all();
        $levels = Level::all();
        $brands = Brand::all();
        $units = Unit::all();
        $statuses = Status::all();

        return view('dashboard.Product.create', compact('categories', 'levels', 'brands', 'units', 'statuses'));
    }

    // STORE OK!!
    public function store(Request $request)
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
                    'images' => 'required|array|min:1|max:10|',
                    'images.*' => 'image|max:5000|mimes:jpeg,png,jpg,gif',
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
                    'images.required' => 'At least one image is required',
                    'images.min' => 'The images field must have at least 1 image',
                    'images.max' => 'The images field cannot have more than 10 images',
                    'images.array' => 'The images field must be an array',
                    'images.*.image' => 'The selected image must be in JPEG, PNG, JPG, or GIF format',
                    'images.*.max' => 'The selected image must not be larger than 5MB',
                    'images.*.mimes' => 'The selected image must be in JPEG, PNG, JPG, or GIF format',
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
        $product = Product::find($id);
        if (!$product) {
            return redirect()
                ->route('Product.index')
                ->with('error', __('responses.Product not found'));
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
        $brands = Brand::all();
        $units = Unit::all();
        $statuses = Status::all();
        return view('dashboard.Product.edit', compact('product', 'categories', 'levels', 'brands', 'units', 'statuses'));
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

            $images = $product->images;
            if ($images == null || $images->count() <= 0) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'images' => 'required|array|min:1|max:10|',
                        'images.*' => 'image|max:5000|mimes:jpeg,png,jpg,gif',
                    ],
                    [
                        'images.required' => 'At least one image is required',
                        'images.min' => 'The images field must have at least 1 image',
                        'images.max' => 'The images field cannot have more than 10 images',
                        'images.array' => 'The images field must be an array',
                        'images.*.image' => 'The selected image must be in JPEG, PNG, JPG, or GIF format',
                        'images.*.max' => 'The selected image must not be larger than 5MB',
                        'images.*.mimes' => 'The selected image must be in JPEG, PNG, JPG, or GIF format',
                    ],
                );

                if ($validator->fails()) {
                    $errorField = $validator->errors()->keys()[0];
                    return $this->sendError($errorField, __('validators.' . $validator->errors()->first()), 400);
                }
            }

            $product->update($input);

            if ($request->hasFile('images')) {
                $images = $request->file('images');
                $this->saveMultipleImages($images, 'products', 'product->id', $product->id);
            }

            return $this->sendResponses('Success', __('responses.The product has been Updated successfully'));
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage(), 500);
        }
    }

    //GetImages OK!!
    public function getImages(Request $request)
    {
        $id = $request->id;
        $images = Image::where('product_id', $id)->get();
        return view('dashboard.Product.components.images', compact('images'));
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
        $category_id = $request->category;
        $status_id = $request->status;
        $brand_id = $request->brand;
        $unit_id = $request->unit;
        $perPage = request()->get('perPage', 10);

        $products = Product::query();
        if ($category_id !== null && $category_id !== 'all') {
            $products->where('category_id', $category_id);
        }
        if ($status_id !== null && $status_id !== 'all') {
            $products->where('status_id', $status_id);
        }
        if ($brand_id !== null && $brand_id !== 'all') {
            $products->where('brand_id', $brand_id);
        }
        if ($unit_id !== null && $unit_id !== 'all') {
            $products->where('unit_id', $unit_id);
        }
        $products = $products->paginate($perPage)->withPath(route('Product.index'));
        return view('dashboard.Product.index', compact('products', 'category_id', 'status_id', 'brand_id', 'unit_id'));
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
