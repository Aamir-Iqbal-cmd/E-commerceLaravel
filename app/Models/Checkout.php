<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    // Define fillable properties
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'amount',
        'status',
    ];
}
