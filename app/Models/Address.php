<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = 'addresses';

    protected $fillable = [
        'title',
        'user_id',
        'recipient_name',
        'country',
        'state',
        'city',
        'address_line_1',
        'address_line_2',
        'phone_number',
        'latitude',
        'longitude',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function Orders()
    {
        return $this->hasMany(Order::class);
    }
}
