<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'url', 'product_id', 'user_id'];

    public function product()
    {
        return $this->belongsTo(Product::class, );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
