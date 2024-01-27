<?php

namespace App\Http\Controllers\Dashboard\Product;

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

class ProductListConatroller extends Controller
{
    public function index()
    {
        $perPage = request()->get('perPage', 10);
        $products = Product::paginate($perPage);

        return view('dashboard.Product.productlist', compact('products'));
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
        return view('dashboard.Product.productlist', compact('products'));
    }

    public function exportPdf()
    {
        $products = Product::all();

        $pdf = Pdf::loadView('dashboard.Product.productlistExport', compact('products'));
        return $pdf->download('product_List.pdf');
    }

    public function print()
    {
        $products = Product::all();

        return view('dashboard.Product.productlistExport', compact('products'));
    }

    public function exportExcel()
    {
        $fileName = 'Products.xlsx';

        return Excel::download(new ExportProducts(), $fileName);
    }
}
