<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['levels', 'name', 'status', 'price', 'description', 'discountPercentage', 'views', 'code', 'quantity', 'expiration_date', 'category_id', 'brand_id', 'unit_id', 'user_id'];

    public function productOrder()
    {
        return $this->hasMany(ProductOrder::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
