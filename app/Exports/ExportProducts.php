<?php

namespace App\Exports;
use App\Models\Product;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportProducts implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        // according to users table

        return ['id', 'category_id', 'levels', 'name', 'brand_id', 'status', 'description', 'price', 'discountPercentage', 'views', 'code', 'quantity', 'unit', 'user_id', 'expiration_date', 'created_at', 'updated_a'];
    }

    public function collection()
    {
        $productData = Product::get();

        return collect($productData);
    }
}
