<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['order_number', 'user_id', 'address_id', 'status', 'total_amount', 'notes'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productOrder()
    {
        return $this->hasMany(ProductOrder::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
