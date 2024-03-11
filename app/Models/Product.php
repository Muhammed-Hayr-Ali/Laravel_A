<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['productName', 'description', 'thumbnailImage', 'price', 'code', 'availableQuantity', 'minimumQuantity', 'expiration_date', 'view', 'category_id', 'level_id', 'status_id', 'user_id', 'unit_id', 'quantity'];



    public function productOrder()
    {
        return $this->hasMany(ProductOrder::class, 'product_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'product_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }



    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'product_id');
    }

    public function rating()
    {
        return $this->hasMany(Rating::class, 'product_id');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'product_id');
    }
}
