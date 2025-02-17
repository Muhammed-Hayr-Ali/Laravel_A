<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $table = 'levels';

    protected $fillable = ['name', 'description', 'image', 'user_id'];

    public function products()
    {
        return $this->hasMany(Product::class, 'level_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
