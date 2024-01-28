<?php

namespace App\Http\Controllers\Dashboard\Product\product_list;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Unit;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Exports\ExportProducts;
use PDF;
use Excel;
use App\Traits\Response;

class ProductListConatroller extends Controller
{
    use Response;

    public function index()
    {
        $perPage = request()->get('perPage', 10);
        $products = Product::paginate($perPage);

        return view('dashboard.Product.product_list.productlist', compact('products'));
    }

    public function filters(Request $request)
    {
        $category = $request->category;
        $brand = $request->brand;
        $unit = $request->unit;
        $perPage = request()->get('perPage', 10);

        $products = Product::query();
        if ($category !== null && $category !== 'all') {
            $products->where('category_id', $category);
        }
        if ($brand !== null && $brand !== 'all') {
            $products->where('brand_id', $brand);
        }
        if ($unit !== null && $unit !== 'all') {
            $products->where('unit_id', $unit);
        }
        $products = $products->paginate($perPage)->withPath(route('productlist'));
        return view('dashboard.Product.product_list.productlist', compact('products'));
    }

    public function exportPdf()
    {
        $products = Product::all();

        $pdf = Pdf::loadView('dashboard.Product.product_list.productlistExport', compact('products'));
        return $pdf->download('product_List.pdf');
    }

    public function print()
    {
        $products = Product::all();

        return view('dashboard.Product.product_list.productlistExport', compact('products'));
    }

    public function exportExcel()
    {
        $fileName = 'Products.xlsx';

        return Excel::download(new ExportProducts(), $fileName);
    }

    public function productDetails($id)
    {
        $product = Product::find($id);
        return view('dashboard.Product.product_list.product-details', compact('product'));
    }

    public function delete(Request $request)
    {
        try {
            $id = $request->id;
            $product = Product::find($id);
            if (!$product) {
                return $this->sendError('Error', __('productlist.Product not found'), 404);
            }
            // $this->deleteImage($product->image);
            $product->delete();
            return $this->sendResponses('Success', __('productlist.Product deleted successfully'), 200);
        } catch (\Exception $e) {
            return $this->sendError('Error', $e->getMessage(), 500);
        }
    }
}
