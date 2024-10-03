<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

   
    protected $fillable = [
        'order_id',
        'product_id',
        'payment_method',
        'payment_status',
        'transaction_id',
        'total_amount',
    ];
}

