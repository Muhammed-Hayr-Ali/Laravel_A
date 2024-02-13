<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NumberVerification extends Model
{
    use HasFactory;

    protected $table = 'number_verification';

    protected $fillable = ['phoneNumber', 'verificationCode'];
}
