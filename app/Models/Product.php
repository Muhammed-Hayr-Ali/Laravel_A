<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'levels',
        'name',
        'status',
        'price',
        'description',
        'discountPercentage',
        'views',
    ];


    public function orders()
    {
        return $this->hasMany(Order::class);
    }


    public function images()
    {
        return $this->hasMany(Image::class);
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }



}
