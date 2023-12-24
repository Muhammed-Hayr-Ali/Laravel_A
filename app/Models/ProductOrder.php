<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    use HasFactory;

    protected $table = 'products_orders';


    protected $fillable = [
        'product_id',
        'order_id',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }


    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
