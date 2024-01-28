<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'level_id', 'brand_id', 'unit_id', 'code', 'minimum_Qty', 'quantity', 'expiration_date', 'description', 'tax', 'discount', 'price', 'status_id', 'user_id', 'views'];

    protected $casts = [
        'expiration_date' => 'datetime',
        'brand_id' => 'integer',
    ];

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

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
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
