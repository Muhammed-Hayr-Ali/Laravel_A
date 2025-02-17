<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $table = 'units';
    protected $fillable = ['name', 'description', 'image', 'user_id'];

    public function products()
    {
        return $this->hasMany(Product::class , 'unit_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
